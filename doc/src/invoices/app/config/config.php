<?php
/**
 * @author Peter Catania
 * @version 22.10.2019
 */

/**
 * Error reporting
 *
 * Usefull for see every little problems during development,
 * in production is advised to show only the more serious ones.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Define the URL of the site
 */
define('URL', 'http://localhost/invoices/');

/**
 * Define the ROTT of the site
 */
define('ROOT', '/invoices/app/');

/**
 * CSS Files URL
 *
 * Depends on URL of the site
 */
define('CSS_URL', ROOT.'assets/css/');

/**
 * JS Files URL
 *
 * Depends on URL of the site
 */
define('JS_URL', ROOT.'assets/js/');

/**
 * Vendor files URL
 *
 * Depends on URL of the site
 */
define('VENDOR_URL', ROOT.'assets/vendor/');

/**
 * jQuery URL
 *
 * Needed for Boostrap and oder JS files
 * Depends on VENDER_URL
 * @link https://jquery.com
 */
define('JQUERY_URL', VENDOR_URL.'jquery/jquery-3.4.1.min.js');

/**
 * Popper URL
 *
 * Needed for Boostrap
 * Depends on VENDER_URL
 * @link https://popper.js.org
 */
define('POPPER_URL', VENDOR_URL.'popper/popper.min.js');

/**
 * Font Awesome files URL
 *
 * Provide the icons of the site
 * Depends on VENDER_URL
 * @link https://fontawesome.com
 */
define('FONTAWESOME_URL', VENDOR_URL.'fontawesome/5.11.2/');

/**
 * Bootstrap files URL
 *
 * Framework for Front-End
 * Depends on VENDER_URL
 * @link https://getbootstrap.com
 */
define('BOOTSTRAP_URL', VENDOR_URL.'bootstrap/4.3.1/');



/**
 * Define the constants of the Database
 */
define('MYSQLUSER', 'peter');
define('MYSQLPASS', 'Password&1');
define('DSN', 'mysql:dbname=invoices;host=127.0.0.1');