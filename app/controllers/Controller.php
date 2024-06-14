<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Managers\DatabaseManager;
use App\Managers\LoginManager;
use Doctrine\ORM\Query\QueryException;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;

abstract class Controller
{

    private $entityManager;

    private $twigLoader;
    private $twig;

    public function __construct()
    {
        $this->entityManager = DatabaseManager::getEntityManager();

        $this->twigLoader = new FilesystemLoader('./resources/views');
        $this->twig = new Environment($this->twigLoader/*, [
           'cache' => './cache/views'
        ]*/);

        $readingTimeFilter = new TwigFilter('readingTime', 'App\Utils\Utils::parseReadingTime');
        $monthFilter = new TwigFilter('month', 'App\Utils\Utils::parseMonth');

        $this->twig->addFilter($readingTimeFilter);
        $this->twig->addFilter($monthFilter);
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function redirect($url)
    {
        header("Location: /{$url}");
        header("Connection: close");
        die;
    }

    abstract function run($args);

    protected function view($view, $args = [])
    {
        $args['path'] = $_SERVER['REQUEST_URI'];

        try {
            $args['archive'] = $this->getEntityManager()->createQueryBuilder()->from(Post::class, 'p')
                ->select('YEAR(p.publish_date) as year,MONTH(p.publish_date) AS month,COUNT(\'*\') AS total')
                ->groupBy('year, month')->where('p.isActive = :active')->andWhere('p.publish_date <= :date')
                ->setParameter('active', true)->setParameter('date', new \DateTime())
                ->getQuery()->execute();
        } catch (QueryException $e) {
            echo $e->getMessage();
        }

        if (LoginManager::isLogged()) {
            $args['user'] = LoginManager::getUser();
        }

        return $this->twig->render($view . '.html.twig', $args);
    }

    protected function autopilot($args, $prefix = '')
    {
        if (!isset($args[0])) {
            return false;
        }
        if (!is_callable(array($this, $prefix . $args[0]))) {
            return false;
        }

        //echo $prefix .  $args[0];
        return $this->{$prefix . $args[0]}($args);
    }
}