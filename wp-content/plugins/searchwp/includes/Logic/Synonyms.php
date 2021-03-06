<?php

/**
 * SearchWP Synonyms.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP\Logic;

use SearchWP\Query;
use SearchWP\Utils;

/**
 * Class Synonyms is responsible for applying synonyms to Tokens.
 *
 * @since 4.0
 */
class Synonyms {

	/**
	 * The language code.
	 *
	 * @since 4.0
	 * @var string
	 */
	private $language_code;

	/**
	 * Synonyms.
	 *
	 * @since 4.0
	 * @var array
	 */
	private $synonyms = [];

	/**
	 * Synonyms constructor.
	 *
	 * @since 4.0
	 */
	function __construct() {
		$this->language_code = strtolower( substr( get_locale(), 0, 2 ) );

		// TODO: Build in support for multilanguage setups (WPML, Polylang, soon to be core).

		// Apply synonyms to query search string.
		add_filter( 'searchwp\query\search_string', [ $this, 'apply' ], 5, 2 );
	}

	/**
	 * Applies synonyms to tokens.
	 *
	 * @since 4.0
	 * @param string $search_string Original search string.
	 * @return string Synonyms applied.
	 */
	public function apply( string $search_string, Query $query ) {
		$original_search_string = $search_string;

		// Apply our (wildcard-based) partial matching by default.
		if ( apply_filters( 'searchwp\synonyms\partial_matches', true, [
			'search' => $search_string,
			'query'  => $query,
		] ) ) {
			$search_string = $this->set_partial_matches( $search_string );
		}

		$synonyms = $this->set( $search_string, $query );

		// If there are quoted phrases, limit applicable synonyms.
		if ( $phrases = Utils::search_string_has_phrases( $search_string, $query ) ) {
			$synonyms_filtered = array_values( array_filter( $synonyms, function( $synonym ) use ( $phrases ) {
				return ! empty( array_filter( $phrases, function( $phrase ) use ( $synonym ) {
					return false !== strpos( $synonym['sources'], $phrase );
				} ) );
			} ) );

			if ( ! empty( $synonyms_filtered ) || apply_filters( 'searchwp\synonyms\strict', false ) ) {
				$synonyms = $synonyms_filtered;
			}
		}

		if ( ! is_array( $synonyms ) || empty( $synonyms ) ) {
			return $search_string;
		}

		foreach ( $synonyms as $synonym ) {
			// Multiple sources can be set using comma separation.
			$sources = array_filter( array_map( 'trim', explode( ',', $synonym['sources'] ) ) );

			if ( empty( $sources ) ) {
				continue;
			}

			// If we're not replacing, prepend the search string to the synonyms regardless of whether it applies.
			// We are not prepending the source of the synoym because there may be multiple, comma
			// separated sources which could introduce unwanted tokens into the search.
			if ( ! $synonym['replace'] ) {
				$synonym['synonyms'] = $original_search_string . ' ' . $synonym['synonyms'];
			}

			// Iterate over the sources to see if there's a match.
			$found_synonym = false;
			foreach ( $sources as $source ) {
				// If this source is a quoted phrase, remove the quotes first.
				$source = str_replace( '"', '', $source );

				// If there's a space in the search string and the synonym source opt to replace only the whole source.
				$compound_source = false;
				if ( false !== strpos( $search_string, ' ' ) && false !== strpos( $source, ' ' ) ) {
					$search_string_before = $search_string;
					$compound_source      = true;
					$search_string        = preg_replace( '/\b' . preg_quote( $source, '/' ) . '\b/i', $synonym['synonyms'], str_replace( '"', '', $search_string ) );

					if ( $search_string_before !== $search_string ) {
						$found_synonym = true;
					}

					// TODO: use searchwp\query\tokens\limit hook to adjust limit based on count( $synonym['synonyms'] ) if necessary?
				}

				if ( ! $compound_source ) {
					$search_string_before = $search_string;

					// Handle synonym replacement where applicable.
					$search_string = implode( ' ', array_map( function( $token ) use ( $synonym, $source ) {
						return preg_replace( '/\b' . preg_quote( $source, '/' ) . '\b/i', $synonym['synonyms'], $token );
					}, explode( ' ', $search_string ) ) );

					if ( $search_string_before !== $search_string ) {
						$found_synonym = true;
					}

					// TODO: use searchwp\query\tokens\limit hook to adjust limit based on count( $synonym['synonyms'] ) if necessary?
				}
			}

			// Assume that one synonym replacement is enough and in doing so prevent
			// redundant synonym application, but also base that on a hook to allow
			// developers to 'stack' synonyms when that's what they want to do.
			if ( apply_filters( 'searchwp\synonyms\aggressive', true ) && $found_synonym ) {
				break;
			}
		}

		return $search_string;
	}

