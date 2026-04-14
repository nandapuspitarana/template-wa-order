<?php

add_action('init', 'waorder_product'); // Add our Product Type
function waorder_product()
{
    if( waorder_lislis() !== 'active' ) return;
    register_post_type('product', // Register Custom Post Type
        array(
        'labels' => array(
            'name'               => __('Product', 'waorder'), // Rename these to suit
            'singular_name'      => __('Product', 'waorder'),
            'add_new'            => __('Add New', 'waorder'),
            'add_new_item'       => __('Add New Product', 'waorder'),
            'edit'               => __('Edit', 'waorder'),
            'edit_item'          => __('Edit Product', 'waorder'),
            'new_item'           => __('New Product', 'waorder'),
            'view'               => __('View Product', 'waorder'),
            'view_item'          => __('View Product', 'waorder'),
            'search_items'       => __('Search Product', 'waorder'),
            'not_found'          => __('No Products found', 'waorder'),
            'not_found_in_trash' => __('No Products found in Trash', 'waorder')
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ),
        'can_export' => true,
        'menu_icon' => 'dashicons-products',
    ));
}


add_action( 'init', 'waorder_product_category_taxonomy', 0 );

function waorder_product_category_taxonomy() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    register_taxonomy('product-category',array('product'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-category' ),
    ));

}

add_action( 'wp_ajax_waorder_product_search', 'waorder_ajax_product_search' );
add_action( 'wp_ajax_nopriv_waorder_product_search', 'waorder_ajax_product_search' );
function waorder_ajax_product_search() {
    $nonce = isset( $_GET['nonce'] ) ? sanitize_text_field( $_GET['nonce'] ) : '';
    if ( ! ( wp_verify_nonce( $nonce, 'noncenonce' ) || wp_verify_nonce( $nonce, 'waordernonce' ) ) ) {
        wp_send_json_error( array( 'message' => 'invalid_nonce' ), 403 );
    }

    $term = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
    if ( $term === '' ) {
        wp_send_json_success( array( 'html' => '' ) );
    }

    $query = new WP_Query(
        array(
            'post_type'      => 'product',
            'posts_per_page' => 20,
            'post_status'    => 'publish',
            's'              => $term,
            'no_found_rows'  => true,
        )
    );

    ob_start();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template/productbox' );
        }
    } else {
        echo '<div class="tw-w-full tw-text-center tw-p-6 tw-text-slate-500">Produk tidak ditemukan</div>';
    }
    wp_reset_postdata();

    wp_send_json_success( array( 'html' => ob_get_clean() ) );
}

add_action( 'wp_ajax_waorder_load_more_product', 'waorder_ajax_load_more_product' );
add_action( 'wp_ajax_nopriv_waorder_load_more_product', 'waorder_ajax_load_more_product' );
function waorder_ajax_load_more_product() {
    $nonce = isset( $_GET['nonce'] ) ? sanitize_text_field( $_GET['nonce'] ) : '';
    if ( ! ( wp_verify_nonce( $nonce, 'noncenonce' ) || wp_verify_nonce( $nonce, 'waordernonce' ) ) ) {
        wp_send_json_error( array( 'message' => 'invalid_nonce' ), 403 );
    }

    $page = isset( $_GET['page'] ) ? absint( $_GET['page'] ) : 1;
    $ppp = get_option('posts_per_page');

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $ppp,
        'post_status'    => 'publish',
        'paged'          => $page,
        'order'          => 'DESC',
        'orderby'        => 'date',
    );

    $query = new WP_Query( $args );

    ob_start();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template/productbox' );
        }
    }
    wp_reset_postdata();

    $html = ob_get_clean();
    $has_more = $query->max_num_pages > $page;

    wp_send_json_success( array( 'html' => $html, 'has_more' => $has_more ) );
}

/*
 * Add a meta box
 */
