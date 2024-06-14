<?php

namespace App\Controllers;

use App\Entities\Post;
use Doctrine\ORM\Query\QueryException;

class HomeController extends Controller
{

    public function run($args)
    {
        if (isset($_GET['strana']) && is_numeric($_GET["strana"]) && $_GET['strana'] > 0) {
            $page = $_GET['strana'];
        } else {
            $page = 1;
        }
        $perPage = $_ENV['POSTS_PER_PAGE'];

        try {
            $posts = $this->getEntityManager()->createQueryBuilder()->from(Post::class, 'p')
                ->select('p')
                ->where('p.isActive = :active')
                ->andWhere('p.publish_date <= :date')
                ->orderBy('p.publish_date', 'DESC')
                ->setFirstResult($perPage * ($page - 1))
                ->setMaxResults($perPage)
                ->setParameter('active', true)->setParameter('date', new \DateTime())->getQuery()->execute();

            $pageCount = ceil($this->getEntityManager()->getRepository(Post::class)->createQueryBuilder('p')
                    ->select('count(p.id) as max')
                    ->where('p.isActive = :active')
                    ->andWhere('p.publish_date <= :date')
                    ->setParameter('active', true)->setParameter('date', new \DateTime())->getQuery()->getSingleScalarResult() / $perPage);
        } catch (QueryException $e) {
            echo $e->getMessage();
        }

        //$posts = $this->getEntityManager()->getRepository(Post::class)->findAll();

        return $this->view('page/home', compact('posts', 'page', 'pageCount'));

    }
}
