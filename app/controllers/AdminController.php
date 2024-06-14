<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Entities\PageHistory;
use App\Entities\User;
use App\Managers\LoginManager;
use App\Utils\Utils;

class AdminController extends Controller
{

    public function run($args)
    {
        if (!LoginManager::isLogged()) {
            $this->redirect('login');
        }

        $autopilotres = $this->autopilot($args);
        if ($autopilotres) {
            return $autopilotres;
        }

        return $this->view('admin/index');
    }

    public function posts($args)
    {
        if (isset($args[1])) {
            array_shift($args);
            $autopilotres = $this->autopilot($args, 'posts_');
            if ($autopilotres) {
                return $autopilotres;
            }
        }

        $posts = $this->getEntityManager()->getRepository(Post::class)->findBy([], ['publish_date' => 'DESC']);
        return $this->view('admin/posts/index', compact('posts'));
    }

    public function posts_create($args)
    {
        if ($_POST) {
            $post = new Post();
            $user = LoginManager::getUser();

            $post->setTitle($_POST['title']);
            if ($user->getIsSuperAdmin()) $post->setIsActive(isset($_POST['active']) ? $_POST['active'] : false);
            else $post->setIsActive(false);
            $post->setPublishDate(new \DateTime($_POST['publish-date']));
            $post->setPerex($_POST['perex']);
            $post->setContent($_POST['content']);

            $file = $_FILES['cover'];
            $file['name'] = Utils::getRandomString(20);
            $extension = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));


            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' && $extension != 'gif') {
                $this->redirect('error');
                return;
            }

            $fileTarget = 'uploads/' . $file['name'] . '.' . $extension;

            while (file_exists($fileTarget)) {
                $file['name'] = Utils::getRandomString(20);
                $fileTarget = 'uploads/' . $file['name'] . '.' . $extension;
            }

            move_uploaded_file($file['tmp_name'], $fileTarget);

            $post->setCoverImage('/' . $fileTarget);
            $post->setAuthor($user);
            $this->getEntityManager()->persist($post);

            $this->getEntityManager()->flush();

            $this->redirect('admin/posts');

        }

        return $this->view('admin/posts/create');
    }

    public function posts_edit($args)
    {
        $post = $this->getEntityManager()->getRepository(Post::class)->find($args[1]);
        if (!$post) {
            $this->redirect('error');
        }

        if ($_POST) {
            $user = LoginManager::getUser();

            $post->setTitle($_POST['title']);
            if ($user->getIsSuperAdmin()) $post->setIsActive(isset($_POST['active']) ? $_POST['active'] : false);
            else $post->setIsActive(false);

            $post->setPublishDate(new \DateTime($_POST['publish-date']));
            $post->setPerex($_POST['perex']);
            $post->setContent($_POST['content']);
            $post->setReadingTime($_POST['reading-time']);;

            if ($_FILES['cover']['tmp_name']) {

                $file = $_FILES['cover'];

                $file['name'] = Utils::getRandomString(20);
                $extension = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));

                if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' && $extension != 'gif') {
                    $this->redirect('error');
                    return;
                }

                $fileTarget = 'uploads/' . $file['name'] . '.' . $extension;

                while (file_exists($fileTarget)) {
                    $file['name'] = Utils::getRandomString(20);
                    $fileTarget = 'uploads/' . $file['name'] . '.' . $extension;
                }

                move_uploaded_file($file['tmp_name'], $fileTarget);
                $oldFile = substr($post->getCoverImage(), 1);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                $post->setCoverImage('/' . $fileTarget);

            }

            $this->getEntityManager()->persist($post);
            $this->getEntityManager()->flush();

            $this->redirect('admin/posts');
        }

        return $this->view('admin/posts/edit', compact('post'));
    }

    public function posts_delete($args)
    {
        $post = $this->getEntityManager()->getRepository(Post::class)->find($args[1]);
        if (!$post) {
            $this->redirect('error');
        }

        $this->getEntityManager()->remove($post);
        $this->getEntityManager()->flush();

        $this->redirect('admin/posts');
    }


    public function users($args)
    {
        $user = LoginManager::getUser();
        if (!$user->getIsSuperAdmin()) {
            $this->redirect('error');
        }

        if (isset($args[1])) {
            array_shift($args);
            $autopilotres = $this->autopilot($args, 'users_');
            if ($autopilotres) {
                return $autopilotres;
            }
        }

        $dbUsers = $this->getEntityManager()->getRepository(User::class)->findAll();
        return $this->view('admin/users/index', compact('dbUsers'));
    }

    public function users_create($args)
    {
        if ($_POST) {
            $user = new User();

            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            $user->setSuperAdmin(isset($_POST['super-admin']) ? true : false);

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

            $this->redirect('admin/users');
        }

        return $this->view('admin/users/create');
    }

    public function users_edit($args)
    {
        $user = $this->getEntityManager()->getRepository(User::class)->find($args[1]);
        if (!$user) {
            $this->redirect('error');
        }

        if ($_POST) {

            $user->setUsername($_POST['username']);
            if (!empty($_POST['password'])) {
                $user->setPassword($_POST['password']);
            }

            $user->setSuperAdmin(isset($_POST['super-admin']) ? true : false);
            $user->setIsDeleted(isset($_POST['deleted']) ? false : true);

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

            $this->redirect('admin/users');
        }
        $dbUser = $user;
        return $this->view('admin/users/edit', compact('dbUser'));
    }

    public function users_delete($args)
    {
        $user = $this->getEntityManager()->getRepository(User::class)->find($args[1]);
        if (!$user) {
            $this->redirect('error');
        }

        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();

        $this->redirect('admin/users');
    }
}
