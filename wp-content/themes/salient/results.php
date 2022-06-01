<?php

/* Template Name: Resultats de recherche */

global $post;

// Retrieve applicable query parameters.
$search_query = isset( $_GET['searchwp'] ) ? sanitize_text_field( $_GET['searchwp'] ) : null;
$search_page  = isset( $_GET['swppg'] ) ? absint( $_GET['swppg'] ) : 1;

// Perform the search.
$search_results    = [];
$search_pagination = '';
if ( ! empty( $search_query ) && class_exists( '\\SearchWP\\Query' ) ) {
	$searchwp_query = new \SearchWP\Query( $search_query, [
		'engine' => 'default', // The Engine name.
		'fields' => 'all',          // Load proper native objects of each result.
		'page'   => $search_page,
	] );

	$search_results = $searchwp_query->get_results();

	$search_pagination = paginate_links( array(
		'format'  => '?swppg=%#%',
		'current' => $search_page,
		'total'   => $searchwp_query->max_num_pages,
	) );
}

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<header class="page-header header-results">
			<h1 class="page-title">
				<?php if ( ! empty( $search_query ) ) : ?>
					<?php printf( __( 'Résultats trouvés pour votre recherche : %s' ), esc_html( $search_query ) ); ?>
				<?php else : ?>
					SearchWP Supplemental Search
				<?php endif; ?>
			</h1>

			<!-- BEGIN Supplemental Engine Search form -->
			<form role="search" method="get" class="search-form"
			action="<?php echo site_url( 'resultats-sports-loisirs/' ); ?>">
				<label>
					<span class="screen-reader-text">
					<?php echo _x( 'Recherche pour :', 'label' ) ?>
					</span>
					<input type="search" class="search-field"
					name="searchwp"
					placeholder="<?php echo esc_attr_x( 'Recherche', 'placeholder' ) ?>"
					value="<?php echo isset( $_GET['searchwp'] ) ? esc_attr( $_GET['searchwp'] ) : '' ?>"
					title="<?php echo esc_attr_x( 'Recherche pour :', 'label' ) ?>" />
				</label>
				<input type="submit" class="search-submit"
					value="<?php echo esc_attr_x( 'Recherche ', 'submit button' ) ?>" />
			</form>
			<!-- END Supplemental Engine Search form -->
		</header>
		<section class="results-items">
		<?php if ( ! empty( $search_query ) && ! empty( $search_results ) ) : ?>
			<?php  foreach ( $search_results as $search_result ) : ?>
				<article class="page hentry search-result">
					<?php
					switch( get_class( $search_result ) ) {
					case 'WP_Post':
						$post = $search_result;
						?>
						<header class="entry-header">
							<div class="results-img">
								<?php the_post_thumbnail(); ?>
							</div>
						</header>
							<div class="results-content">
								<h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="entry-summary"><?php the_excerpt(); ?></div>
								<div class="card-metier_item--cta">
                					<a href="<?php the_permalink(); ?>">Voir ce résultat</a>
            					</div>
							</div>
							
						<?php
						wp_reset_postdata();
						break;
					case 'WP_User':
						?>
						<header class="entry-header"><h2 class="entry-title">
							<a href="<?php echo get_author_posts_url( $search_result->data->ID ); ?>">
								<?php echo esc_html( $search_result->data->display_name ); ?>
							</a>
						</h2></header>
						<div class="entry-summary">
							<?php echo wp_kses_post( get_the_author_meta( 'description',
											$search_result->data->ID ) ); ?>
						</div>
						<?php
						break;
					}
					?>
				</article>
			<?php endforeach; ?>
		</section>

		<?php if ( $searchwp_query->max_num_pages > 1 ) : ?>
				<div class="navigation pagination" role="navigation">
					<h2 class="screen-reader-text">Recherches</h2>
					<div class="nav-links"><?php echo wp_kses_post( $search_pagination ); ?></div>
				</div>
			<?php endif; ?>
		<?php elseif ( ! empty( $search_query ) ) : ?>
			<p>Aucun résultats trouvés pour cette recherche, merci de préciser le métier ou la formation que vous recherchez.</p>
		<?php endif; ?>
		

	</main> <!-- .site-main -->
</div> <!-- .content-area -->

<?php get_footer(); ?>