	/**
	 * Applies partial matches to synonyms.
	 *
	 * @since 4.1
	 * @param string $search_string The search string.
	 * @return string The search string.
	 */
	public function set_partial_matches( $search_string ) {
		$synonyms = $this->get();

		if ( empty( $synonyms ) ) {
			return $search_string;
		}

		foreach ( $synonyms as $synonym ) {
			$sources = array_map( 'trim', explode( ',', $synonym['sources'] ) );

			foreach ( $sources as $source ) {
				// In order for partial matching to apply, a wildcard character (*) is used
				// because there are too many common cases where more generalized partial
				// matching has too many overruns and it triggers unwanted synonym hits.
				if ( false !== strpos( $source, '*' ) && fnmatch( $source, $search_string ) ) {
					if ( isset( $synonym['replace'] ) && ! empty( $synonym['replace'] ) ) {
						// Pad the search string to prevent overrun.
						$search_string = ' ' . $search_string . ' ';

						// Convert the wildcard into something that won't be double encoded.
						$placeholder = Utils::get_placeholder( false );
						$source      = str_replace( '*', $placeholder, $source );

						$term    = preg_quote( $search_string, '/' );
						$needle  = str_replace( $placeholder, '\S*', preg_quote( $source, '/' ) );
						$pattern = '/ ' . $needle . ' /ius';

						if ( 1 === preg_match( $pattern, $term, $matches ) ) {
							foreach ( $matches as $match ) {
								$search_string = str_replace( $match, $synonym['synonyms'], $search_string );
							}
						}

						$search_string = trim( $search_string );
					} else {
						$search_string .= ' ' . $synonym['synonyms'];
					}
				}
			}
		}

		return $search_string;
	}

	/**
	 * Sets the synonyms for this application.
	 *
	 * @since 4.0
	 * @param string $search_string Query search string.
	 * @param Query $query Query
	 * @return array Synonyms.
	 */
	private function set( string $search_string, Query $query ) {
		$synonyms = $this->get();

		// Allow developers to customize.
		$synonyms = (array) apply_filters( 'searchwp\synonyms', $synonyms, [
			'search_string' => $search_string,
			'query'         => $query,
		] );

		// Ensure valid format.
		$this->synonyms = array_filter( $synonyms, function( $synonym ) {
			return isset( $synonym['sources'] )
				&& isset( $synonym['synonyms'] )
				&& isset( $synonym['replace'] );
		} );

		return $this->synonyms;
	}

	/**
	 * Updates saved synonyms.
	 *
	 * @since 4.0
	 * @param array $synonyms Synonyms to save.
	 * @return array Saved Synonyms.
	 */
	public function save( array $synonyms = [] ) {
		$synonyms = $this->normalize( $synonyms );

		\SearchWP\Settings::update( 'synonyms', $synonyms );

		return $synonyms;
	}

	/**
	 * Normalizes synonym model.
	 *
	 * @since 4.0
	 * @param array $synonyms Incoming synonyms.
	 * @return array Normalized synonyms.
	 */
	public function normalize( array $synonyms = [] ) {
		return array_values( array_filter( array_map( function( $synonym ) {
			if ( empty( $synonym['sources'] ) || empty( $synonym['synonyms'] ) ) {
				return false;
			}

			return [
				'sources' => implode( ', ', array_map( function( $source ) {
					return trim( sanitize_text_field( $source ) );
				}, explode( ',', $synonym['sources'] ) ) ),
				'synonyms' => implode( ', ', array_map( function( $source ) {
					return trim( sanitize_text_field( $source ) );
				}, explode( ',', $synonym['synonyms'] ) ) ),
				'replace' => ! empty( $synonym['replace'] )
			];
		}, $synonyms ) ) );
	}

	/**
	 * Getter for saved Synonyms.
	 *
	 * @since 4.0
	 * @return (string|false)[][]
	 */
	public function get() {
		$synonyms = \SearchWP\Settings::get( 'synonyms' );

		return false === $synonyms ? [] : $this->normalize( $synonyms );
	}
}
