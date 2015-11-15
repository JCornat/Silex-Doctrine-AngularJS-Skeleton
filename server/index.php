<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Access-Control-Allow-Origin: *");

require "bootstrap.php";

use \Symfony\Component\HttpFoundation\Request;
use \Silex\Application;
use \Application\Controller\IndexController;
use \Application\Service\ExampleService;

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new Silex\Provider\ValidatorServiceProvider());

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']));
}


/*-----------------------*\
         API
\*-----------------------*/

$api = $app['controllers_factory'];

$api->get('/{id}', function(Request $request, Application $app, $id) {
    $service = new ExampleService($request, $app);
    return $service->get($id);
});

$app->mount('/api', $api);

$app->run();