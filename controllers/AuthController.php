<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;

class AuthController extends Controller
{
    // Login controller 
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    // Register Controller
    public function register(Request $request)
    {
        $errors = [];
        $UserModal = new UserModel();

        // For req type post
        if ($request->isPost()) {
            $data = $request->getBody();
            $UserModal->loadData($data);

            if ($UserModal->validate() && $UserModal->register()) {
                Application::$app->response->redirect('/');
            }
            return $this->render('register', [
                'model' => $UserModal
            ]);
        }

        // Foe req type get
        elseif ($request->isGet()) {
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $UserModal
            ]);
        }

        // For req type put
        elseif ($request->isPut()) {
            echo "This is put response";
        }

        // For req type patch
        elseif ($request->ispatch()) {
            echo "This is patch response";
        }

        // For req type delete
        elseif ($request->isdelete()) {
            echo "This is delete response";
        }
    }
}
