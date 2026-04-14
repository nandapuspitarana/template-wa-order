<?php get_header(); ?>

<section class="singular">
    <style>
        /* Copied from product-detail.html */
        .pd-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Main Product Section */
        .product-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 20px 0;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .product-image {
            display: block;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
            border-radius: 12px;
            min-height: 400px;
            height: 100%;
            position: relative;
            overflow: hidden;
            cursor: zoom-in;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            animation: fadeIn 0.6s ease-in;
        }

        /* Lightbox CSS */
        #image-lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            cursor: zoom-out;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        #image-lightbox.active {
            opacity: 1;
        }
        #image-lightbox img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            border-radius: 4px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 15px;
        }

        .breadcrumb a {
            color: #4299e1;
            text-decoration: none;
        }

        .product-title {
            font-size: 32px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .rating-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .rating-text {
            font-size: 14px;
            color: #718096;
        }

        .rating-count {
            font-weight: bold;
            color: #2d3748;
        }

        .product-description {
            color: #4a5568;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        /* Pricing Section */
        .pricing-section {
            background-color: #f7fafc;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .price-label {
            color: #718096;
            font-size: 14px;
        }

        .original-price {
            font-size: 18px;
            color: #a0aec0;
            text-decoration: line-through;
        }

        .discount-badge {
            background-color: #e53e3e;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .final-price {
            font-size: 28px;
            font-weight: bold;
            color: #2d3748;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: <?php echo get_theme_mod('waorder_color_scheme', '#61DDBB'); ?>;
            color: white;
        }

        .btn-primary:hover {
            background-color: <?php echo get_theme_mod('waorder_color_scheme', '#61DDBB'); ?>;
            filter: brightness(90%);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0, 0.1);
        }

        .btn-secondary {
            background-color: <?php echo get_theme_mod('atc_button_bg', '#FA591D'); ?>;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background-color: <?php echo get_theme_mod('atc_button_bg', '#FA591D'); ?>;
            filter: brightness(90%);
            transform: translateY(-2px);
        }

        /* Social Sharing */
        .social-share {
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .share-title {
            font-size: 14px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 12px;
        }

        .share-buttons {
            display: flex;
            gap: 10px;
        }

        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }

        .share-facebook { background-color: #1877f2; }
        .share-twitter { background-color: #1da1f2; }
        .share-whatsapp { background-color: #25d366; }
        .share-link { background-color: #718096; }

        .share-btn:hover { transform: scale(1.1); }

        /* Recommendations Section */
        .recommendations {
            margin-top: 60px;
        }

        .section-title {
            font-size: 28px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 30px;
            text-align: center;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-grid .productbox {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .product-section {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px;
            }
            .product-title { font-size: 24px; }
            .final-price { font-size: 24px; }
            .action-buttons { flex-direction: column; }
            .btn { width: 100%; }
            .product-features { grid-template-columns: 1fr; }
        }

        /* Features Section */
        .product-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin: 40px 0;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
        }
        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 28px;
            color: white;
            transition: transform 0.3s ease;
        }
        .feature-item:hover .feature-icon {
            transform: scale(1.1);
        }
        .feature-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
            color: #2d3748;
        }
        .feature-desc {
            font-size: 14px;
            color: #718096;
            line-height: 1.6;
            max-width: 250px;
        }
    </style>

	<div class="pd-container">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
            <!-- Schema JSON-LD (Preserved) -->
            <script type="application/ld+json">
            <?php
            $post_id = get_the_ID();
            $schema_price = get_post_meta($post_id, 'product_price', true);
            $schema_image = get_the_post_thumbnail_url($post_id, 'full');
            $schema = array(
                '@context' => 'https://schema.org/',
                '@type' => 'Product',
                'name' => get_the_title($post_id),
                'image' => $schema_image ? array($schema_image) : array(),
                'description' => wp_strip_all_tags(get_the_excerpt($post_id)),
                'sku' => (string) $post_id,
                'offers' => array(
                    '@type' => 'Offer',
                    'url' => get_permalink($post_id),
                    'priceCurrency' => 'IDR',
                    'price' => (string) $schema_price,
                    'availability' => (get_post_meta($post_id, 'product_out_stock', true) == 'yes') ? 'https://schema.org/OutOfStock' : 'https://schema.org/InStock',
                ),
            );

            $rating_val = get_post_meta($post_id, 'product_rating_val', true);
            $rating_count = get_post_meta($post_id, 'product_rating_count', true);
            $rating_val_num = is_numeric($rating_val) ? (float) $rating_val : 0;
            $rating_count_num = is_numeric($rating_count) ? (int) $rating_count : 0;

            if ($rating_val_num > 0 && $rating_count_num > 0) {
                $schema['aggregateRating'] = array(
                    '@type' => 'AggregateRating',
                    'ratingValue' => $rating_val_num,
                    'reviewCount' => $rating_count_num,
                );
            }

            $review_text = get_post_meta($post_id, 'product_review', true);
            if (!empty($review_text)) {
                $schema_review = array(
                    '@type' => 'Review',
                    'reviewBody' => wp_strip_all_tags($review_text),
                );
                if ($rating_val_num > 0) {
                    $schema_review['reviewRating'] = array(
                        '@type' => 'Rating',
                        'ratingValue' => $rating_val_num,
                    );
                }
                $schema['review'] = array($schema_review);
            }

            echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            ?>
            </script>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="product-section">
                    <!-- Product Image -->
                    <div class="product-image">
                        <?php
                        $thumbnail_id = get_post_thumbnail_id($post_id);
                        $full_image = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $image_url = $full_image ? $full_image[0] : 'https://via.placeholder.com/400x400/4A5568/FFFFFF?text=No+Image';
                        ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php
						$ribbon = get_post_meta(get_the_ID(), 'product_ribbon', true);
						if( $ribbon ): ?>
							<span class="ribbon" style="position: absolute; top: 20px; left: 20px; z-index: 10;"><small class="text color-scheme-background"><?php echo $ribbon; ?></small></span>
						<?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="product-info">
                        <div>
                            <div class="breadcrumb">
                                <?php
                                if ( function_exists('yoast_breadcrumb') ) {
                                    yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                                } else {
                                    echo '<a href="' . home_url() . '">Beranda</a> / ';
                                    echo get_the_term_list( $post_id, 'product-category', '', ' / ', '' );
                                }
                                ?>
                            </div>

                            <h1 class="product-title"><?php the_title(); ?></h1>

                            <!-- Rating -->
                            <?php
                            $rating_val = get_post_meta($post_id, 'product_rating_val', true);
                            $rating_count = get_post_meta($post_id, 'product_rating_count', true);
                            $rating_val_num = is_numeric($rating_val) ? (float) $rating_val : 5;
                            ?>
                            <div class="rating-section">
                                <div class="stars">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <?php if($i <= $rating_val_num): ?>
                                            <i class="lni lni-star-filled tw-text-amber-400 tw-text-sm"></i>
                                        <?php else: ?>
                                            <i class="lni lni-star-filled tw-text-gray-300 tw-text-sm"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <span class="rating-text">
                                    <span class="rating-count"><?php echo $rating_val ? esc_html($rating_val) : '5'; ?></span>
                                    (<?php echo $rating_count ? esc_html($rating_count) : '469'; ?> penilaian)
                                </span>
                            </div>

                            <!-- Short Description -->
                            <div class="product-description">
                                <?php echo get_the_excerpt(); ?>
                            </div>

                            <form class="orderBox" method="post" enctype="multipart/form-data" id="productData">
                                <?php
                                $thumb                  = wp_get_attachment_image_src(get_post_thumbnail_id($post_id));
                                $is_out_stock           = get_post_meta($post_id, 'product_out_stock', true);
                                $price                  = get_post_meta($post_id, 'product_price', true);
                                $price_slik             = get_post_meta($post_id, 'product_price_slik', true);
                                $size_data              = get_post_meta($post_id, 'product_size', true);
                                $color_data             = get_post_meta($post_id, 'product_color', true);
                                $custom_variable_label  = get_post_meta($post_id, 'product_custom_variable_label', true);
                                $custom_variable_fields = get_post_meta($post_id, 'product_custom_variable_value', true);
                                $product_link_mp        = get_post_meta($post_id, 'product_link_mp', true);
                                $weight = get_post_meta($post_id, 'product_weight', true);
                                $weight = empty($weight) ? 1000 : intval($weight);
                                ?>
                                <input type="hidden" name="order_item_id" value="<?php echo get_the_ID(); ?>">
                                <input type="hidden" name="order_key" value="<?php echo waorder_order_key_generator(); ?>"/>
                                <input type="hidden" name="order_item_price" value="<?php echo $price; ?>"/>
                                <input type="hidden" name="order_item_price_slik" value="<?php echo $price_slik; ?>"/>
                                <input type="hidden" name="order_item_name" value="<?php echo get_the_title(get_the_ID()); ?>"/>
                                <input type="hidden" name="order_item_photo" value="<?php if( isset($thumb[0]) ){ echo $thumb[0];} ?>"/>
                                <input type="hidden" name="order_item_weight" value="<?php echo $weight; ?>"/>

                                <!-- Pricing -->
                                <div class="pricing-section">
                                    <div class="price-row">
                                        <span class="price-label" style="font-weight: bold; color: #2d3748;">Harga:</span>
                                        <div style="text-align: right;">
                                            <?php if($price_slik): ?>
                                                <span class="original-price">Rp <?php echo number_format($price_slik,0,',','.'); ?></span>
                                            <?php endif; ?>
                                            <div class="final-price" id="price-view">Rp <?php echo number_format($price,0,',','.'); ?></div>
                                        </div>
                                    </div>
                                </div>


                                <?php if($color_data ): ?>
                                    <?php $colors = explode(',', $color_data); ?>
                                    <div class="variable tw-mb-4">
                                        <p class="tw-font-bold tw-text-slate-700 tw-mb-2">Warna</p>
                                        <div class="tw-flex tw-gap-2">
                                        <?php foreach( (array)$colors as $key=>$color ): ?>
                                            <?php if( $key == 0 ): ?>
                                                <input type="hidden" name="order_item_color" value="<?php echo $color; ?>"/>
                                            <?php endif; ?>
                                            <label class="variable-option tw-cursor-pointer">
                                                <input type="radio" name="order_color" value="<?php echo $color; ?>" <?php if($key == 0){ echo 'checked="checked"';} ?> onclick="productOptionColor(this);" class="tw-mr-1"><?php echo $color; ?>
                                            </label>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if( $custom_variable_label  ): ?>
                                    <div class="variable tw-mb-4">
                                        <p class="tw-font-bold tw-text-slate-700 tw-mb-2"><?php echo $custom_variable_label; ?></p>
                                        <input type="hidden" name="order_item_custom_name" value="<?php echo $custom_variable_label; ?>"/>
                                        <?php if( isset($custom_variable_fields['chooser']) ): ?>
                                            <div class="tw-flex tw-gap-2">
                                            <?php foreach( (array) $custom_variable_fields['chooser'] as $key=>$val ): ?>
                                                <?php
                                                $pricess = $custom_variable_fields['price'];
                                                $prices = $pricess[$key] ? $pricess[$key] : $price;
                                                ?>
                                                <?php if( $key == 0 ): ?>
                                                    <input type="hidden" name="order_item_custom_value" value="<?php echo $val; ?>"/>
                                                <?php endif; ?>
                                                <label class="variable-option tw-cursor-pointer">
                                                    <input type="radio" name="order_custom" value="<?php echo $val; ?>" <?php if($key == 0){ echo 'checked="checked"';} ?> onclick="productOptionCustom(this, '<?php echo $prices; ?>');" class="tw-mr-1"><?php echo $val; ?>
                                                </label>
                                            <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="variable tw-mb-6">
                                    <p class="tw-font-bold tw-text-slate-700 tw-mb-2">Quantity</p>
                                    <div class="variable-qty clear tw-flex tw-items-center tw-gap-2">
                                        <button type="button" class="minus tw-bg-gray-200 tw-px-3 tw-py-1 tw-rounded" onclick="productOptionQty(this,'minus');">-</button>
                                        <input min="1" type="number" value="1" name="order_item_qty" class="tw-w-16 tw-text-center tw-border tw-rounded tw-py-1">
                                        <button type="button" class="plus tw-bg-gray-200 tw-px-3 tw-py-1 tw-rounded" onclick="productOptionQty(this,'plus');">+</button>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="action-buttons">
                                    <button type="button" class="btn btn-primary" onclick="singleCartWA(this);" <?php if( $is_out_stock == 'yes' ){ echo 'disabled';} ?>>
                                        <i class="lni lni-whatsapp"></i> <?php echo ($is_out_stock == 'yes') ? 'Stok Habis' : 'Pesan Sekarang'; ?>
                                    </button>
                                    <?php if( get_theme_mod('atc_button_enable', 1) && $is_out_stock != 'yes' ){ ?>
                                        <button type="button" class="btn btn-secondary" onclick="addToCartWA(this);">
                                            <i class="lni lni-cart"></i> Tambah Keranjang
                                        </button>
                                    <?php } ?>
                                </div>
                            </form>

                            <!-- Social Share -->
                            <div class="social-share">
                                <div class="share-title">Bagikan ke Media Sosial</div>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" class="share-btn share-facebook" title="Bagikan di Facebook" target="_blank"><i class="lni lni-facebook-filled"></i></a>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?> <?php echo get_the_permalink(); ?>" class="share-btn share-twitter" title="Bagikan di Twitter" target="_blank"><i class="lni lni-twitter-filled"></i></a>
                                    <a href="https://api.whatsapp.com/send?text=<?php echo get_the_title(); ?> <?php echo get_the_permalink(); ?>" class="share-btn share-whatsapp" title="Bagikan di WhatsApp" target="_blank"><i class="lni lni-whatsapp"></i></a>
                                    <button class="share-btn share-link" onclick="navigator.clipboard.writeText('<?php echo get_the_permalink(); ?>'); alert('Link disalin!');" title="Salin Link"><i class="lni lni-link"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Content / Description -->
                <div class="boxdetail tw-bg-white tw-border tw-border-slate-200 tw-rounded-xl tw-p-6 tw-shadow-sm tw-mb-8 tw-mt-8">
                    <div class="contentbox">
                        <h2 class="tw-text-xl tw-font-bold tw-text-slate-800 tw-mb-4 tw-border-b tw-border-slate-100 tw-pb-3">Detail Lengkap</h2>
                        <div class="textbox tw-prose tw-prose-slate tw-max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>

                <!-- Recommendations -->
                <div class="recommendations">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'product-category');
                    if( $categories ):
                        $category_ids = array();
                        foreach($categories as $category) :
                            $category_ids[] = $category->term_id;
                        endforeach;

                        $argss = array(
                            'post_type'      => 'product',
                            'posts_per_page' => 4, // Grid of 4
                            'post__not_in'   => array(get_the_ID()),
                            'post_status'    => 'publish',
                            'tax_query'      => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'product-category',
                                    'field' => 'term_id',
                                    'terms' => $category_ids,
                                )
                            )
                        );

                        $relateds = get_posts( $argss );

                        if( $relateds ):
                            ?>
                            <h2 class="section-title">Produk Rekomendasi</h2>
                            <div class="product-grid">
                                <?php
                                foreach( (array) $relateds as $post ):
                                    setup_postdata($post);
                                    get_template_part('template/productbox');
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            </div>
                            <?php
                        endif;
                    endif;
                    ?>
                </div>

			</article>

		<?php endwhile; endif; ?>

        <?php
        $featured = get_theme_mod('waorder_featured_onoff', 'show');
        if( $featured == 'show' ):
        ?>
        <div class="product-features">
            <div class="feature-item">
                <div class="feature-icon color-scheme-background">
                    <i class="lni <?php echo get_theme_mod('waorder_featured_left_icon', 'lni-checkmark'); ?>"></i>
                </div>
                <div class="feature-title">
                    <?php echo get_theme_mod('waorder_featured_left_title', 'Simple Order'); ?>
                </div>
                <div class="feature-desc">
                    <?php echo get_theme_mod('waorder_featured_left_desc', 'Order cepat tanpa ribet langsung melalui form whatsapp.'); ?>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon color-scheme-background">
                    <i class="lni <?php echo get_theme_mod('waorder_featured_center_icon', 'lni-bolt'); ?>"></i>
                </div>
                <div class="feature-title">
                    <?php echo get_theme_mod('waorder_featured_center_title','Fast Respons'); ?>
                </div>
                <div class="feature-desc">
                    <?php echo get_theme_mod('waorder_featured_center_desc','Kami siap melayani dan merespons order Anda dengan cepat.'); ?>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon color-scheme-background">
                    <i class="lni <?php echo get_theme_mod('waorder_featured_right_icon', 'lni-certificate'); ?>"></i>
                </div>
                <div class="feature-title">
                    <?php echo get_theme_mod('waorder_featured_right_title','Quality Products'); ?>
                </div>
                <div class="feature-desc">
                    <?php echo get_theme_mod('waorder_featured_right_desc','Kami hanya menjual produk yang benar benar bermutu dan berkualitas.'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
	</div>

</section>

<!-- Lightbox Markup -->
<div id="image-lightbox">
    <img src="" alt="Full Image">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var prodImageDiv = document.querySelector('.product-image');
    var lightbox = document.getElementById('image-lightbox');
    var lightboxImg = lightbox.querySelector('img');
    var prodImg = prodImageDiv ? prodImageDiv.querySelector('img') : null;

    if(prodImageDiv && prodImg) {
        prodImageDiv.addEventListener('click', function() {
            lightboxImg.src = prodImg.src;
            lightbox.style.display = 'flex';
            // Trigger reflow
            void lightbox.offsetWidth;
            lightbox.classList.add('active');
        });
    }

    if(lightbox) {
        lightbox.addEventListener('click', function() {
            lightbox.classList.remove('active');
            setTimeout(function(){
                lightbox.style.display = 'none';
            }, 300);
        });
    }
});
</script>

<?php get_footer(); ?>
