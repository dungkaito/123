<?php

class ClassworkController extends BaseController
{
    private $classworkModel;
    private $userModel;

    /**
     * 
     */
    public function __construct()
    {
        $this->loadModel('ClassworkModel');
        $this->classworkModel = new ClassworkModel;
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
    }

    /**
     * main view (all classworks)
     */
    public function main()
    {
        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.classwork.main')
             . $this->loadView('layout.footer');
    }

    /**
     * call user model to get the current logged on user
     * @return array    user's info
     */
    public function getCurrentUser()
    {
        if (!isset($_SESSION['id'])) {
            return $this->loadView('layout.header') 
                 . $this->loadView('frontend.404')
                 . $this->loadView('layout.footer');
        }
        
        return $this->userModel->getUser('id', $_SESSION['id']);
    }

    public function add()
    {
        if (isset($_POST['title'])) {
            print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
        }
        $user = $this->getCurrentUser();
        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.classwork.add')
             . $this->loadView('layout.footer');
    }
}
