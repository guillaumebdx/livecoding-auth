<?php


namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{

    public function register()
    {
        return $this->twig->render('User/user_form.html.twig', [
            'action' => 'add',
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $userData    = [];
            $userData['username'] = $_POST['username'];
            $userData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userManager->insert($userData);
            header('Location: /');
        } else {
            echo 'Forbidden method';
        }
    }

    public function login()
    {
        return $this->twig->render('User/user_form.html.twig', [
            'action' => 'check',
        ]);
    }

    public function check()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $userData    = $userManager->selectOneByName($_POST['username']);

            if (!$userData) {
                header('Location: /user/login');
                exit;
            }
            if (password_verify($_POST['password'], $userData['password'])) {
                $_SESSION['username'] = $userData['name'];
                $_SESSION['id'] = $userData['id'];
                header('Location: /');
            } else {
                header('Location: /user/login');
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /user/login');
    }
}
