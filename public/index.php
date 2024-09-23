<?php

use App\controllers\ApiController;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../config/env.php";
require_once __DIR__ . "/../vendor/autoload.php";

$isProduction = isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'production';

try {
    $builder = new ContainerBuilder();
    $builder->addDefinitions(require __DIR__ . "/../config/container.php");
    $container = $builder->build();
    $app = AppFactory::createFromContainer($container);

    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(!$isProduction, false, false)
        ->getDefaultErrorHandler()
        ->forceContentType("application/json");

    $app->get("/", [ApiController::class, 'indexAction']);

    $app->run();
} catch (Exception $e) {}