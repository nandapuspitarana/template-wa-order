<div class="productbox card-body tw-p-3 tw-box-border">
    <div class="card-inner tw-bg-white tw-rounded-xl tw-border tw-border-brand/40 tw-shadow-sm tw-overflow-hidden">
        <div class="card-thumb-wrap tw-relative">
            <?php
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="thumb tw-h-[205px] tw-bg-black/5 tw-overflow-hidden">
                    <?php if ( $thumb ) : ?>
                        <img class="lazy" loading="lazy" src="<?php echo esc_url( $thumb ); ?>" data-src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo get_the_title(); ?>">
                    <?php endif; ?>
                    <?php
                    $ribbon = get_post_meta(get_the_ID(), 'product_ribbon', true);
                    ?>
                    <?php if( $ribbon ): ?>
                        <span class="ribbon"><small class="text color-scheme-background"><?php echo $ribbon; ?></small></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="card-product-action tw-absolute tw-top-2 tw-right-2 tw-flex tw-flex-col tw-gap-2 tw-opacity-0 tw-transition-opacity hover:tw-opacity-100">
                <a href="<?php the_permalink(); ?>" class="btn-action" title="Lihat produk">
                    <i class="lni lni-eye"></i>
                </a>
                <a href="<?php the_permalink(); ?>" class="btn-action" title="Favorit">
                    <i class="lni lni-heart"></i>
                </a>
                <a href="<?php the_permalink(); ?>" class="btn-action" title="Bandingkan">
                    <i class="lni lni-arrows-horizontal"></i>
                </a>
            </div>
        </div>
        <div class="card-body-text tw-p-3 tw-flex tw-flex-col tw-gap-2">
            <?php
            $terms = get_the_terms(get_the_ID(), 'product-category');
            ?>
            <?php if ( $terms && ! is_wp_error( $terms ) ): ?>
                <div class="card-category tw-text-xs tw-text-slate-500">
                    <span class="tw-capitalize"><?php echo esc_html( $terms[0]->name ); ?></span>
                </div>
            <?php endif; ?>
            <div class="title">
                <h3 class="tw-font-semibold tw-text-slate-800 tw-leading-tight"><?php echo get_the_title(); ?></h3>
            </div>
            <div class="card-rating tw-flex tw-items-center tw-gap-2">
                <span class="stars tw-text-amber-400 tw-text-xs">
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                </span>
                <?php
                $rating_count = get_post_meta(get_the_ID(), 'product_rating_count', true);
                $rating_val = get_post_meta(get_the_ID(), 'product_rating_val', true);
                $rating_text = $rating_val ? $rating_val : '5';
                $rating_text .= $rating_count ? ' (' . $rating_count . ')' : ' (469)';
                ?>
                <span class="rating-text tw-text-xs tw-text-slate-500"><?php echo esc_html($rating_text); ?></span>
            </div>
            <?php
            $price = get_post_meta(get_the_ID(), 'product_price', true);
            $price_slik = (int) get_post_meta(get_the_ID(), 'product_price_slik', true);
            $weight = (int) get_post_meta(get_the_ID(), 'product_weight', true);
            if ( $weight < 1 ) {
                $weight = 1000;
            }
            $photo = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <form class="card-footer-line tw-flex tw-flex-col tw-gap-3 tw-pt-1">
                <input type="hidden" name="order_item_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                <input type="hidden" name="order_item_name" value="<?php echo esc_attr( get_the_title() ); ?>">
                <input type="hidden" name="order_item_price" value="<?php echo esc_attr( (int) $price ); ?>">
                <input type="hidden" name="order_item_qty" value="1">
                <input type="hidden" name="order_item_weight" value="<?php echo esc_attr( $weight ); ?>">
                <input type="hidden" name="order_item_photo" value="<?php echo esc_attr( $photo ); ?>">

                <div class="pricing tw-flex tw-flex-col tw-items-start tw-gap-1 tw-w-full tw-text-left">
                    <?php if( $price_slik ): ?>
                        <span class="price_slik tw-text-slate-400 tw-text-xs"><del>Rp <?php echo number_format($price_slik,0,',','.'); ?></del></span>
                    <?php endif; ?>
                    <span class="price tw-font-semibold tw-text-slate-900 tw-text-base tw-tracking-tight">Rp <?php echo number_format($price,0,',','.'); ?></span>
                </div>
                <div class="card-add-wrap tw-w-full">
                    <button type="button" x-on:click="addToCartWA($event.currentTarget)" class="btn btn-sm card-add-btn tw-w-full tw-justify-center tw-inline-flex tw-items-center tw-gap-1 tw-bg-white tw-border tw-border-slate-300 tw-text-slate-600 tw-rounded-full tw-px-3 tw-py-1.5 tw-text-xs tw-font-semibold hover:tw-bg-slate-50 tw-transition-colors">
                        <span class="btn-add-plus tw-text-base tw-leading-none">+</span>
                        <span class="btn-add-text">Add</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