add_action( 'add_meta_boxes', 'waorder_product_metabox', 0, 2 );
function waorder_product_metabox( $post_type, $post ) {
    add_meta_box('waorder_product_galery',
        'Image Gallery',
        'waorder_product_galery_metabox_view',
        'product',
        'side',
        'default' );

    add_meta_box(
        'waorder_product_details',
        'Product Detail',
        'waorder_product_detail_metabox_view',
        'product',
        'normal',
        'high'
    );

    add_meta_box('waorder_product_mp_link',
        'Link Produk Di Marketplace',
        'waorder_product_link_mp_metabox_view',
        'product',
        'side',
        'low' );
}
function waorder_product_link_mp_metabox_view($post){
    wp_nonce_field('noncenonce','waordernonce');
    $link_default = array(
        'bukalapak' => '',
        'tokopedia' => '',
        'shoppe' => '',
        'lazada' => '',
    );
    $link = get_post_meta($post->ID, 'product_link_mp', true);
    $link = wp_parse_args($link, $link_default);
    ?>
    <div class="waorder">
        <div class="product-link-mp waorder-clearfix">
            <p>
                <label style="font-weight:bold">Bukalapak</label><br/>
                <input type="text" style="width:100%" value="<?php echo $link['bukalapak']; ?>" name="product_link_mp[bukalapak]"><br/>
            </p>
            <p>
                <label style="font-weight:bold">Tokopedia</label><br/>
                <input type="text" style="width:100%" value="<?php echo $link['tokopedia']; ?>" name="product_link_mp[tokopedia]"><br/>
            </p>
            <p>
                <label style="font-weight:bold">Shoppe</label><br/>
                <input type="text" style="width:100%" value="<?php echo $link['shoppe']; ?>" name="product_link_mp[shoppe]"><br/>
            </p>
            <p>
                <label style="font-weight:bold">Lazada</label>
                <input type="text" style="width:100%" value="<?php echo $link['lazada'] ?>" name="product_link_mp[lazada]"><br/>
            </p>
        </div>
    </div>
    <?php
}

