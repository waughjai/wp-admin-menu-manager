<?php

declare( strict_types = 1 );
namespace WaughJ\WPAdminMenuManager;

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

	public static function createHeaderMenu( ?callable $error_handler = null ) : WPAdminMenu
	{
		return self::createAdminMenu
		(
			self::HEADER_SLUG,
			self::HEADER_TITLE,
			self::HEADER_ATTRIBUTES,
			$error_handler
		);
	}

	public static function createFooterMenu( ?callable $error_handler = null ) : WPAdminMenu
	{
		return self::createAdminMenu
		(
			self::FOOTER_SLUG,
			self::FOOTER_TITLE,
			self::FOOTER_ATTRIBUTES,
			$error_handler
		);
	}

	public static function createAdminMenu( string $slug, string $title, array $attributes = [], ?callable $error_handler = null ) : WPAdminMenu
	{
		self::$menus[ $slug ] = new WPAdminMenu( $slug, $title, $attributes, $error_handler );
		return self::$menus[ $slug ];
	}

	public static function getHeaderMenu()
	{
		return self::getAdminMenu( self::HEADER_SLUG );
	}

	public static function getFooterMenu()
	{
		return self::getAdminMenu( self::FOOTER_SLUG );
	}

	public static function getAdminMenu( string $slug )
	{
		return ( isset( self::$menus[ $slug ] ) ) ? self::$menus[ $slug ] : null;
	}

	public static function getAdminMenuList( string $slug ) : array
	{
		return ( isset( self::$menus[ $slug ] ) ) ? self::$menus[ $slug ]->getMenu() : [];
	}

	public static function getHeaderMenuList() : array
	{
		return self::getAdminMenuList( self::HEADER_SLUG );
	}

	public static function getFooterMenuList() : array
	{
		return self::getAdminMenuList( self::FOOTER_SLUG );
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
