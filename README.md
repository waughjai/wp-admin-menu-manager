WP Admin Menu Manager
=========================

Singleton manager for making and printing admin menus & making them easily accessible to both WordPress Admin & public website.

## Example

    use WaughJ\WPAdminMenuManager\WPAdminMenuManager;

    WPAdminMenuManager::createHeaderMenu();
    WPAdminMenuManager::printHeaderMenu();

    $footer = WPAdminMenuManager::createFooterMenu();
    $footer->printMenu();
    WPAdminMenuManager::printFooterMenu();

    $sidebar_menu = WPAdminMenuManager::createAdminMenu
    (
        'sidebar-nav',
        'Sidebar Menu',
        [ 'nav' => [ 'class' => 'sidebar-nav' ] ]
    );

    // Will be true.
    WPAdminMenuManager::getAdminMenu( 'sidebar-nav' ) === $sidebar_menu;

    $header = WPAdminMenuManager::getHeaderMenu();
    $header_menu_list = WPAdminMenuManager::getHeaderMenuList();

    $footer = WPAdminMenuManager::getFooterMenu();
    $footer_menu_list = WPAdminMenuManager::getFooterMenuList();

    $sidebar_menu_list = WPAdminMenuManager::getAdminMenuList( 'sidebar-nav' );

Handling errors:

    use WaughJ\WPAdminMenu\WPAdminMenuException;

    $widget_menu = WPAdminMenuManager::createAdminMenu
    (
        'widget-nav',
        'Widget Menu',
        [],
        function ( WPAdminMenuException $e )
        {
            MyCustomLogger::log( $e );
        }
    );

## Changelog

### 0.6.0
* Add ability to pass custom error handlers to WPAdminMenu

### 0.5.1
* Update TestHashItem dependency

### 0.5.0
* Add Ability to Get Menu Objects & Menu Lists

### 0.4.0
* Add Current Link Class to Possible Attributes

### 0.3.1
* Update dependencies

### 0.3.0
* Add Getter Methods

### v0.2.0
* Revamp as Manager

### v0.1.0
* Initial version