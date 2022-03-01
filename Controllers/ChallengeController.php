<?php

class ChallengeController extends BaseController
{
    private $challengeModel;
    private $userModel;

    public function __construct()
    {
        $this->loadModel('ChallengeModel');
        $this->challengeModel = new ChallengeModel;
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
     * main view (all challenges)
     */
    public function main()
    {
        $user = $this->getCurrentUser();
        $challenges = $this->challengeModel->getAll();
        $challenges = array_reverse($challenges);
        // print("<pre>" . print_r($classworks, true) . "</pre>"); exit();

        return $this->loadView('layout.header')
            . $this->loadView('layout.navbar')
            . $this->loadView('frontend.challenge.main', [
                'challenges' => $challenges,
                'user' => $user
            ])
            . $this->loadView('layout.footer');
    }

    public function add()
    {
        $user = $this->getCurrentUser();
        if (isset($_POST['title'])) {
            // print("<pre>" . print_r(($_FILES), true) . "</pre>"); exit();
            // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
            $challenge['idTeacher'] = $user['id'];
            $challenge['title'] = $_POST['title'];
            $challenge['hint'] = $_POST['hint'];

            if ($_FILES['file']['error'] != 4) {
                // print("<pre>" . print_r($_FILES, true) . "</pre>"); exit();
                $filename = $_FILES['file']['name'];
                $filename1 = pathinfo($filename, PATHINFO_FILENAME);

                // die($filename);

                // die($destination);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                // die($extension);

                $file = $_FILES['file']['tmp_name'];
                $size = $_FILES['file']['size'];
                // var_dump($size);exit();
                $filename = $filename1 . '-' . rand() . '.' . $extension;
                // die($filename);

                $destination = 'public/challenge/' . $filename;


                if (!in_array($extension, ['txt'])) {
                    $error = "Chức năng chỉ chấp nhận định dạng file txt.";
                } else if ($size > 50000000) {
                    // > 50MB
                    $error = "File đính kèm dung lượng quá lớn.";
                } else {
                    if (move_uploaded_file($file, $destination)) {
                        $challenge['attachment'] = $filename;
                        $this->challengeModel->insert($challenge);
                        return header("Location: ?controller=challenge&action=main");
                    } else {
                        $error = "Upload file thất bại.";
                    }
                }


                // $classwork['attachment'] = file_get_contents($_FILES['file']['tmp_name']);
            } else {
                $challenge['attachment'] = "";
                $this->challengeModel->insert($challenge);
                return header("Location: ?controller=challenge&action=main");
            }

            // print("<pre>" . print_r($classwork, true) . "</pre>"); exit();
            return $this->loadView('layout.header')
                . $this->loadView('layout.navbar')
                . $this->loadView('frontend.challenge.add', ['error' => $error])
                . $this->loadView('layout.footer');
        }

        return $this->loadView('layout.header')
            . $this->loadView('layout.navbar')
            . $this->loadView('frontend.challenge.add')
            . $this->loadView('layout.footer');
    }

    public function detail()
    {
        // $user = $this->getCurrentUser();
        $challenge = $this->challengeModel->getById($_GET['id']);
        // print("<pre>" . print_r($assignments, true) . "</pre>"); exit();
        return $this->loadView('layout.header')
            . $this->loadView('layout.navbar')
            . $this->loadView('frontend.challenge.detail', ['challenge' => $challenge])
            . $this->loadView('layout.footer');
    }

    public function submit()
    {
        $id = $_GET['a'];
        $userAns = $_GET['ans'];
        $challenge = $this->challengeModel->getById($id);
        $correctAns = explode("-", $challenge['attachment'])[0];
        // var_dump($userAns, $correctAns); exit();
        // echo $userAns;
        if ($correctAns === $userAns) {

            // var_dump(('public/challenge/' . $challenge['attachment']));exit();
            // var_dump(file_get_contents('public/challenge/' . $challenge['attachment']));exit();
            echo '<h2 class="mt-4">Chính xác!!</h2><pre><p style="text-align: center; font-size: 40px">' . file_get_contents('public/challenge/' . $challenge['attachment']). '</p></pre>';
            // echo '1';
            exit();
        }
        echo '<p style="text-align: center; font-size: 40px">Đáp án không chính xác, hãy xem gợi ý ^^</p>';
    }
    
}
