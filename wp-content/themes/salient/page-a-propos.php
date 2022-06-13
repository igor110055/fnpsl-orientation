<?php
/**
 * Template Name: Page a propos
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

<main id="about">
    
    <section class="about-header">
        <?php the_field('about-title') ?>
        <div class="photos">
        <?php

            // Check rows exists.
            if( have_rows('about-photos') ):

                // Loop through rows.
                while( have_rows('about-photos') ) : the_row();

                    // Load sub field value.
                    $image = get_sub_field('carroussel-photo');
                   ?>
                   <div class="photo-item">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['alt']); ?>">
                    </div>
                <?php 

                // End loop.
                endwhile;

            // No value.
            else :
                // Do something...
            endif;
        ?><!--
            <div class="photo-item">
                <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/basketball.jpg" alt="">
            </div>
            <div class="photo-item">
                <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/equitation.jpg" alt="">
            </div>
            <div class="photo-item">
                <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/kayak.jpg" alt="">
            </div>
            <div class="photo-item">
                <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/football.jpg" alt="">
            </div>
        </div>-->
    </section>
    <section class="about-content">
        <div class="about-content_header">
            <?php the_field('about-h2') ?>
        </div>
        <div class="about-content_columns">
            <?php the_field('about-p-gauche') ?>
            <?php the_field('about-p-droite') ?>
        </div>
    </section>
    <section class="about-values">
        <h2><?php the_field('about-title-valeur') ?></h2>
        <div class="values-items">
        <?php

            // Check rows exists.
            if( have_rows('values-items') ):

                // Loop through rows.
                while( have_rows('values-items') ) : the_row();

                    // Load sub field value.
                    $value_img = get_sub_field('value-img');
                    $value_title = get_sub_field('value-title');
                    $value_subtitle = get_sub_field('value-subtitle');
                    $value_txt = get_sub_field('value-txt');
                ?>
                <div class="values-item">
                    <div class="values-item_content">
                        <h3><?php echo $value_title ?></h3>
                        <h4><?php echo $value_subtitle ?></h4>
                        <?php echo $value_txt ?>
                    </div>
                    <div class="values-item_image">
                        <img src="<?php echo esc_url($value_img['url']); ?>" alt="<?php echo esc_url($value_img['alt']); ?>">
                    </div>
                </div>
                <?php 

                // End loop.
                endwhile;

            // No value.
            else :
                // Do something...
            endif;
        ?>
            <!--<div class="values-item">
                <div class="values-item_content">
                    <h3>Coopération</h3>
                    <h4>Acteur engagé de l’Économie sociale et solidaire</h4>
                    <p>Partenaire privilégié des clubs et des associations, PSL œuvre chaque jour pour garantir la richesse de l’offre sportive et culturelle de nos territoires.</p>
                </div>
                <div class="values-item_image">
                    <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/football-melee.jpg" alt="">
                </div>
            </div>
            <div class="values-item">
                <div class="values-item_content">
                    <h3>Proximité</h3>
                    <h4>Un acteur de proximité au cœur des territoires</h4>
                    <p>Partenaire privilégié des clubs et des associations, PSL œuvre chaque jour pour garantir la richesse de l’offre sportive et culturelle de nos territoires.</p>
                </div>
                <div class="values-item_image">
                    <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/accrobranche.jpg" alt="">
                </div>
            </div>
            <div class="values-item">
                <div class="values-item_content">
                    <h3>Insertion</h3>
                    <h4>Un acteur engagé pour la jeunesse</h4>
                    <p>Partenaire privilégié des clubs et des associations, PSL œuvre chaque jour pour garantir la richesse de l’offre sportive et culturelle de nos territoires.</p>
                </div>
                <div class="values-item_image">
                    <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/volée-plage-animation.jpg" alt="">
                </div>
            </div>
            <div class="values-item">
                <div class="values-item_content">
                    <h3>Innovation</h3>
                    <h4>Un partenaire du monde sportif</h4>
                    <p>Partenaire privilégié des clubs et des associations, PSL œuvre chaque jour pour garantir la richesse de l’offre sportive et culturelle de nos territoires.</p>
                </div>
                <div class="values-item_image">
                    <img src="https://www.metiersdusport.fr/wp-content/uploads/2022/06/ski-descente-sport.jpg" alt="">
                </div>
            </div>-->
        </div>
        <div class="button-principal cta-style">
                <a href="">Nous contacter</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>