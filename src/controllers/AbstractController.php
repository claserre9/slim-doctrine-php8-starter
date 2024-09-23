<?php
namespace App\controllers;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Redis;

/**
 * The AbstractController class is an abstract class that provides common functionality
 * for controllers in a PHP application.
 */
abstract class AbstractController
{
    protected const string JSON_CONTENT_TYPE = 'application/json';

    protected ?ContainerInterface $container;
    protected ?EntityManagerInterface $entityManager;
    protected ?Redis $redis;

    public function getContainer(): ?ContainerInterface
    {
        return $this->container;
    }

    public function getEntityManager(): ?EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function getRedis(): ?Redis
    {
        return $this->redis;
    }

    public function __construct(
        ?ContainerInterface $container,
        ?EntityManagerInterface $entityManager,
        ?Redis $redis
    )
    {
        $this->container = $container;
        $this->entityManager = $entityManager;
        $this->redis = $redis;
    }

    /**
     * Generates a JSON response with the provided payload and status code.
     *
     * @param ResponseInterface $response The response object.
     * @param array|string $payload The JSON payload to be written to the response body.
     * @param int $status The HTTP status code (default: 200).
     * @return ResponseInterface modified response object.
     */
    protected function json(ResponseInterface $response, array|string $payload, int $status = 200): ResponseInterface
    {
        if (is_array($payload)) {
            $payload = json_encode($payload);
        }

        $response->getBody()->write($payload);
        return $this->addJsonHeaders($response, $status);
    }

    /**
     * Adds JSON headers and HTTP status to the response.
     *
     * @param ResponseInterface $response The response object.
     * @param int $status The HTTP status code.
     * @return ResponseInterface modified response object.
     */
    private function addJsonHeaders(ResponseInterface $response, int $status): ResponseInterface
    {
        return $response
            ->withHeader('Content-Type', self::JSON_CONTENT_TYPE)
            ->withStatus($status);
    }
}