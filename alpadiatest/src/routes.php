<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Alpadia\Controllers\MemberController as MemberController;
use Alpadia\Controllers\VideogameController as VideogameController;
use Alpadia\Utils\ErrorHandler as ErrorHandler;

// Routes
// DELETE ======================================================================
$app->delete('/members/{id}', function (Request $request, Response $response, array $args) {

    try {
        $code = 400;
        $memberController = new MemberController($this->db);
        if ($memberController->delete((int)$args["id"])) {
            $code = 200;
        }
        $response = $response->withStatus($code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->delete('/videogames/{id}', function (Request $request, Response $response, array $args) {

    try {
        $code = 400;
        $videogameController = new VideogameController($this->db);
        if ($videogameController->delete((int)$args["id"])) {
            $code = 200;
        }
        $response = $response->withStatus($code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

// GET =========================================================================
$app->get('/members/{id}', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $memberController = new MemberController($this->db);
        $member = $memberController->find((int)$args["id"]);
        $response = $response->withJson($member, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->get('/members', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $memberController = new MemberController($this->db);
        $members = $memberController->get();
        $response = $response->withJson($members, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->get('/videogames/{id}', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $videogameController = new VideogameController($this->db);
        $videogame = $videogameController->find((int)$args["id"]);
        $response = $response->withJson($videogame, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->get('/videogames', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $videogameController = new VideogameController($this->db);
        $videogames = $videogameController->get();
        $response = $response->withJson($videogames, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

// POST ========================================================================
$app->post('/members', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $postData = $request->getParsedBody();
        $memberController = new MemberController($this->db);
        $members = $memberController->add($postData);
        $response = $response->withJson($members, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->post('/videogames', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $postData = $request->getParsedBody();
        $videogameController = new VideogameController($this->db);
        $videogame = $videogameController->add($postData);
        $response = $response->withJson($videogame, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});
