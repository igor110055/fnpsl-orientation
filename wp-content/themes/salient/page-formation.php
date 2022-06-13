<?php
/**
 * Template Name: Page formation
*
* @package Salient WordPress Theme
* @version 13.0
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="page-metier">
    
    <section class="header-template">
        <div class="header-template_container">
            <div class="header-template_content">
                <?php $image = get_field('page-img') ?>
                <h1><?php the_field('page-title') ?></h1>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['alt']); ?>">
            </div>
            <div class="header-section_search" id="searchtemplate">
                <form role="search" method="get" class="search-form" 
                action="<?php echo site_url( 'resultats-sports-loisirs/' ); ?>">
                    <label>
                        <span class="screen-reader-text">
                            <?php echo _x( 'Search for:', 'label' ) ?>
                        </span>
                        <input type="search" class="search-field"
                            name="searchwp"
                            placeholder="<?php echo esc_attr_x( 'Recherchez un sport, une activité, une formation ...', 'placeholder' ) ?>"
                            value="<?php echo isset( $_GET['searchwp'] ) ? esc_attr( $_GET['searchwp'] ) : '' ?>"
                            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                    </label>
                    <input type="submit" class="search-submit"
                        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
                </form>
            </div>
        </div>
    </section>
    <section class="facets-formation">
        <div class="facets">
            <h2>Nous référençons pour toi le.s formations qui peuvent t’aider à accéder aux metiers du sport et des loisirs.</h2>
            <div class="facets-items">
                <?php echo do_shortcode('[facetwp facet="formation"]'); ?>
            </div>
        </div>
    </section>
    <section class="facets-resultats">
        <div class="facets-results">
            <?php echo do_shortcode('[facetwp template="affichage_formation"]'); ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>