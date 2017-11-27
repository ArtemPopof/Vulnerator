<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 16.11.2017
 * Time: 23:02
 */
require __DIR__ . "/../vendor/autoload.php";

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;

define( 'BASE_PATH', dirname(__DIR__));
define( 'APP_PATH', BASE_PATH . '/app' );

$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers',
        APP_PATH . '/models'
    ]
);

$loader->register();

$di = new FactoryDefault();

$di->set(
    'view',
    function() {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views');
        return $view;
    }
);

$di->set(
    'url',
    function() {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
} catch(Exception $e) {
    echo 'Exception: ', $e->getMessage();
}