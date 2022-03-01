<?php

class MessageController extends BaseController
{
    private $messageModel;
    private $userModel;

    /**
     * 
     */
    public function __construct()
    {
        $this->loadModel('MessageModel');
        $this->messageModel = new MessageModel;
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
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

    /**
     * messenger page
     */
    public function messenger()
    {
        

        $user = $this->getCurrentUser();
        // var_dump($user); exit();
        // var_dump($user['id']);
        $messages = $this->messageModel->getMessagesBySender($user['id']);
        $messages = array_reverse($messages);
        // print("<pre>" . print_r($messages, true) . "</pre>"); exit();

        $users = [];    // all users who messaged with $user
        foreach ($messages as $message) {
            if ($user['id'] == $message['idSender']) {
                $user2 = $this->userModel->getUser('id', $message['idReceiver']);
                if(!in_array($user2, $users, true)) {
                    array_push($users, $user2);
                }
            }
            else {
                $user2 = $this->userModel->getUser('id', $message['idSender']);
                if(!in_array($user2, $users, true)) {
                    array_push($users, $user2);
                }
            }
        }
        // print("<pre>" . print_r($users, true) . "</pre>"); exit();

        // render ajax ressponse
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            foreach ($messages as $key => $message) {
                if ($message['idSender'] != $id && $message['idReceiver'] != $id) {
                    unset($messages[$key]);
                }
            }
            // print("<pre>" . print_r($messages, true) . "</pre>"); exit();
            $messages = array_reverse($messages);
            return $this->loadView('frontend.message.show', ['messages' => $messages,
                                                             'user' => $user]);
        }

        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.message.main', ['users' => $users, 
                                                         'messages' => $messages])
             . $this->loadView('layout.footer');
    }

    /**
     * store message to database
     */
    public function send()
    {
        // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
        if (isset($_POST['idSender'], $_POST['idReceiver'], $_POST['content'])) {
            $ms['idSender'] = $_POST['idSender'];
            $ms['idReceiver'] = $_POST['idReceiver'];
            $ms['content'] = $_POST['content'];

            $this->messageModel->insert($ms);

            return header("Location: ?controller=message&action=messenger");
        }
    }

    /**
     * delete message in database
     */
    public function delete()
    {
        if (isset($_POST['id'])) {
            $this->messageModel->deleteById($_POST['id']);

            return header("Location: ?controller=message&action=messenger");
        }
    }

    /**
     * edit message in database
     */
    public function edit()
    {
        // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
        if (isset($_POST['id']) && !isset($_POST['content'])) {
            $message = $this->messageModel->getById($_POST['id']);
            
            // print("<pre>" . print_r($message, true) . "</pre>"); exit();

            return $this->loadView('layout.header')
                 . $this->loadView('layout.navbar')
                 . $this->loadView('frontend.message.edit', $message)
                 . $this->loadView('layout.footer');

            return header("Location: ?controller=message&action=messenger");
        }
        // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
        
        if (isset($_POST['content'])) {
            // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
            $ms['id'] = $_POST['id'];
            $ms['content'] = $_POST['content'];

            $this->messageModel->edit($ms);
            return header("Location: ?controller=message&action=messenger");
        }
    }
}
