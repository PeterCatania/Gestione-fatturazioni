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

// setup the autoloading
require_once 'vendor/autoload.php';

// setup Propel
require_once 'generated-conf/config.php';

/**
 * Define the URL of the site
 */
define('URL', 'http://localhost/Gestione-fatturazioni/src/invoices/');

/**
 * Define the ROTT of the site
 */
define('ROOT', '/Gestione-fatturazioni/src/invoices/app/');

/**
 * CSS Files URL
 *
 * Depends on URL of the site
 */
define('CSS_URL', ROOT . 'assets/css/');

/**
 * JS Files URL
 *
 * Depends on URL of the site
 */
define('JS_URL', ROOT . 'assets/js/');

/**
 * Vendor files URL
 *
 * Depends on URL of the site
 */
define('VENDOR_URL', ROOT . 'assets/vendor/');

/**
 * jQuery URL
 *
 * Needed for Boostrap and oder JS files
 * Depends on VENDOR_URL
 * @link https://jquery.com
 */
define('JQUERY_URL', VENDOR_URL . 'jquery/jquery-3.4.1.min.js');

/**
 * Popper URL
 *
 * Needed for Boostrap
 * Depends on VENDOR_URL
 * @link https://popper.js.org
 */
define('POPPER_URL', VENDOR_URL . 'popper/popper.min.js');

/**
 * Font Awesome files URL
 *
 * Provide the icons of the site
 * Depends on VENDOR_URL
 * @link https://fontawesome.com
 */
define('FONTAWESOME_URL', VENDOR_URL . 'fontawesome/5.11.2/');

/**
 * Bootstrap files URL
 *
 * Framework for Front-End
 * Depends on VENDER_URL
 * @link https://getbootstrap.com
 */
define('BOOTSTRAP_URL', VENDOR_URL . 'bootstrap/4.3.1/');

/**
 * Flat UI files URL
 *
 * Framework for Front-End
 * Depends on VENDOR_URL
 * @link https://getbootstrap.com
 */
define('FLATUI_URL', VENDOR_URL . 'flatui/');
define('FLATUI_GLYPS', FLATUI_URL . 'app/fonts/glyphicons/');

/**
 * Define the constants of the Database
 */
define('MYSQLUSER', 'peter');
define('MYSQLPASS', 'Password&1');
define('DSN', 'mysql:dbname=invoices;host=127.0.0.1');

/**
 * Define the default controller and method
 */
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_METHOD', 'index');

/**
 * Define the CSS classes, that indicate that a input is valid or invalid.
 * This classes show the messages contained in the HTML.
 */
define('VALID', 'is-valid');
define('INVALID', 'is-invalid');

// the session variable name, that contains the login data of a User
define('USER_SESSION_DATA', 'user');
// the session variable name, that contains the login data of the Administrator
define('ADMINISTRATOR_SESSION_DATA', 'is-invalid');
