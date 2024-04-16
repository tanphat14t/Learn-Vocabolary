<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

class FrmViewsUpdate extends FrmAddon {

	public $plugin_file;
	public $plugin_name = 'Visual Views';
	public $download_id = 28058856;

	public $version = '5.1.05';

	public function __construct() {
		$this->plugin_file = dirname( dirname( __FILE__ ) ) . '/formidable-views.php';
		parent::__construct();
	}

	public static function load_hooks() {
		new FrmViewsUpdate();
	}
}
