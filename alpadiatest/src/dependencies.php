<?php
// DIC configuration

use Alpadia\Controllers\GameController as GameController;
use Alpadia\Controllers\MemberController as MemberController;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;


$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Database - Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$container["MembersController"] = function ($c) {
    $logger = $c->get('logger');
    $table = $c->get('db')->table('members');
    return new MemberController($logger, $table);
};

$container['GamesController'] = function ($c) {
    $logger = $c->get('logger');
    $table = $c->get('db')->table('videogames');
    return new GameController($logger, $table);
};
