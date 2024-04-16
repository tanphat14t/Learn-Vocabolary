<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
	<script>
        var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
    </script>
</head>
<html>

<body>
	<?php
	/**
	 * The template for displaying header.
	 *
	 * @package HelloElementor
	 */

	if (!defined('ABSPATH')) {
		exit; // Exit if accessed directly.
	}
	$site_name = get_bloginfo('name');
	$tagline   = get_bloginfo('description', 'display');
	
	?>
	<header id="primary-header">
		<nav class="navbar navbar-expand-lg navbar-light" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<button class="navbar-toggler btn-toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug'); ?>">
					<?php include get_stylesheet_directory() . '/assets/imgs/icon-bars.svg'; ?>
					<?php include get_stylesheet_directory() . '/assets/imgs/icon-close.svg'; ?>
				</button>

				<a class="navbar-brand" href="/">
					<?php
					$image = get_field('logo-header', 'option');
					$size = 'full';
					if ($image) {
						echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid", "alt" => "header logo"));
					} else {
						//show image default
					} ?>
				</a>

				<a class="navbar-brand alternative" href="/">
					<?php
					$image = get_field('header_logo_alternative', 'option');
					$size = 'full';
					if ($image) {
						echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid"));
					} else {
						//show image default
					} ?>
				</a>

				<?php
				wp_nav_menu(array(
					'theme_location'    => 'max_mega_menu_1',
					'depth'             => 2,
					'container'         => 'div',
					'container_class'   => 'collapse navbar-collapse',
					'menu_class'        => 'header__menu',
				));
				?>
			</div>
		</nav>
	</header>