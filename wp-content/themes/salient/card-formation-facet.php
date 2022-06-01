
                    <div class="formations--item">
                        <div class="formations--item_header">
                            <div class="formations--item_image">
                            <?php 
                                $image = get_field('icone_formation');
                                $size = 'full';
                            ?>
                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
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