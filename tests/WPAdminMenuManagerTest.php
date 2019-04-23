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
		$this->assertEquals( '<nav class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'nav' ][ 'class' ] . '" id="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'nav' ][ 'id' ] . '"><ul class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'ul' ][ 'class' ] . '" id="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'ul' ][ 'id' ] . '"><li class="skip-content-item ' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'a' ][ 'class' ] . ' skip-content-link" href="#' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'skip-to-content' ] . '">Skip to Content</a></li><li class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'a' ][ 'class' ] . ' ' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'link-parent' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post</a><ul class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'sublist' ][ 'class' ] . '"><li class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'subitem' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'sublink' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', $header->getMenuContent() );
		ob_start();
		WPAdminMenuManager::printHeaderMenu();
		$this->assertEquals( '<nav class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'nav' ][ 'class' ] . '" id="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'nav' ][ 'id' ] . '"><ul class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'ul' ][ 'class' ] . '" id="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'ul' ][ 'id' ] . '"><li class="skip-content-item ' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'a' ][ 'class' ] . ' skip-content-link" href="#' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'skip-to-content' ] . '">Skip to Content</a></li><li class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'a' ][ 'class' ] . ' ' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'link-parent' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post</a><ul class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'sublist' ][ 'class' ] . '"><li class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'subitem' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'sublink' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', ob_get_clean() );
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

	public function testGetMenuContent()
	{
		WPAdminMenuManager::createAdminMenu( 'get-nav', 'New Menu', [ 'nav' => [ 'class' => 'get-nav' ]]);
		$this->assertEquals( '<nav class="get-nav"><ul><li><a href="https://www.jaimeson-waugh.com">Some Post</a><ul><li><a href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', WPAdminMenuManager::getAdminMenuContent( 'get-nav' ) );
		WPAdminMenuManager::createHeaderMenu();
		$this->assertEquals( '<nav class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'nav' ][ 'class' ] . '" id="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'nav' ][ 'id' ] . '"><ul class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'ul' ][ 'class' ] . '" id="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'ul' ][ 'id' ] . '"><li class="skip-content-item ' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'a' ][ 'class' ] . ' skip-content-link" href="#' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'skip-to-content' ] . '">Skip to Content</a></li><li class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'li' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'a' ][ 'class' ] . ' ' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'link-parent' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post</a><ul class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'sublist' ][ 'class' ] . '"><li class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'subitem' ][ 'class' ] . '"><a class="' . WPAdminMenuManager::HEADER_ATTRIBUTES[ 'sublink' ][ 'class' ] . '" href="https://www.jaimeson-waugh.com">Some Post Child</a></li></ul></li></ul></nav>', WPAdminMenuManager::getHeaderMenuContent() );
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
