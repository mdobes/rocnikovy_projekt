<?php

namespace App\Controllers;

use App\Entities\User;
use App\Managers\LoginManager;
use App\Managers\UserManager;

class LoginController extends Controller
{

    public function run($args)
    {
        if ($_POST) {
            $username = $_POST['username'];
            $manager = new UserManager();
            $user = $this->getEntityManager()->getRepository(User::class)->findOneBy(['username' => $username]);

            if(!$user){
                $this->redirect('login');
            }

            if ($manager->checkLogin($user, $_POST['password'])) {
                if($user->getIsDeleted()){
                    $this->redirect('login');
                }

                LoginManager::login($user->getId());
                $this->redirect('admin');
            }

            $this->redirect('login');
        }

        if (isset($args[0]) && $args[0] == 'logout') {
            LoginManager::logout();
            $this->redirect('');
        }

        return $this->view('auth/login');
    }
}