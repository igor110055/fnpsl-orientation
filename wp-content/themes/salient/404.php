<?php 
/**
 * The template for 404 not found.
 *
 * @package Salient WordPress Theme
 * @version 13.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$page_404_font_color       = ( ! empty( $nectar_options['page-404-font-color'] ) ) ? $nectar_options['page-404-font-color'] : '';
$page_404_bg_image         = ( ! empty( $nectar_options['page-404-bg-image'] ) && isset( $nectar_options['page-404-bg-image'] ) ) ? nectar_options_img( $nectar_options['page-404-bg-image'] ) : null;
$page_404_bg_image_overlay = ( ! empty( $nectar_options['page-404-bg-image-overlay-color'] ) ) ? $nectar_options['page-404-bg-image-overlay-color'] : '';
$page_404_home_button      = ( ! empty( $nectar_options['page-404-home-button'] ) ) ? $nectar_options['page-404-home-button'] : '';

?>

<div class="container-wrap">
	
	<?php
	if ( ! empty( $page_404_bg_image ) ) {
		echo '<div class="error-404-bg-img" style="background-image: url(' . esc_url( $page_404_bg_image ) . ');"></div>';

		if ( ! empty( $page_404_bg_image_overlay ) ) {
			 echo '<div class="error-404-bg-img-overlay"></div>';
		}
	}
	?>
	
	<div class="container main-content">
		
		<div class="row row404">
			
			<div class="col span_12 content-404" style="text-align:center; margin: 0px auto;">

			<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets8.lottiefiles.com/packages/lf20_qgdcqwbg.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px; margin: 0 auto;"  loop  autoplay></lottie-player>
				<h1>Oops, faute 404, vous êtes hors jeu !</h1>
				<p>Malheureusement, nous n'avons pas trouvé le contenu que vous cherchez sur ce site. Si vous cherchiez un contenu sur les métiers du sport et de l'animation en particulier, n'hésitez pas à nous contacter. Nous mettons à jour régulièrement les fiches.</p>
				<div class="button-secondaire cta-style">
                	<a href="https://www.metiersdusport.fr/">Revenir à la page d'accueil</a>
        		</div>
				
			</div><!--/span_12-->
			
		</div><!--/row-->
		
	</div><!--/container-->
	<?php nectar_hook_before_container_wrap_close(); ?>
</div><!--/container-wrap-->
<?php get_footer(); ?>
