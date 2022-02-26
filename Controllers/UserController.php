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
        session_start();
        $_SESSION['id'] = $user['id'];
        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.user.main', $user)
             . $this->loadView('layout.footer');
        // header("Location: ?controller=User&action=main");
    }

    /**
     * 
     */
    public function main()
    {
        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.user.main')
             . $this->loadView('layout.footer');
    }
}
