<?php

namespace App\Controllers;

use App\Entities\Post;

class ClanekController extends Controller
{
    public function run($args)
    {
        if (isset($args[0])) {
            $post = $this->getEntityManager()->getRepository(Post::class)->findOneBy(['slug' => $args[0]]);

            if(!$post){
                $this->redirect('error');
            }

            return $this->view('page/post', compact('post'));
        }
        return $this->redirect('error');
    }
}
