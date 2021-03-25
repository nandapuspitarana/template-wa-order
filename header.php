<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<?php $favicon = get_site_icon_url(); ?>
		<?php if ($favicon) : ?>
			<link href="<?php echo $favicon; ?>" rel="shortcut icon">
		<?php else: ?>
			<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<?php endif; ?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

		<header>
			<div class="header">
				<div class="wrapper clear">

					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<?php $get_logo = get_theme_mod('waorder_logo'); ?>
							<img src="<?php echo $get_logo ? $get_logo : get_template_directory_uri() .'/img/logos.png'; ?>" alt="Logo">
						</a>
					</div>

					<div class="searchbox">
						<form class="header-color-scheme-border" method="get" action="<?php echo home_url(); ?>/product" role="search">
							<input type="search" name="s" placeholder="<?php _e( 'Cari Produk', 'waorder' ); ?>">
							<button type="submit">
								<i class="lni lni-search-alt header-color-scheme-text"></i>
							</button>
						</form>
					</div>

					<div class="nav">
						<i id="nav-menu-toggle" class="lni lni-menu header-color-scheme-text"></i>
						<?php wp_nav_menu(array(
							'theme_location' => 'header-menu',
							'container_id' => 'menu-wrapper',
							'container_class' => 'menu-wrapper',
							'menu_class' => 'menu-list clear wrapper'
						)); ?>
					</div>

					<div class="basket">
						<i class="lni lni-shopping-basket header-color-scheme-text" onclick="openCartWA();"></i>
						<div class="counter-basket-item" id="basketItemsCounter">0</div>
					</div>
				<div>
			</div>
		</header>
