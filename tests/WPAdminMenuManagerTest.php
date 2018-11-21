<?php

require_once( 'MockWordPress.php' );

use PHPUnit\Framework\TestCase;
use WaughJ\WPAdminMenuManager\WPAdminMenuManager;

class WPAdminMenuManagerTest extends TestCase
{
	public function testHeader()
	{
		$header = WPAdminMenuManager::createHeaderMenu();
		$this->assertTrue( is_a( $header, '\WaughJ\WPAdminMenu\WPAdminMenu' ) );
		$this->assertEquals( '<nav class="' . self::ATTRIBUTES[ 'nav' ][ 'class' ] . '" id="' . self::ATTRIBUTES[ 'nav' ][ 'id' ] . '"><ul class="' . self::ATTRIBUTES[ 'ul' ][ 'class' ] . '" id="' . self::ATTRIBUTES[ 'ul' ][ 'id' ] . '"><li class="skip-content-item ' . self::ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . self::ATTRIBUTES[ 'a' ][ 'class' ] . ' skip-content-link" href="#' . self::ATTRIBUTES[ 'skip-to-content' ] . '">Skip to Content</a></li><li class="' . self::ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . self::ATTRIBUTES[ 'a' ][ 'class' ] . ' ' . self::ATTRIBUTES[ 'link-parent' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post</a><ul class="' . self::ATTRIBUTES[ 'sublist' ][ 'class' ] . '"><li class="' . self::ATTRIBUTES[ 'subitem' ][ 'class' ] . '"><a class="' . self::ATTRIBUTES[ 'sublink' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', $header->getMenuContent() );
		ob_start();
		WPAdminMenuManager::printHeaderMenu();
		$this->assertEquals( '<nav class="' . self::ATTRIBUTES[ 'nav' ][ 'class' ] . '" id="' . self::ATTRIBUTES[ 'nav' ][ 'id' ] . '"><ul class="' . self::ATTRIBUTES[ 'ul' ][ 'class' ] . '" id="' . self::ATTRIBUTES[ 'ul' ][ 'id' ] . '"><li class="skip-content-item ' . self::ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . self::ATTRIBUTES[ 'a' ][ 'class' ] . ' skip-content-link" href="#' . self::ATTRIBUTES[ 'skip-to-content' ] . '">Skip to Content</a></li><li class="' . self::ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . self::ATTRIBUTES[ 'a' ][ 'class' ] . ' ' . self::ATTRIBUTES[ 'link-parent' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post</a><ul class="' . self::ATTRIBUTES[ 'sublist' ][ 'class' ] . '"><li class="' . self::ATTRIBUTES[ 'subitem' ][ 'class' ] . '"><a class="' . self::ATTRIBUTES[ 'sublink' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', ob_get_clean() );
	}

	public function testFooter()
	{
		$footer = WPAdminMenuManager::createFooterMenu();
		$this->assertTrue( is_a( $footer, '\WaughJ\WPAdminMenu\WPAdminMenu' ) );
	}

	public function testNewMenu()
	{
		$new_menu = WPAdminMenuManager::createAdminMenu( 'new-nav', 'New Menu', [ 'nav' => [ 'class' => 'new-nav' ]]);
		$this->assertEquals( '<nav class="new-nav"><ul><li><a href="https://www.jaimeson-waugh.com">Some Post</a><ul><li><a href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', $new_menu->getMenuContent() );
		ob_start();
		WPAdminMenuManager::printAdminMenu( 'new-nav' );
		$this->assertEquals( '<nav class="new-nav"><ul><li><a href="https://www.jaimeson-waugh.com">Some Post</a><ul><li><a href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', ob_get_clean() );
	}

	public function testUninitializedMenu()
	{
		ob_start();
		WPAdminMenuManager::printAdminMenu( 'missing-nav' );
		$this->assertEquals( '', ob_get_clean() );
	}

	const ATTRIBUTES =
	[
		'nav' =>
		[
			'class' => 'header-nav',
			'id' => 'header-nav-1'
		],
		'ul' =>
		[
			'class' => 'header-nav-list',
			'id' => 'header-nav-list-1'
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
}
