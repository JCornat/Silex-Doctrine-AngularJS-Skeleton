<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
         Middlewares
\*-----------------------*/

$checkId = function (Request $request, Application $app) {
    $data = array();
    if(!isset($_SESSION['id'])) {
        $data['message'] = "Connexion nécessaire";
        return $app->json($data, 500);
    }
};


/*-----------------------*\
         API
\*-----------------------*/

$api = $app['controllers_factory'];

$api->get('/{id}', function(Request $request, Application $app, $id) {
    $service = new ExampleService($request, $app);
    echo "AHAH";
    return $service->get($id);
});

$app->mount('/api', $api);


/*-----------------------*\
       Other routes
\*-----------------------*/

$app->get('/', function(Request $request, Application $app) {
    $controller = new IndexController($request, $app);
    return $controller->index();
})->bind('index');

$app->match('/{url}', function(Request $request, Application $app){
    $controller = new IndexController($request, $app);
    return $controller->index();
})->assert('url', '.+');

$app->run();