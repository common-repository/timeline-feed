<?php
namespace TimelineFeed\Core;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

final class Plugin {
	public static function get_services() {
		return array(
			Classes\Language::class,
			Classes\PostType::class,
			Classes\TimelineFeed::class,
			Classes\Shortcode::class,
			Classes\AssetLoader::class,
		);
	}

	public static function get_admin_services() {
		return array(
			Classes\Metabox::class,
			Classes\AdminColumn::class,
			Classes\AdminActionLink::class,
			Classes\AdminAssetLoader::class,
		);
	}

	public static function init() {
		foreach ( self::get_services() as $class ) {
			self::register_service( new $class );
		}

		if ( is_admin() ) {
			foreach ( self::get_admin_services() as $class ) {
				self::register_service( new $class );
			}
		}
	}

	private static function register_service( Serviceable $service ) {
		$service->register();
	}
}
