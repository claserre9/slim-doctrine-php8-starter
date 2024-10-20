<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ApiController extends AbstractController
{
    public function indexAction(Request $request, Response $response, $args): ResponseInterface
    {
        return $this->json($response, ["Message" => "Success"]);
    }
}