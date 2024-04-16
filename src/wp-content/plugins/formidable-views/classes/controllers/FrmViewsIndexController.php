<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

class FrmViewsIndexController {

	public static function admin_nav( $args = array() ) {
		self::add_index_script();
		FrmViewsDisplaysController::add_new_button( $args );
		?>
		<div class="frm_hidden">
			<?php FrmFormsHelper::forms_dropdown( 'frm_data_source_form_select_template', '', array( 'inc_children' => 'include' ) ); ?>
		</div>
		<?php
		self::maybe_register_selected_form_name_jsvar();
	}

	public static function admin_footer() {
		if ( ! FrmViewsAppHelper::is_on_views_listing_page() ) {
			return;
		}
		require FrmViewsAppHelper::plugin_path() . '/images/icons.svg';
		self::register_new_view_icons();
	}

	private static function add_index_script() {
		FrmViewsAppHelper::add_modal_css();

		$version = FrmViewsAppHelper::plugin_version();
		wp_register_style( 'formidable_views_index', FrmViewsAppHelper::plugin_url() . '/css/index.css', array(), $version );

		self::register_index_js();

		wp_enqueue_script( 'formidable_views_index' );
		wp_enqueue_style( 'formidable_views_index' );
	}

	private static function maybe_register_selected_form_name_jsvar() {
		$form_id = FrmAppHelper::get_param( 'form', '', 'get', 'absint' );
		if ( ! $form_id ) {
			return;
		}

		$form = FrmForm::getOne( $form_id );
		if ( ! $form ) {
			return;
		}

		echo '<script type="text/javascript">var frmSelectedFormName = ' . wp_json_encode( $form->name ) . ';</script>';
	}

	/**
	 * Register the (possibly minified) main index JavaScript file.
	 */
	private static function register_index_js() {
		$version         = FrmViewsAppHelper::plugin_version();
		$use_minified_js = FrmViewsAppHelper::use_minified_js_file();
		$index_js_path   = FrmViewsAppHelper::plugin_url() . '/js/index' . FrmViewsAppHelper::js_suffix() . '.js';

		if ( ! $use_minified_js ) {
			FrmViewsAppHelper::add_dom_script();
		}

		wp_register_script( 'formidable_views_index', $index_js_path, array( 'wp-i18n' ), $version, true );
	}

	private static function register_new_view_icons() {
		require_once FrmViewsAppHelper::views_path() . '/index/new-view-icons.php';
	}
}
