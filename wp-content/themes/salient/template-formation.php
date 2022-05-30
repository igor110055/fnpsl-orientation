<?php 
/*
 * Template Name: Template Fiche Formation
 * Template Post Type: fiche-formation
 */
get_header(); 

?>

<main class="page-template-custom">
    <?php 
        /* Import des éléments du template */
        $icon_metier = get_field('icone_metier');
        $qualites = get_field('qualites_metier');
    ?>
    <!-- Image du header de la fiche métier -->
    <div class="header_template">
        <?php the_post_thumbnail(); ?>
    </div>

    <!-- Container du contenu de la fiche métier -->
    <section class="template_content">
        <div class="template-section template_content-i">
            <img src="<?php echo esc_url($icon_metier['url']) ?>" alt="<?php echo esc_url($icon_metier['alt']) ?>">
        </div><!-- /.template-section -->

            <h1><?php single_post_title(); ?></h1>

        <!-- Partie sur les qualité du métier -->
        <?php if( $qualites ): ?>
        <div class="template-section template_content-qualite">
            <h2>Qualités requises</h2>
            <div class="template_content-qualite--items">
                <ul>
                    <?php foreach( $qualites as $qualite ): ?> 
                        <li>
                            <h4><?php echo esc_html( $qualite->name ); ?></h4>
                        </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- /.template-section -->
        <?php endif; ?>

        <div class="template-section template_content-description">
            <h2>Description du métier</h2>
            <?php the_field('definition_metier'); ?>
        </div><!-- /.template-section -->

        <div class="template-section template_content-video">
            <iframe src="https://www.youtube.com/embed/<?php the_field('video_metier'); ?>?controls=0" width="560" height="315" title="Teaser nouveau site Internet FNPSL" frameborder="0" allowfullscreen></iframe>
        </div><!-- /.template-section -->

        <div class="template-section template_content-debouches">
            <h2>Principaux débouchés</h2>
            <?php the_field('debouches_metier'); ?>
        </div><!-- /.template-section -->

        <div class="template-section template_content-formation">
            <h2>Formations pour devenir <?php the_title() ?></h2>
            <?php
            $featured_formations = get_field('formation_metier');
            if( $featured_formations ): ?>
                <div class="formations--items">
                <?php foreach( $featured_formations as $post ): 

                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); ?>
                    <div class="formations--item">
                        <?php
                            $icon_formation = get_field('icone_formation');
                        ?>
                        <div class="formations--item_header">
                            <div class="formations--item_image">
                                <img src="<?php echo esc_url($icon_formation['url']) ?>" alt="<?php echo esc_url($icon_formation['alt']) ?>">
                            </div>
                            <div class="formation--item_title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                        <span><?php the_excerpt() ?></span>
                        <div class="formations--item_cta">
                            <a href="<?php the_permalink(); ?>">Découvrir cette formation</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php 
                // Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div><!-- /.template-section -->

        <!-- Partie Testimonials, pour le moment, cette section est désactivée
        <div class="template-section template_content-testimonials">
        </div>
        -->

        <hr>

        <div class="template-section template_content-cta">
            <div class="template_content-cta--download button-principal cta-style">
                <a href="<?php the_field('downloadlink_metier') ?>" target="_blank"><img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/icone-telechargement-fnpsl.svg" alt="Icone téléchargement de la fiche métier des sports et loisirs">Téléchargez cette fiche en PDF</a>
            </div>
            <div class="template_content-cta--download button-secondaire cta-style">
                <a href="">Trouvez l’association Profession Sport & Loisirs autour de toi pour plus de renseignement</a>
            </div>
        </div><!-- /.template-section -->

    </section>
</main>

<?php get_footer(); ?>
