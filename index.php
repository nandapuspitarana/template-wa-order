<?php get_header(); ?>

	<section class="index">

		<div class="wrapper clear">

			<?php
			$sliders = get_option('waorder_sliders');
			?>
			<?php if( $sliders ): ?>
				<div class="slider">
					<?php foreach((array) $sliders as $key=>$val ): ?>
						<?php
						$slider_link = get_post_meta($key, 'slider_link', true);
						?>
						<div class="slide">
							<?php if($slider_link) : ?>
								<a href="<?php echo esc_url($slider_link); ?>" target="_blank"><img class="tns-lazy-img" data-src="<?php echo $val; ?>"></a>
							<?php else: ?>
								<img class="tns-lazy-img" data-src="<?php echo $val; ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => get_option('posts_per_page'),
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'orderby'        => 'date',
			);

			$products = new WP_Query( $args );

			if( $products && null !== $products->have_posts() && $products->have_posts() ):
				?>
				<div class="labelbox">
					<div class="newest">
						<h3>PRODUK TERBARU</h3>
					</div>
				</div>
				<div class="boxcontainer clear">

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<?php get_template_part('template/productbox'); ?>
					<?php endwhile; ?>

				</div>
				<?php echo do_shortcode( '[ajax_load_more id="load-more-product" container_type="div" css_classes="alm-alm-custom" loading_style="infinite fading-circles" post_type="product" posts_per_page="10" offset="10"]' ) ?>
				
				<?php

				$categories = get_theme_mod('homepage_category_list');
				if( $categories ):
					$cats = explode(',', $categories);
					foreach( (array)$cats as $key=>$val ):
						$cc = explode(':', $val);
						if( $cc[1] == '1' || $cc[1] == 1 ):
							waorder_get_product_by_cat($cc[0]);
						endif;
					endforeach;
				endif;
			else:
                ?>
                <div class="boxcontainer clear">

					<?php get_template_part('template/404'); ?>

				</div>
                <?php
			endif;

			wp_reset_postdata();
			?>

		</div>
	</section>

<?php get_footer(); ?>
