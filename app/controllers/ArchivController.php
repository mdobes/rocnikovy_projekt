<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Entities\User;
use Doctrine\ORM\Query\QueryException;

class ArchivController extends Controller
{
    public function run($args)
    {
        if (isset($args[0]) && isset($args[1])) {
            if (isset($_GET['strana']) && is_numeric($_GET["strana"]) && $_GET['strana'] > 0) {
                $page = $_GET['strana'];
            } else {
                $page = 1;
            }
            $perPage = $_ENV['POSTS_PER_PAGE'];

            $year = $args[0];
            $month = $args[1];
            try {

                $posts = $this->getEntityManager()->createQueryBuilder()->from(Post::class, 'p')
                    ->select('p')
                    ->where('YEAR(p.publish_date) = :year')
                    ->andWhere('MONTH(p.publish_date) = :month')
                    ->andWhere('p.isActive = :active')
                    ->andWhere('p.publish_date <= :date')
                    ->orderBy('p.publish_date', 'DESC')
                    ->setFirstResult($perPage * ($page - 1))
                    ->setMaxResults($perPage)
                    ->setParameter('year', $year)->setParameter('month', $month)
                    ->setParameter('active', true)->setParameter('date', new \DateTime())->getQuery()->execute();

                $pageCount = ceil($this->getEntityManager()->getRepository(Post::class)->createQueryBuilder('p')
                        ->select('count(p.id) as max')
                        ->where('YEAR(p.publish_date) = :year')
                        ->andWhere('MONTH(p.publish_date) = :month')
                        ->andWhere('p.isActive = :active')
                        ->andWhere('p.publish_date <= :date')
                        ->setParameter('year', $year)->setParameter('month', $month)
                        ->setParameter('active', true)->setParameter('date', new \DateTime())->getQuery()->getSingleScalarResult() / $perPage);
            } catch (QueryException $e) {
                echo $e->getMessage();
            }

            return $this->view('page/archiv', compact('posts', 'year', 'month', 'page', 'pageCount'));
        }

        $this->redirect('');
    }
}
