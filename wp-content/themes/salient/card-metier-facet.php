        <div class="card-metier_item" stle="text-align: center;">
            <div class="card-metier_item--bg">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="card-metier_item--content">
                <div class="card-metier_item--icon">
                    <?php $icon_metier = get_field('icone_metier'); ?>
                    <img src="<?php echo esc_url($icon_metier['url']) ?>" alt="<?php echo esc_url($icon_metier['alt']) ?>">
                </div>
                <a href="<?php the_permalink(); ?>"><h2><?php the_title() ?></h2></a>
                <?php the_excerpt() ?>
            </div>
            <div class="card-metier_item--cta">
                <a href="<?php the_permalink(); ?>">Voir cette fiche métier</a>
            </div>
        </div>