function waorder_product_detail_metabox_view($post){
    wp_nonce_field('noncenonce','waordernonce');

    ?>
    <div class="waorder">
        <div class="product-detail waorder-clearfix">
            <div class="tab">
                <button type="button" class="tablinks active" onclick="waorderOpenTab(event, 'pricing')" id="defaultOpen">Harga</button>
                <button type="button" class="tablinks" onclick="waorderOpenTab(event, 'variable')">Variable</button>
                <button type="button" class="tablinks" onclick="waorderOpenTab(event, 'stock')">Stok</button>
                <button type="button" class="tablinks" onclick="waorderOpenTab(event, 'delivery')">Pengiriman</button>
                <button type="button" class="tablinks" onclick="waorderOpenTab(event, 'rating')">Rating</button>
            </div>

            <div id="pricing" class="tabcontent" style="display: block">
                <div class="fieldbox">
                    <label style="font-weight:bold">Harga Jual</label><br/>
                    <input type="number" class="regular-text" value="<?php echo get_post_meta($post->ID, 'product_price', true); ?>" name="product_price" required><br/>
                    <span style="font-style: italic;font-size: 13px;">*Input dalam bilangan bulat, contoh 120000 untuk harga (seratus dua puluh ribu)</span>
                </div>
                <div class="fieldbox">
                    <label style="font-weight:bold">Harga Coret</label><br/>
                    <input type="number" class="regular-text" value="<?php echo get_post_meta($post->ID, 'product_price_slik', true); ?>" name="product_price_slik"><br/>
                    <span style="font-style: italic;font-size: 13px;">*Input dalam bilangan bulat, contoh 120000 untuk harga (seratus dua puluh ribu), kosongkan jika tidak ada harga coret</span>
                </div>
            </div>

            <div id="variable" class="tabcontent">
                <div class="fieldbox">
                    <label style="font-weight:bold">Warna</label>
                    <textarea style="width: 100%" name="product_color"><?php echo get_post_meta($post->ID, 'product_color', true); ?></textarea>
                    <span style="font-style: italic;font-size: 13px;">*Input warna dan pisahkan dengan koma, Contoh : Grey,Ungu,Merah dan seterusnya. Kosongkan jika tidak ada pilihan warna</span>
                </div>
                <!---<div class="fieldbox">
                    <label style="font-weight:bold">Ukuran</label>
                    <textarea style="width: 100%" name="product_size"></?php echo get_post_meta($post->ID, 'product_size', true); ?></textarea>
                    <span style="font-style: italic;font-size: 13px;">*Input ukuran dan pisahkan dengan koma, Contoh : 39,40,42,45 atau S,M,XL dan seterusnya. Kosongkan jika tidak ada pilihan ukuran</span>
                </div>--->
                <div class="fieldbox">
                    <?php $custom_variable_fields =  get_post_meta($post->ID, 'product_custom_variable_value', true); ?>
                    <label style="font-weight:bold">Custom Variable</label>
                    <input type="text" style="width: 100%;margin-bottom: 20px;" name="product_custom_variable_label" value="<?php echo get_post_meta($post->ID, 'product_custom_variable_label', true); ?>" placeholder="Label Name"/>
                    <div id="customvariablebox" class="customvariable">
                        <?php if( isset($custom_variable_fields['chooser']) ): ?>
                            <?php foreach( (array) $custom_variable_fields['chooser'] as $key=>$val ): ?>
                                <?php $prices = $custom_variable_fields['price']; ?>
                                <div class="customvariablefieldbox">
                                    <div class="customvariableinput inpute">
                                        <label>Pilihan</label><br/>
                                        <input type="text" name="product_custom_variable_value[chooser][]" value="<?php echo $val; ?>"/>
                                    </div>
                                    <div class="customvariableinput inpute">
                                        <label>Harga Custom</label><br/>
                                        <input type="number" name="product_custom_variable_value[price][]" value="<?php echo $prices[$key]; ?>"/>
                                    </div>
                                    <div class="customvariableinput trash" onclick="waorderDynamicInputDelete(this);">
                                        <span class="dashicons dashicons-trash"></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <br/>
                    <button type="button" class="button" onclick="waorderDynamicInputAdd(this, 'customvariablebox');" data-fields="<div class='customvariableinput inpute'>
                            <label>Pilihan</label><br/>
                            <input type='text' name='product_custom_variable_value[chooser][]' value=''/>
                        </div>
                        <div class='customvariableinput inpute'>
                            <label>Tambahan Harga</label><br/>
                            <input type='number' name='product_custom_variable_value[price][]' value=''/>
                        </div>
                        <div class='customvariableinput trash' onclick='waorderDynamicInputDelete(this);''>
                            <span class='dashicons dashicons-trash'></span>
                        </div>">Tambah Pilihan</button>
                    <br/>
                    <br/>
                    <span style="font-style: italic;font-size: 13px;">*Pada kolom pilihan, input variable pilihan seperti misal untuk ukuran isi dengan S atau M dan seterusnya</span><br/>
                    <span style="font-style: italic;font-size: 13px;">*Pada kolom Tambahan Harga, input tambahan harga dalam bilangan bulat.</span>
                </div>
            </div>

            <div id="stock" class="tabcontent">
                <div class="fieldbox">
                    <label style="font-weight:bold">Stock Habis ?</label><br/>
                    <input type="hidden" name="product_out_stock" value="no">
                    <input type="checkbox" name="product_out_stock" value="yes" <?php if(get_post_meta($post->ID, 'product_out_stock', true) == 'yes'){echo 'checked="checked"';}?>)>Ya<br/>
                    <span style="font-style: italic;font-size: 13px;">*Centang jika produk ini habis stok</span>
                </div>
                <div class="fieldbox">
                    <label style="font-weight:bold">Label Photo Product</label><br/>
                    <?php
                    $ribbon = get_post_meta($post->ID, 'product_ribbon', true);
                    ?>
                    <input type="radio" name="product_ribbon" value="" <?php if( empty($ribbon) ){ echo 'checked="checked"'; }?>> Non Aktif<br>
                    <input type="radio" name="product_ribbon" value="Terlaris" <?php if( $ribbon == 'Terlaris'){ echo 'checked="checked"'; }?>> Terlaris<br>
                    <input type="radio" name="product_ribbon" value="Promo" <?php if( $ribbon == 'Promo' ){ echo 'checked="checked"'; }?>> Promo
                </div>
            </div>

            <div id="delivery" class="tabcontent">
                <div class="fieldbox">
                    <label style="font-weight:bold">Berat Produk (satuan gram)</label><br/>
                    <?php
                    $weight = get_post_meta($post->ID, 'product_weight', true);
                    $weight = empty($weight) ? 1000 : intval($weight);
                    ?>
                    <input type="number" class="regular-text" value="<?php echo $weight; ?>" name="product_weight" required><br/>
                </div>
            </div>

            <div id="rating" class="tabcontent">
                <div class="fieldbox">
                    <label style="font-weight:bold">Nilai Rating</label><br/>
                    <input type="text" class="regular-text" value="<?php echo get_post_meta($post->ID, 'product_rating_val', true); ?>" name="product_rating_val"><br/>
                    <span style="font-style: italic;font-size: 13px;">*Input nilai rating (contoh: 4.5, 5.0)</span>
                </div>
                <div class="fieldbox">
                    <label style="font-weight:bold">Jumlah Ulasan</label><br/>
                    <input type="number" class="regular-text" value="<?php echo get_post_meta($post->ID, 'product_rating_count', true); ?>" name="product_rating_count"><br/>
                    <span style="font-style: italic;font-size: 13px;">*Input jumlah ulasan (contoh: 469)</span>
                </div>
                <div class="fieldbox">
                    <label style="font-weight:bold">Review Singkat</label><br/>
                    <textarea class="regular-text" name="product_review" rows="4"><?php echo esc_textarea(get_post_meta($post->ID, 'product_review', true)); ?></textarea><br/>
                    <span style="font-style: italic;font-size: 13px;">*Teks ulasan singkat untuk ditampilkan di halaman detail produk</span>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function waorder_product_galery_metabox_view( $post ) {

    wp_nonce_field('noncenonce','waordernonce');

    $ids = get_post_meta($post->ID, 'waorder_gallery_ids', true);

    ?>

    <p><?php
        _e( '<i>Set Images for Image Gallery</i>', 'mytheme' );
    ?></p>

    <div class="waorder">
        <ul id="waorder-gallery-metabox-list" class="waorder-clearfix">
            <?php if ($ids):
                foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value);
                ?>
                    <li>
                        <input type="hidden" name="waorder_gallery_ids[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                        <img src="<?php echo $image[0]; ?>">
                        <div class="remove-image"><span class="dashicons dashicons-trash"></span></div>
                    </li>
                <?php
                endforeach;
            endif;?>
        </ul>
        <a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a>
    </div>
