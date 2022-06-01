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
        $icon_metier = get_field('icone_formation');
    ?>
    <!-- Image du header de la fiche métier -->
    <div class="header_template">
        <div class="header_template-img">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>

    <!-- Container du contenu de la fiche métier -->
    <section class="template_content">
        <div class="template-section template_content-i">
            <img src="<?php echo esc_url($icon_metier['url']) ?>" alt="<?php echo esc_url($icon_metier['alt']) ?>">
        </div><!-- /.template-section -->

            <h3>Fiche Diplôme</h3>
            <h1><?php single_post_title(); ?></h1>

        <div class="template-section template_content-description">
            <h2>Composantes de la formation</h2>
            <?php the_field('composants_formation'); ?>
        </div><!-- /.template-section -->

        <div class="template-section template_content-exigence">
            <h2>Exigences préalables requises</h2>
            <?php the_field('exigences_formation'); ?>
        </div><!-- /.template-section -->

        <div class="template-section template_content-calendrier">
            <h2><img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/06/calendrier-1.svg" alt="calendrier de formation fnpsl" width="30px">Calendrier des formations</h2>
            <hr>
            <?php the_field('calendrier_formation'); ?>
        </div><!-- /.template-section -->
        <?php 
            $prerogative = the_field('prerogatives_formation');
            if( $prerogative ): 
        ?>
        <div class="template-section template_content-prerogratives">
            <h2>Prérogatives du diplôme</h2>
            <hr>
            <?php the_field('prerogatives_formation'); ?>
        </div><!-- /.template-section -->
        <?php endif ?>
        

        <hr>

        <div class="template-section template_content-cta">
            <div class="template_content-cta--download button-principal cta-style">
                <a href="<?php the_field('download_link_formation') ?>" target="_blank"><img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/icone-telechargement-fnpsl.svg" alt="Icone téléchargement de la fiche métier des sports et loisirs">Téléchargez cette fiche diplôme en PDF</a>
            </div>
            <div class="template_content-cta--download button-secondaire cta-style">
                <a href="/nous-contacter">Contacter la FNPSL pour plus d'informations</a>
            </div>
        </div><!-- /.template-section -->

    </section>
</main>

<?php get_footer(); ?>
