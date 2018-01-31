<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Alpadia\Models\Repositories\MemberModel as MemberModel;
use Alpadia\Controllers\MemberController as MemberController;

// Routes
$app->get('/members', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $memberModel = new MemberModel($this->db);
        $members = $memberModel->get();
        $response = $response->withJson($members, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = [
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine()
        ];
        print_r($error);
        exit;
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->post('/members', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $postData = $request->getParsedBody();
        $memberController = new MemberController($this->db);
        $members = $memberController->add($postData);
        $response = $response->withJson($members, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = [
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine()
        ];
        print_r($error);
        exit;
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});
