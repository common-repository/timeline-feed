<?php
namespace TimelineFeed\Core\Classes;

defined( 'ABSPATH' ) || die();

abstract class BaseController {
	protected $plugin_url;
	protected $plugin_path;
	protected $plugin_base;

	public function __construct() {
		$this->plugin_url  = STTF_PLUGIN_URL;
		$this->plugin_path = STTF_PLUGIN_PATH;
		$this->plugin_base = STTF_PLUGIN_BASE;
	}
}
