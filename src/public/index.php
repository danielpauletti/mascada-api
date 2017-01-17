<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "";
$config['db']['dbname'] = "mascada-api";

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};





$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
	
	//$this->logger->addInfo("Something interesting happened"); //teste de log

    return $response;
});

//Busca todos eventos
$app->get('/eventos', function (Request $request, Response $response) {
    $this->logger->addInfo("Lista de eventos");
    $mapper = new EventosMapper($this->db);
	$controller = new EventosController($mapper, $request, $response);
	return $controller->getEventos();
});

//Busca evento específico
$app->get('/eventos/{id}', function (Request $request, Response $response, $args) {
	$evento_id = (int)$args['id'];
    $this->logger->addInfo("Evento $evento_id");
    $mapper = new EventosMapper($this->db);
	$controller = new EventosController($mapper, $request, $response);
	return $controller->getEventoById($evento_id);
});

//Salva evento
$app->post('/eventos', function (Request $request, Response $response) {
	$mapper = new EventosMapper($this->db);
	$controller = new EventosController($mapper, $request, $response);
	return $controller->saveEvento($request->getParsedBody());
});
$app->run();