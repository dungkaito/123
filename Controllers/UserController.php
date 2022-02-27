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
     * get POST data, call model to authen user, load view
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
     * call model to get the current logged on user
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

    /**
     * load main page (after login success) view
     * @return string   main page
     */
    public function main()
    {
        $user = $this->getCurrentUser();

        if (!$user) {
            return 'Error: Something wrong with SQL statement.';
        }

        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.user.main', $user)
             . $this->loadView('layout.footer');
    }

    /**
     * unset session, logout
     */
    public function logout()
    {
        unset($_SESSION['id']);

        return header("Location: index.php");
    }

    /**
     * get user from model and load people page view
     * @return string   people page
     */
    public function people()
    {
        $user = $this->getCurrentUser();

        if (!$user) {
            return 'Error: Something wrong with SQL statement.';
        }

        $users = $this->userModel->getAll();

        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.user.people', [
                 'user' => $user,
                 'users' => $users
             ])
             . $this->loadView('layout.footer');
    }

    /**
     * add new student
     */
    public function add()
    {
        // if post param empty, render create student view 
        if (!isset($_POST['name'])) {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.add')
                 . $this->loadView('layout.footer');
        }
        $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
        // echo '<img class="rounded img-fluid" alt="avatar" src="data:image/jpeg;base64,' . base64_encode($avatar) . '">';
        // print_r($_POST);exit();
        $user = $_POST;
        $user['avatar'] = $avatar;
        // array_push($user, $avatar);
        // print_r($user);exit();
        $this->userModel->add($user);
    }
}
