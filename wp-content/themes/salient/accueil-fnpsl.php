<?php
/**
 * Template Name: Accueil
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

<main id="home">
    <section class="header-section" style="background-image:url('https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/fnps-a-remplacer-video-fond.png'); background-size:cover;">
        <h1>Trouve ta voie en puisant<br> dans ta passion pour le sport</h1>
        <!-- Formulaire de recherche -->
        <div class="header-section_search">
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
    </section>
    <section class="section-metier">
        <div class="header-selector">
            <div class="header-selector_title">
                <h2>Explore tes possibilités d’avenir<br> dans le sport</h2>
                <p>Notre outil t’aide à trouver des fiches métiers pour découvrir les possibilités de carrière en fonction du sport que tu préférères, de la catégorie métier qui t’intéresse ou de la formation que tu aimerais suivre. </p>
            </div>
            <div class="header-selector_box">
                <div class="selector-sport selector-item">
                    <?php echo do_shortcode('[facetwp facet="sport"]'); ?>
                </div>
                <div class="selector-cat_metier selector-item">
                    <?php echo do_shortcode('[facetwp facet="cat_metier"]'); ?>
                </div>
                <div class="selector-formation selector-item">
                    <?php echo do_shortcode('[facetwp facet="formation"]'); ?>
                </div>
            </div>
            <div class="button-secondaire cta-style">
                    <a href="javascript:;" onclick="FWP.refresh(); window.location.reload();">Appliquez mes préférences</a>
            </div>
        </div>
        <div class="fiches-metiers_items">
            <?php echo do_shortcode('[facetwp template="affichage_metier"]'); ?>
            <?php /*get_template_part('card-metier')*/ ?>
        </div>
        <div class="button-secondaire cta-style">
                <a href="">Voir toutes les fiches métier</a>
        </div>
    </section>
    <section class="section-formation">
        <div class="section-formation--head">
            <h2>Toutes les formations dispensées pour travailler dans le sport et les loisirs.</h2>
            <p>Trouve une formation dans les métiers du sport et du loisir. Nous avons répértorié les principales formations qui permettent de travailler dans le domaine de ton choix.<br> Certaines de ces formations sont dispensées par la FNPSL.</p>
        </div>
         <div class="fiches-formations_items">
         <?php echo do_shortcode('[facetwp template="affichage_formation"]'); ?>
            <?php /* get_template_part('card-formation') */ ?>
        </div>
        <div class="button-secondaire cta-style">
                <a href="">Voir toutes les fiches formation</a>
        </div>
    </section>
    <section class="section-fnpsl">
        <div class="section-fnpsl_div">
            <div class="section-fnpsl_image">   
                <img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/fnpsl.jpeg" alt="fnspl">
            </div>
            <div class="section-fnpsl_content">
                <h2>À ropos de la Fédération National des Professions du Sport et des Loisirs.</h2>
                <p>Chaque jour, les équipes des associations Profession Sport et Loisirs (PSL) permettent aux professionnels diplômés des secteurs sportifs et socio-culturels d’exercer leurs métiers dans un cadre sécurisé et durable. Acteurs engagés de l’Économie Sociale et Solidaire (ESS), les associations locales PSL s’engagent auprès des clubs et des associations pour générer des emplois et des services de qualité à long terme. 

Présent sur l’ensemble du territoire français, le réseau PSL accompagne les acteurs locaux (associatifs, collectivités, etc.) dans la mise en œuvre des politiques publiques d’emploi/formation et de développement local.</p>
                <div class="button-secondaire cta-style">
                    <a href="https://www.profession-sport-loisirs.fr/">Découvrir le site de la FNPSL</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-partenaires">
        <div class="section-partenaires_head">
            <h2>Les partenaires de la fédération</h2>
            <p>Découvre les partenaires de la Fédération. <br>L'ensemble des partenaires nous font confiance, certains nous suivent depuis des années et nous les remercions.</p>
        </div>
        <div class="section-partenaires_logo">
            <div class="section-partenaires_logo--item">
                <img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/Ministère_chargé_des_Sports-1.png" alt="">
            </div>
            <div class="section-partenaires_logo--item">
                <img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/1200px-Logo_Macif-1.png" alt="">
            </div>
            <div class="section-partenaires_logo--item">
                <img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/logo-chorum-vyv-300x138-1.png" alt="">
            </div>
            <div class="section-partenaires_logo--item">
                <img src="https://www.lovc3692.odns.fr/wp-content/uploads/2022/05/1280px-Logo_Pôle_Emploi_2008-1.png" alt="">
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