<?php
}
/*
 * Save Meta Box data
 */
add_action('save_post', 'waorder_product_metabox_save');
function waorder_product_metabox_save( $post_id ) {

    if ( !isset( $_POST['waordernonce'] ) ) {
        return $post_id;
    }

    if ( !wp_verify_nonce( $_POST['waordernonce'], 'noncenonce') ) {
        return $post_id;
    }

    if ( isset( $_POST[ 'waorder_gallery_ids' ] ) ) {
        update_post_meta( $post_id, 'waorder_gallery_ids', $_POST['waorder_gallery_ids'] );
    }else{
        update_post_meta( $post_id, 'waorder_gallery_ids', array() );
    }

    if ( isset( $_POST[ 'product_price' ] ) ) {
        update_post_meta( $post_id, 'product_price', sanitize_text_field($_POST['product_price']) );
    }

    if ( isset( $_POST[ 'product_price_slik' ] ) ) {
        update_post_meta( $post_id, 'product_price_slik', sanitize_text_field($_POST['product_price_slik']) );
    }

    if ( isset( $_POST[ 'product_discount' ] ) ) {
        update_post_meta( $post_id, 'product_discount', sanitize_text_field($_POST['product_discount']) );
    }

    if ( isset( $_POST[ 'product_size' ] ) ) {
        update_post_meta( $post_id, 'product_size', sanitize_text_field($_POST['product_size']) );
    }

    if ( isset( $_POST[ 'product_color' ] ) ) {
        update_post_meta( $post_id, 'product_color', sanitize_text_field($_POST['product_color']) );
    }

    if ( isset( $_POST[ 'product_custom_variable_label' ] ) ) {
        update_post_meta( $post_id, 'product_custom_variable_label', sanitize_text_field($_POST['product_custom_variable_label']) );
    }

    if ( isset( $_POST[ 'product_custom_variable_value' ] ) ) {
        update_post_meta( $post_id, 'product_custom_variable_value', $_POST['product_custom_variable_value'] );
    }

    if ( isset( $_POST[ 'product_out_stock' ] ) ) {
        update_post_meta( $post_id, 'product_out_stock', sanitize_text_field($_POST['product_out_stock']) );
    }

    if ( isset( $_POST[ 'product_link_mp' ] ) ) {
        update_post_meta( $post_id, 'product_link_mp', $_POST['product_link_mp'] );
    }

    if ( isset( $_POST[ 'product_weight' ] ) ) {
        update_post_meta( $post_id, 'product_weight', intval($_POST['product_weight']) );
    }

    if ( isset( $_POST[ 'product_ribbon' ] ) ) {
        update_post_meta( $post_id, 'product_ribbon', sanitize_text_field($_POST['product_ribbon']) );
    }

    if ( isset( $_POST[ 'product_rating_val' ] ) ) {
        update_post_meta( $post_id, 'product_rating_val', sanitize_text_field($_POST['product_rating_val']) );
    }

    if ( isset( $_POST[ 'product_rating_count' ] ) ) {
        update_post_meta( $post_id, 'product_rating_count', sanitize_text_field($_POST['product_rating_count']) );
    }

    if ( isset( $_POST[ 'product_review' ] ) ) {
        update_post_meta( $post_id, 'product_review', sanitize_textarea_field($_POST['product_review']) );
    }

}
