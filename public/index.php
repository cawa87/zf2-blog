<?php
setlocale(LC_ALL, 'ru_RU.utf8');
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

define('REQUEST_MICROTIME', microtime(true));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

//zf2-developers tolls
//define('REQUEST_MICROTIME', microtime(true));

define('BASE_DIR', dirname(__DIR__));

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
