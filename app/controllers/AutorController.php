<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Entities\User;

class AutorController extends Controller
{
    public function run($args)
    {
        if (isset($args[0])) {
            $author = $this->getEntityManager()->getRepository(User::class)->findOneBy(['username' => $args[0]]);
            if(!$author){
                $this->redirect('error');
            }

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
                    ->andWhere('p.author = :author')
                    ->orderBy('p.publish_date', 'DESC')
                    ->setFirstResult($perPage * ($page - 1))
                    ->setMaxResults($perPage)
                    ->setParameter('active', true)
                    ->setParameter('date', new \DateTime())
                    ->setParameter('author', $author)->getQuery()->execute();
    
                $pageCount = ceil($this->getEntityManager()->getRepository(Post::class)->createQueryBuilder('p')
                        ->select('count(p.id) as max')
                        ->where('p.isActive = :active')
                        ->andWhere('p.author = :author')
                        ->andWhere('p.publish_date <= :date')
                        ->setParameter('active', true)
                        ->setParameter('date', new \DateTime())
                        ->setParameter('author', $author)->getQuery()->getSingleScalarResult() / $perPage);
            } catch (QueryException $e) {
                echo $e->getMessage();
            }

            return $this->view('page/author', compact('author', 'posts', 'page', 'pageCount'));
        }
    }
}
