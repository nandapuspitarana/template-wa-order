<div class="productbox card-body">
    <div class="card-inner">
        <div class="card-thumb-wrap">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="thumb">
                    <img class="lazy" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php echo get_the_title(); ?>">
                    <?php
                    $ribbon = get_post_meta(get_the_ID(), 'product_ribbon', true);
                    ?>
                    <?php if( $ribbon ): ?>
                        <span class="ribbon"><small class="text color-scheme-background"><?php echo $ribbon; ?></small></span>
                    <?php endif; ?>
                </div>
            </a>
        </div>
        <div class="card-body-text">
            <?php
            $terms = get_the_terms(get_the_ID(), 'product-category');
            ?>
            <?php if ( $terms && ! is_wp_error( $terms ) ): ?>
                <div class="card-category">
                    <span><?php echo esc_html( $terms[0]->name ); ?></span>
                </div>
            <?php endif; ?>
            <div class="title">
                <h3><?php echo get_the_title(); ?></h3>
            </div>
            <div class="card-rating">
                <span class="stars">
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                </span>
                <span class="rating-text">5 (469)</span>
            </div>
            <div class="card-footer-line">
                <div class="pricing">
                    <?php
                    $price = get_post_meta(get_the_ID(), 'product_price', true);
                    $price_slik = (int) get_post_meta(get_the_ID(), 'product_price_slik', true);
                    ?>
                    <?php if( $price_slik ): ?><span class="price_slik"><del>Rp <?php echo number_format($price_slik,0,',','.'); ?></del></span><?php endif; ?>
                    <span class="price">Rp <?php echo number_format($price,0,',','.'); ?></span>
                </div>
                <div class="card-add-wrap">
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm card-add-btn">
                        <span class="btn-add-plus">+</span>
                        <span class="btn-add-text">Add</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
