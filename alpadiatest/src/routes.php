<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Alpadia\Utils\ErrorHandler as ErrorHandler;

// Routes
// DELETE ======================================================================
$app->delete('/members/{id}', function (Request $request, Response $response, array $args) {

    try {
        $this->MembersController->delete((int)$args["id"]);
        $code = $this->MembersController->code;
        $response = $response->withStatus($code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->delete('/members/{member_id}/games/{game_id}', function (Request $request, Response $response, array $args) {

    try {
        $this->MembersController->deleteGame((int)$args["member_id"],(int)$args["game_id"]);
        $code = $this->MembersController->code;
        $response = $response->withStatus($code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->delete('/games/{id}', function (Request $request, Response $response, array $args) {

    try {
        $this->GamesController->delete((int)$args["id"]);
        $code = $this->GamesController->code;
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
$app->get('/games/{id}', function (Request $request, Response $response, array $args) {

    try {
        $game = $this->GamesController->find((int)$args["id"]);
        $code = $this->GamesController->code;
        $response = $response->withJson($game, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->get('/games', function (Request $request, Response $response, array $args) {

    try {
        $games = $this->GamesController->get();
        $response = $response->withJson($games);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->get('/members/{id}/games', function (Request $request, Response $response, array $args) {

    try {
        $member = $this->MembersController->findGames((int)$args["id"]);
        $code = $this->MembersController->code;
        $response = $response->withJson($member, $code);

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
        $member = $this->MembersController->find((int)$args["id"]);
        $code = $this->MembersController->code;
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
        $memberController = $this->MembersController;
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

// PATCH =======================================================================
$app->patch('/members/{id}', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $postData = $request->getParsedBody();
        $memberController = $this->MembersController;
        $member = $memberController->update((int)$args["id"], $postData);
        $response = $response->withJson($member, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->patch('/games/{id}', function (Request $request, Response $response, array $args) {

    try {
        $postData = $request->getParsedBody();
        $game = $this->GamesController->update((int)$args["id"], $postData);
        $code = $this->GamesController->code;
        $response = $response->withJson($game, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

// POST ========================================================================
$app->post('/members/{id}/games', function (Request $request, Response $response, array $args) {

    try {
        $postData = $request->getParsedBody();
        $members = $this->MembersController->addGames((int)$args["id"], $postData);
        $code = $this->MembersController->code;
        $response = $response->withJson($members, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});

$app->post('/members', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $postData = $request->getParsedBody();
        $memberController = $this->MembersController;
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

$app->post('/games', function (Request $request, Response $response, array $args) {

    try {
        $code = 200;
        $postData = $request->getParsedBody();
        $game = $this->GamesController->add($postData);
        $response = $response->withJson($game, $code);

    } catch (\Throwable $e) {
        $code = 500;
        $error = ErrorHandler::getErrorMessage($e);
        $response = $response->withJson($error, $code);
    }

    // return response
    return $response;
});
