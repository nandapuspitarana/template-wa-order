<?php
/**
 * waorder customizer function
 * @package waorder/inc
 * @author Taufik Hidayat <taufik@fiqhidayat.com>
 */

function waorder_customizer_library_options() {

    $options = array();
  	// Stores all the sections to be added
  	$sections = array();
  	// Stores all the panels to be added
  	$panels = array();
  	// Adds the sections to the $options array
  	$options['sections'] = $sections;

  	$panels[] = array(
  		'id' => 'general',
  		'title' => __( 'General', 'waorder' ),
  		'priority' => '30'
  	);

    $sections[] = array(
  		'id' => 'wa_admin',
  		'title' => __( 'Whatsapp Admin Number', 'waorder' ),
  		'priority' => '10',
        'panel' => 'general'
  	);

    $options['waorder_admin_phone'] = array(
  		'id' => 'waorder_admin_phone',
  		'label'   => __( 'Nomor Whatsapp Admin', 'waorder' ),
  		'section' => 'wa_admin',
  		'type'    => 'textarea',
        'description' => 'Jika Nomor whatsapp lebih dari satu, pisahkan dengan koma, contoh: 6298123456789,6281123456789 dan seterusnya'
  	);

    $sections[] = array(
  		'id' => 'order_form',
  		'title' => __( 'Order Form', 'waorder' ),
  		'priority' => '10',
        'panel' => 'general'
  	);

    $options['waorder_greeting_message'] = array(
  		'id' => 'waorder_greeting_message',
  		'label'   => __( 'Salam Pembuka pesan order wahstapp', 'waorder' ),
  		'section' => 'order_form',
  		'type'    => 'text',
        'description' => 'Pesan salam pembuka yang akan muncul otomatis di pesan order whatsapp dari customer'
  	);

    $sections[] = array(
  		'id' => 'facebook_pixel',
  		'title' => __( 'Facebook Pixel', 'waorder' ),
  		'priority' => '10',
        'panel' => 'general'
  	);

    $options['waorder_fbpixel_id'] = array(
  		'id' => 'waorder_fbpixel_id',
  		'label'   => __( 'ID Facebook Pixel', 'waorder' ),
  		'section' => 'facebook_pixel',
  		'type'    => 'text',
        'description' => 'Pesan salam pembuka yang akan muncul otomatis di pesan order whatsapp dari customer'
  	);

    $options['facebook_pixel_line1'] = array(
 		'id' => 'facebook_pixel_line1',
    	'section' => 'facebook_pixel',
    	'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_fbpixel_order_event'] = array(
  		'id' => 'waorder_fbpixel_order_event',
  		'label'   => __( 'On Send WA Facebook Pixel Event', 'waorder' ),
  		'section' => 'facebook_pixel',
  		'type'    => 'select',
        'default'    => 'AddToCart',
        'choices' => array(
            'AddToCart'=> 'Add To Cart',
            'Purchase' => 'Purchase',
        )
  	);

    $sections[] = array(
  		'id' => 'query',
  		'title' => __( 'Query', 'waorder' ),
  		'priority' => '10',
        'panel' => 'general'
  	);

    $options['waorder_product_per_page'] = array(
  		'id' => 'waorder_product_per_page',
  		'label'   => __( 'Produk Per Page Query', 'waorder' ),
  		'section' => 'query',
  		'type'    => 'text',
        'default' => 15,
  	);

    $sections[] = array(
  		'id' => 'color_scheme',
  		'title' => __( 'Color Scheme', 'waorder' ),
  		'priority' => '10',
        'panel' => 'general'
  	);

    $options['waorder_color_scheme'] = array(
  		'id' => 'waorder_color_scheme',
  		'label'   => __( 'Theme Color', 'waorder' ),
  		'section' => 'color_scheme',
  		'type'    => 'color',
        'default' => '#61DDBB',
  	);

    $options['color_scheme_line1'] = array(
       'id' => 'color_scheme_line2',
       'section' => 'color_scheme',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['body_bg'] = array(
  		'id' => 'body_bg',
  		'label'   => __( 'Body Background', 'waorder' ),
  		'section' => 'color_scheme',
  		'type'    => 'color',
        'default' => '#fafafa',
  	);



    $panels[] = array(
  		'id' => 'header',
  		'title' => __( 'Header', 'waorder' ),
  		'priority' => '30'
  	);

    $sections[] = array(
  		'id' => 'header_style',
  		'title' => __( 'Style', 'waorder' ),
  		'priority' => '10',
        'panel' => 'header'
  	);

    $options['header_bg'] = array(
  		'id' => 'header_bg',
  		'label'   => __( 'Header Background', 'waorder' ),
  		'section' => 'header_style',
  		'type'    => 'color',
        'default' => '#ffffff',
  	);

    $options['header_style_line1'] = array(
       'id' => 'header_style_line2',
       'section' => 'header_style',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['header_color_scheme'] = array(
  		'id' => 'header_color_scheme',
  		'label'   => __( 'Header Color Scheme', 'waorder' ),
  		'section' => 'header_style',
  		'type'    => 'color',
        'default' => get_theme_mod('waorder_color_scheme', '#61DDBB'),
  	);

  	$sections[] = array(
  		'id' => 'logo',
  		'title' => __( 'Logo', 'waorder' ),
  		'priority' => '10',
         'panel' => 'header'
  	);
  	$options['waorder_logo'] = array(
  		'id' => 'waorder_logo',
  		'label'   => __( 'Logo', 'waorder' ),
  		'section' => 'logo',
  		'type'    => 'image',
  		'default' => get_template_directory_uri() .'/img/logos.png',
        'description' => 'Upload your site logo'
  	);

    $panels[] = array(
  		'id' => 'product',
  		'title' => __( 'Product', 'waorder' ),
  		'priority' => '31'
  	);

    $sections[] = array(
        'id' => 'product_buy_button',
        'title' => __( 'Buy Button', 'waorder' ),
        'priority' => '10',
        'panel' => 'product'
    );

    $options['buy_button_bg'] = array(
  		'id' => 'buy_button_bg',
  		'label'   => __( 'Background Buy Button', 'waorder' ),
  		'section' => 'product_buy_button',
  		'type'    => 'color',
        'default' => get_theme_mod('waorder_color_scheme', '#61DDBB'),
  	);

    $sections[] = array(
        'id' => 'product_atc_button',
        'title' => __( 'Add To Cart Button', 'waorder' ),
        'priority' => '10',
        'panel' => 'product'
    );

    $options['atc_button_enable'] = array(
  		'id' => 'atc_button_enable',
  		'label'   => __( 'Enable ATC Button?', 'waorder' ),
  		'section' => 'product_atc_button',
  		'type'    => 'checkbox',
        'default' => '1',
  	);

    $options['atc_button_line1'] = array(
       'id' => 'act_button_line2',
       'section' => 'product_atc_button',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['atc_button_bg'] = array(
  		'id' => 'atc_button_bg',
  		'label'   => __( 'Background Color ATC Button', 'waorder' ),
  		'section' => 'product_atc_button',
  		'type'    => 'color',
        'default' => '#FA591D',
  	);

    $panels[] = array(
  		'id' => 'featured',
  		'title' => __( 'Featured', 'waorder' ),
  		'priority' => '31'
  	);

    $sections[] = array(
        'id' => 'featured_style',
        'title' => __( 'Style', 'waorder' ),
        'priority' => '10',
        'panel' => 'featured'
    );

    $options['waorder_featured_onoff'] = array(
  		'id' => 'waorder_featured_onoff',
  		'label'   => __( 'Show or Hide featured', 'waorder' ),
  		'section' => 'featured_style',
  		'type'    => 'radio',
        'default' => 'show',
        'choices' => array(
            'show' => 'Show',
            'hide' => 'Hide',
        )
  	);

    $sections[] = array(
        'id' => 'featured_left',
        'title' => __( 'Left Featured', 'waorder' ),
        'priority' => '10',
        'panel' => 'featured'
    );

    $options['waorder_featured_left_icon'] = array(
        'id' => 'waorder_featured_left_icon',
        'label'   => __( 'Icon', 'waorder' ),
        'section' => 'featured_left',
        'type'    => 'icon-picker',
        'default' => 'lni-checkmark'
    );

    $options['featured_left_line1'] = array(
       'id' => 'featured_left_line1',
       'section' => 'fetaured_left',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_featured_left_title'] = array(
        'id' => 'waorder_featured_left_title',
        'label'   => __( 'Title', 'waorder' ),
        'section' => 'featured_left',
        'type'    => 'text',
        'default' => 'Simple Order',
    );

    $options['featured_left_line2'] = array(
       'id' => 'featured_left_line2',
       'section' => 'fetaured_left',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_featured_left_desc'] = array(
        'id' => 'waorder_featured_left_desc',
        'label'   => __( 'Description', 'waorder' ),
        'section' => 'featured_left',
        'type'    => 'textarea',
        'default' => 'Order cepat tanpa ribet langsung melalui form whatsapp.',
    );

    $sections[] = array(
        'id' => 'featured_center',
        'title' => __( 'Center Featured', 'waorder' ),
        'priority' => '10',
        'panel' => 'featured'
    );

    $options['waorder_featured_center_icon'] = array(
        'id' => 'waorder_featured_center_icon',
        'label'   => __( 'Icon', 'waorder' ),
        'section' => 'featured_center',
        'type'    => 'icon-picker',
        'default' => 'lni-bolt'
    );

    $options['featured_center_line1'] = array(
       'id' => 'featured_center_line1',
       'section' => 'fetaured_center',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_featured_center_title'] = array(
        'id' => 'waorder_featured_center_title',
        'label'   => __( 'Title', 'waorder' ),
        'section' => 'featured_center',
        'type'    => 'text',
        'default' => 'Fast Respons',
    );

    $options['featured_center_line2'] = array(
       'id' => 'featured_left_line2',
       'section' => 'fetaured_center',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_featured_center_desc'] = array(
        'id' => 'waorder_featured_center_desc',
        'label'   => __( 'Description', 'waorder' ),
        'section' => 'featured_center',
        'type'    => 'textarea',
        'default' => 'Kami siap melayani dan merespons order Anda dengan cepat.',
    );

    $sections[] = array(
        'id' => 'featured_right',
        'title' => __( 'Right Featured', 'waorder' ),
        'priority' => '10',
        'panel' => 'featured'
    );

    $options['waorder_featured_right_icon'] = array(
        'id' => 'waorder_featured_right_icon',
        'label'   => __( 'Icon', 'waorder' ),
        'section' => 'featured_right',
        'type'    => 'icon-picker',
        'default' => 'lni-certificate'
    );

    $options['featured_right_line1'] = array(
       'id' => 'featured_right_line1',
       'section' => 'fetaured_right',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_featured_right_title'] = array(
        'id' => 'waorder_featured_right_title',
        'label'   => __( 'Title', 'waorder' ),
        'section' => 'featured_right',
        'type'    => 'text',
        'default' => 'Quality Products',
    );

    $options['featured_right_line2'] = array(
       'id' => 'featured_right_line2',
       'section' => 'fetaured_right',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_featured_right_desc'] = array(
        'id' => 'waorder_featured_right_desc',
        'label'   => __( 'Description', 'waorder' ),
        'section' => 'featured_right',
        'type'    => 'textarea',
        'default' => 'Kami hanya menjual produk yang benar benar bermutu dan berkualitas.',
    );

    $sections[] = array(
  		'id' => 'wa_chat_help',
  		'title' => __( 'Whatsapp Chat Help', 'waorder' ),
  		'priority' => '70',
  	);

    $options['waorder_help_onoff'] = array(
  		'id' => 'waorder_help_onoff',
  		'label'   => __( 'Show or Hide Help Floating Button', 'waorder' ),
  		'section' => 'wa_chat_help',
        'type' => 'radio',
        'default' => 'show',
        'choices' => array(
            'show' => 'Show',
            'hide' => 'Hide',
        )
  	);

    $options['wa_chat_help_line1'] = array(
 		'id' => 'wa_chat_help_line1',
    	'section' => 'wa_chat_help',
    	'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_greeting_help_message'] = array(
  		'id' => 'waorder_greeting_help_message',
  		'label'   => __( 'Salam Pembuka pesan bantuan wahstapp', 'waorder' ),
  		'section' => 'wa_chat_help',
  		'type'    => 'text',
        'default'    => 'Haloo Admin',
        'description' => 'Pesan salam pembuka yang akan muncul otomatis di pesan bantuan whatsapp dari user'
  	);

    $sections[] = array(
  		'id' => 'homepage',
  		'title' => __( 'Homepage', 'waorder' ),
  		'priority' => '80'
  	);

    $options['waorder_nextproduct_text'] = array(
        'id' => 'waorder_nextproduct_text',
        'label'   => __( 'Homepage Next Button Text', 'waorder' ),
        'section' => 'homepage',
        'type'    => 'text',
        'default' => 'Lihat Semua Produk'
    );

    $terms = get_terms( array(
        'taxonomy' => 'product-category',
        'hide_empty' => true,
    ) );

    $choiches = array();

    foreach( (array)$terms as $term ){
        $choiches[$term->term_id] = $term->name;
    }

    $options['homepage_category_list'] = array(
        'id' => 'homepage_category_list',
        'label'   => __( 'Category List', 'waorder' ),
        'description' => 'Check categories bellow to show in homepage',
        'section' => 'homepage',
        'type'    => 'shortable',
        'choices' => $choiches,
    );

     /**
      * footer panel
      * @var [type]
      */
    $panels[] = array(
  		'id' => 'footer',
  		'title' => __( 'Footer', 'waorder' ),
  		'priority' => '999'
  	);

  	$sections[] = array(
  		'id' => 'footer_social',
  		'title' => __( 'Socials Links', 'waorder' ),
  		'priority' => '20',
         'panel' => 'footer'
  	);
  	$options['waorder_social_onoff'] = array(
  		'id' => 'waorder_social_onoff',
  		'label'   => __( 'Show or Hide Social section', 'waorder' ),
  		'section' => 'footer_social',
        'type' => 'radio',
        'choices' => array(
            'show' => 'Show',
            'hide' => 'Hide',
        ),
        'default' => 'show',
  	);

    $options['social_line1'] = array(
       'id' => 'social_line1',
       'section' => 'footer_social',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['social_bg'] = array(
  		'id' => 'social_bg',
  		'label'   => __( 'Background', 'waorder' ),
  		'section' => 'footer_social',
  		'type'    => 'color',
        'default' => '#ffffff',
  	);

    $options['social_line2'] = array(
       'id' => 'social_line2',
       'section' => 'footer_social',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['social_color'] = array(
  		'id' => 'social_color',
  		'label'   => __( 'Color', 'waorder' ),
  		'section' => 'footer_social',
  		'type'    => 'color',
        'default' => '#000',
  	);

    $options['social_line3'] = array(
       'id' => 'social_line3',
       'section' => 'footer_social',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_social_facebook'] = array(
        'id' => 'waorder_social_facebook',
       'label'   => __( 'Facebook Link', 'waorder' ),
       'section' => 'footer_social',
       'type'    => 'text',
       'default' => '#'
    );

    $options['social_line4'] = array(
       'id' => 'social_line4',
       'section' => 'footer_social',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_social_instagram'] = array(
        'id' => 'waorder_social_instagram',
       'label'   => __( 'Instagram Link', 'waorder' ),
       'section' => 'footer_social',
       'type'    => 'text',
       'default' => '#'
    );

    $options['social_line5'] = array(
       'id' => 'social_line5',
       'section' => 'footer_social',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['waorder_social_youtube'] = array(
        'id' => 'waorder_social_youtube',
       'label'   => __( 'Youtube Link', 'waorder' ),
       'section' => 'footer_social',
       'type'    => 'text',
       'default' => '#'
    );

    $sections[] = array(
  		'id' => 'footer_widget',
  		'title' => __( 'Widget', 'waorder' ),
  		'priority' => '20',
        'panel' => 'footer'
  	);

    $options['widgett_bg'] = array(
  		'id' => 'widgett_bg',
  		'label'   => __( 'Background', 'waorder' ),
  		'section' => 'footer_widget',
  		'type'    => 'color',
        'default' => '#ffffff',
  	);

    $options['widgett_line1'] = array(
       'id' => 'widgett_line1',
       'section' => 'footer_widget',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['widgett_color'] = array(
  		'id' => 'widgett_color',
  		'label'   => __( 'Color', 'waorder' ),
  		'section' => 'footer_widget',
  		'type'    => 'color',
        'default' => '#000',
  	);

    $sections[] = array(
  		'id' => 'copyright',
  		'title' => __( 'Copyright', 'waorder' ),
  		'priority' => '20',
         'panel' => 'footer'
  	);

    $options['copyright_background'] = array(
  		'id' => 'copyright_background',
  		'label'   => __( 'Footer Background', 'waorder' ),
  		'section' => 'copyright',
  		'type'    => 'color',
  		'default' => get_theme_mod('waorder_color_scheme', '#61DDBB'),
  	);

    $options['copyright_line1'] = array(
       'id' => 'copyright_line1',
       'section' => 'copyright',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['copyright_text'] = array(
  		'id' => 'waorder_copyright_text',
  		'label'   => __( 'Copyright Text', 'waorder' ),
  		'section' => 'copyright',
  		'type'    => 'textarea',
  		'default' => 'Copyright @ 2019 waorder.com',
         'sanitize_callback' => false,
  	);

    $options['copyright_line2'] = array(
       'id' => 'copyright_line2',
       'section' => 'copyright',
       'type'    => 'content',
        'content' => '<p>' . __( '<hr/>', 'waorder' ) . '</p>',
    );

    $options['copyright_text_color'] = array(
  		'id' => 'copyright_text_color',
  		'label'   => __( 'Footer Text Color', 'waorder' ),
  		'section' => 'copyright',
  		'type'    => 'color',
  		'default' => '#ffffff',
  	);

  	// Adds the sections to the $options array
  	$options['sections'] = $sections;
  	// Adds the panels to the $options array
  	$options['panels'] = $panels;
  	$customizer_library = Customizer_Library::Instance();
  	$customizer_library->add_options( $options );
}
add_action( 'init', 'waorder_customizer_library_options' );


add_action( "customize_register", "waorder_customize_register" );
function waorder_customize_register( $wp_customize ) {
    //$wp_customize->remove_control("header_image");
    // $wp_customize->remove_panel("widgets");

    //$wp_customize->remove_section("colors");
    //$wp_customize->remove_section("background_image");
    $wp_customize->remove_section("static_front_page");
}
