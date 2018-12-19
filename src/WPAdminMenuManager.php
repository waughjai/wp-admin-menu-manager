<?php

declare( strict_types = 1 );
namespace WaughJ\WPAdminMenuManager
{
	use WaughJ\WPAdminMenu\WPAdminMenu;

	class WPAdminMenuManager
	{
		public static function printHeaderMenu( $attributes = null ) : void
		{
			self::printAdminMenu( self::HEADER_SLUG, $attributes );
		}

		public static function printFooterMenu( $attributes = null ) : void
		{
			self::printAdminMenu( self::FOOTER_SLUG, $attributes );
		}

		public static function printAdminMenu( string $slug, $attributes = null ) : void
		{
			if ( isset( self::$menus[ $slug ] ) )
			{
				self::$menus[ $slug ]->printMenu( $attributes );
			}
		}

		public static function getHeaderMenuContent( $attributes = null ) : string
		{
			return self::getAdminMenuContent( self::HEADER_SLUG, $attributes );
		}

		public static function getFooterMenuContent( $attributes = null ) : string
		{
			return self::getAdminMenuContent( self::FOOTER_SLUG, $attributes );
		}

		public static function getAdminMenuContent( string $slug, $attributes = null ) : string
		{
			return ( isset( self::$menus[ $slug ] ) ) ? self::$menus[ $slug ]->getMenuContent( $attributes ) : '';
		}

		public static function createHeaderMenu() : WPAdminMenu
		{
			return self::createAdminMenu
			(
				self::HEADER_SLUG,
				self::HEADER_TITLE,
				self::HEADER_ATTRIBUTES
			);
		}

		public static function createFooterMenu() : WPAdminMenu
		{
			return self::createAdminMenu
			(
				self::FOOTER_SLUG,
				self::FOOTER_TITLE,
				self::FOOTER_ATTRIBUTES
			);
		}

		public static function createAdminMenu( string $slug, string $title, array $attributes = [] ) : WPAdminMenu
		{
			self::$menus[ $slug ] = new WPAdminMenu( $slug, $title, $attributes );
			return self::$menus[ $slug ];
		}

		private static $menus = [];

		const HEADER_SLUG = 'header-nav';
		const HEADER_TITLE = 'Header Nav';
		const HEADER_ATTRIBUTES =
		[
			'nav' =>
			[
				'class' => 'header-nav',
				'id' => 'header-nav'
			],
			'ul' =>
			[
				'class' => 'header-nav-list',
				'id' => 'header-nav-list'
			],
			'li' =>
			[
				'class' => 'header-nav-item'
			],
			'a' =>
			[
				'class' => 'header-nav-link'
			],
			'sublist' =>
			[
				'class' => 'header-nav-sublist'
			],
			'subitem' =>
			[
				'class' => 'header-nav-subitem'
			],
			'sublink' =>
			[
				'class' => 'header-nav-sublink'
			],
			'link-parent' =>
			[
				'class' => 'header-nav-link-parent'
			],
			'skip-to-content' => 'main'
		];

		const FOOTER_SLUG = 'footer-nav';
		const FOOTER_TITLE = 'Footer Nav';
		const FOOTER_ATTRIBUTES =
		[
			'nav' =>
			[
				'class' => 'footer-nav',
				'id' => 'footer-nav'
			],
			'ul' => [ 'class' => 'footer-nav-list' ],
			'li' => [ 'class' => 'footer-nav-item' ],
			'a'  => [ 'class' => 'footer-nav-link' ]
		];
	}
}
