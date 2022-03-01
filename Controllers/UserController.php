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
     * add new student controller
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
        // var_dump(file_get_contents($_FILES['avatar']['tmp_name']));exit();
        if (($_FILES['avatar']['tmp_name']) !== '')
            $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
        else $avatar = "";
        // echo '<img class="rounded img-fluid" alt="avatar" src="data:image/jpeg;base64,' . base64_encode($avatar) . '">';
        // print_r($_POST);exit();
        $user = $_POST;
        $user['avatar'] = $avatar;
        $user['role'] = 2;
        // array_push($user, $avatar);
        // print_r($user);exit();
        if ($this->userModel->add($user)) {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.add', ['status' => '1'])
                 . $this->loadView('layout.footer');
        }
        else {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.add', ['status' => '0'])
                 . $this->loadView('layout.footer');
        }
    }

    /**
     * view user info page
     */
    public function detail()
    {
        $user = $this->userModel->getUser('id', $_REQUEST['id']);
        $currentUser = $this->getCurrentUser();

        if (!$user) {
            echo 'Error: Can not get user info.';
        }

        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.user.detail', ['user' => $user,
                                                        'currentUser' => $currentUser])
             . $this->loadView('layout.footer');
    }

    /**
     * teacher edit students info
     */
    public function edit()
    {
        // if post param empty, render edit student view 
        if (empty($_POST)) {
            $user = $this->userModel->getUser('id', $_REQUEST['id']);
            
            if (!$user) {
                echo 'Error: Can not get user info.';
            }
    
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.edit', ['user' => $user])
                 . $this->loadView('layout.footer');
        }

        if (($_FILES['avatar']['tmp_name']) !== '') {
            // if avatar was changed
            $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
        }
        else {
            // if avatar was not changed
            $_user = $this->userModel->getUser('id', $_GET['id']);
            $avatar = $_user['avatar'];
        }
        // var_dump($avatar);
        $user = $_POST;
        $user['avatar'] = $avatar;
        $user['role'] = 2;
        $user['id'] = $_GET['id'];
        
        if ($this->userModel->edit($user)) {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.edit', ['user' => $user, 'status' => '1'])
                 . $this->loadView('layout.footer');
        }
        else {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.edit', ['user' => $user, 'status' => '0'])
                 . $this->loadView('layout.footer');
        }
    }

    /**
     * teacher delete students from system
     */
    public function delete()
    {
        $this->userModel->delete($_POST['id']);
        return header("Location: ?controller=User&action=people");
    }

    /**
     * user update info
     */
    public function update()
    {
        // var_dump($_POST);
        if (empty($_POST)) {
            $user = $this->getCurrentUser();

            if (!$user) {
                return 'Error: Can not get user info.';
            }

            return $this->loadView('layout.header')
                . $this->loadView('layout.navbar')
                . $this->loadView('frontend.user.update', ['user' => $user])
                . $this->loadView('layout.footer');
        }
        // var_dump($_POST);exit();

        if (($_FILES['avatar']['tmp_name']) !== '') {
            // if avatar was changed
            $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
        }
        else {
            // if avatar was not changed
            $_user = $this->getCurrentUser();
            $avatar = $_user['avatar'];
        }
        // var_dump($avatar);
        
        $user = $_POST;
        $user['avatar'] = $avatar;

        // var_dump($user);exit();

        if ($this->userModel->edit($user)) {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.update', ['user' => $user, 'status' => '1'])
                 . $this->loadView('layout.footer');
        }
        else {
            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.user.update', ['user' => $user, 'status' => '0'])
                 . $this->loadView('layout.footer');
        }

    }

    /**
     * messenge controller
     */
    public function messenger()
    {

    }

}
