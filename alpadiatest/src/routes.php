<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Alpadia\Models\Repositories\MemberModel as MemberModel;
use Alpadia\Controllers\MemberController as MemberController;
use Alpadia\Utils\ErrorHandler as ErrorHandler;

// Routes
// GET =========================================================================
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

$app->get('/members/{id}', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $memberModel = new MemberModel($this->db);
        $members = $memberModel->find((int)$args["id"]);
        $response = $response->withJson($members, $code);

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
