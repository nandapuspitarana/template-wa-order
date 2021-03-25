<?php

function waorder_get_product_by_cat($cat_id){
    $term = get_term( $cat_id );
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'date',
        'tax_query'      => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product-category',
                'field' => 'term_id',
                'terms' => $cat_id,
            )
        )
    );

    $products = new WP_Query( $args );

    if( $products && null !== $products->have_posts() && $products->have_posts() ):
        ?>
        <div class="indexcat">
            <div class="labelbox">
                <div class="category">
                    <h3><?php echo $term->name; ?></h3>
                    <div class="view-all">
                        <a href="<?php echo get_term_link($term->term_id); ?>">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div id="indexcat" class="indexcatbox">
                <div class="arrow arrow-left">
                    <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 0 0 0 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg>
                </div>
                <div class="boxcatcontainer clear">
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <?php get_template_part('template/productbox'); ?>
                    <?php endwhile; ?>
                </div>
                <div class="arrow arrow-right">
                    <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 0 0 302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 0 0 0-50.4z"></path></svg>
                </div>
            </div>
        </div>
        <?php
    endif;
}
