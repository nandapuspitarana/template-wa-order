<?php
/**
 * Seeder Script for Digital Products
 */

define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');

// Include theme functions for product creation
$theme_path = get_template_directory();
require_once($theme_path . '/inc/product-import.php');

// Required for download_url() and media_handle_sideload()
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

echo "Seeding digital products...\n";

$digital_products = [
    [
        'E-book Panduan WhatsApp Marketing',
        'Pelajari cara jualan laris manis menggunakan WhatsApp. Strategi copywriting dan closing.',
        '49000',
        '150000',
        '', // Color
        'Format', // Custom var name
        'PDF:50000*EPUB:49000', // Custom var value
        'TIDAK', // Out of stock
        'BEST SELLER', // Label
        '0', // Weight
        'Digital*E-book', // Categories
        '', '', '', '', // Links
        'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&q=80&w=300&h=400', // Thumbnail
        '', // Galery
        'Panduan lengkap jualan di WA.' // Excerpt
    ],
    [
        'Plugin Auto Order WhatsApp',
        'Plugin WordPress untuk memudahkan pembeli lari ke WhatsApp secara otomatis.',
        '299000',
        '450000',
        '',
        'Lisensi',
        '1 Domain:299000*Unlimited:999000',
        'TIDAK',
        'REKOMENDASI',
        '0',
        'Digital*Software',
        '', '', '', '',
        'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=400&h=300',
        '',
        'Software penunjang toko online.'
    ],
    [
        'Course Video Digital Marketing',
        'Akses 100+ video pembelajaran marketing digital dari nol sampai pro.',
        '750000',
        '1200000',
        '',
        'Akses',
        'Life-time:750000*1 Tahun:450000',
        'TIDAK',
        'LIMITED',
        '0',
        'Digital*Course',
        '', '', '', '',
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=400&h=300',
        '',
        'Belajar digital marketing sekarang.'
    ]
];

foreach ($digital_products as $product_data) {
    echo "Creating: " . $product_data[0] . "... ";
    $result = waorder_create_product($product_data);
    if (is_numeric($result)) {
        wp_update_post([
            'ID' => $result,
            'post_status' => 'publish'
        ]);
        echo "SUCCESS (ID: $result)\n";
    } else {
        echo "FAILED\n";
    }
}

echo "Seeding complete!\n";
// unlink(__FILE__); // Di-nonaktifkan agar file tidak hilang
