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