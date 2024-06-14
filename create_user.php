<?php

if (php_sapi_name() !== 'cli') {
    exit();
}

require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$username = $argv[1];
$password = $argv[2];

$user = new \App\Entities\User();
$user->setUsername($username);
$user->setPassword($password);
$user->setSuperAdmin(true);

$entityManager = \App\Managers\DatabaseManager::getEntityManager();
$entityManager->persist($user);
$entityManager->flush();

echo "Created user with ID " . $user->getId() . "\n";
