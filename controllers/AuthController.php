<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $errors = [];
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $data = $request->getBody();
            $registerModel->loadData($data);

            if ($registerModel->validate() && $registerModel->register()) {
                return "Success";
            }
            return $this->render('register', [
                'model' => $registerModel
            ]);
        } elseif ($request->isGet()) {
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $registerModel
            ]);
        } elseif ($request->isPut()) {
            echo "This is put response";
        } elseif ($request->ispatch()) {
            echo "This is patch response";
        } elseif ($request->isdelete()) {
            echo "This is delete response";
        }
    }
}
