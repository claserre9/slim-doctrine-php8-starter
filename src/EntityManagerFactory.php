<?php

namespace App;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class EntityManagerFactory
{
    /**
     * Creates a new instance of the EntityManager.
     *
     * @return EntityManager|null The created EntityManager instance.
     *
     */
    public static function create(): EntityManager|null
    {
        $config = new Configuration;

        if (isset($_ENV['APP_REDIS_URL'])) {
            $client = RedisAdapter::createConnection($_ENV['APP_REDIS_URL']);
            $queryCache = new RedisAdapter($client);
            $metadataCache = new RedisAdapter($client);
            $config->setMetadataCache($metadataCache);
            $config->setQueryCache($queryCache);
        }

        if (isset($_ENV['APP_DB_URL'])) {
            $driverImpl = new AttributeDriver([__DIR__ . '/../src/'], true);
            $config->setMetadataDriverImpl($driverImpl);
            $config->setProxyDir(__DIR__ . '/../cache/proxies');
            $config->setProxyNamespace('App\proxies');
            $config->setAutoGenerateProxyClasses(false);
            $dsnParser = new DsnParser();
            $connectionParams = $dsnParser->parse($_ENV['APP_DB_URL']);
            $connection = DriverManager::getConnection($connectionParams);
            $eventManager = new EventManager();
            return new EntityManager($connection, $config, $eventManager);
        }
        return null;
    }
}