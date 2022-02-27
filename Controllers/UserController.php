<?php

class UserController extends BaseController
{
    private $userModel;

    /**
     * 
     */
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
    }

    /**
     * 
     */
    public function index()
    {
        // return $this->loadView('frontend.user.index',['abc'=>1,2,3]);
    }

    /**
     * login success: redirect to main page
     * login fail: reload login page with failed login message
     */
    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->login($username, $password);

        // login failed
        if (!$user) {
            return $this->loadView('layout.header')
                 . $this->loadView('frontend.index', ['status' => 'failed'])
                 . $this->loadView('layout.footer');
        }
        
        // login success
        $_SESSION['id'] = $user['id'];
        return header("Location: ?controller=User&action=main");
    }

    /**
     * main view after login success
     */
    public function main()
    {
        if (!isset($_SESSION['id'])) {
            return $this->loadView('layout.header') 
                 . $this->loadView('frontend.404')
                 . $this->loadView('layout.footer');
        }
        
        $user = $this->userModel->getUser('id', $_SESSION['id']);

        if (!$user) {
            return $user;
        }

        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.user.main', $user)
             . $this->loadView('layout.footer');
    }

    /**
     * 
     */
    public function logout()
    {
        unset($_SESSION['id']);

        return header("Location: index.php");
    }
}
