<?php 
$ficheinfo = get_field('metiers_items');
?>

<?php if( $ficheinfo ): ?>
    <?php foreach( $ficheinfo as $post ): 

        $description = get_field('definition_metier', $ficheinfo->ID );
        $icon_metier = get_field('icone_metier', $ficheinfo->ID);
        setup_postdata($post); ?>
        <div class="card-metier_item">
            <div class="card-metier_item--bg">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="card-metier_item--content">
                <div class="card-metier_item--icon">
                    <img src="<?php echo esc_url($icon_metier['url']) ?>" alt="<?php echo esc_url($icon_metier['alt']) ?>">
                </div>
                <a href="<?php the_permalink(); ?>"><h2><?php the_title() ?></h2></a>
                <?php the_excerpt() ?>
            </div>
            <div class="card-metier_item--cta">
                <a href="<?php the_permalink(); ?>">Voir cette fiche métier</a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>