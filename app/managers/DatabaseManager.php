<?php

namespace App\Managers;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;

class DatabaseManager
{

    private static $entityManager;

    public static function getEntityManager()
    {
        if (!isset(self::$entityManager)) {
            $paths = array(__DIR__ . "/app/entities");
            $isDevMode = true;
            $config = ORMSetup::createAttributeMetadataConfiguration(array(__DIR__ . "/app/entities"), $isDevMode);
            $config->setProxyDir('cache/proxy');

            $config->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
            $config->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');

            $dbParams = [
                'driver' => $_ENV['DB_CONNECTION'],
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'user' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'dbname' => $_ENV['DB_DATABASE'],
            ];

            $connection = DriverManager::getConnection($dbParams, $config);

            self::$entityManager = new EntityManager($connection, $config);
        }

        return self::$entityManager;
    }
}
