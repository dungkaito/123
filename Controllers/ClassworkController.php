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
        $user = $this->getCurrentUser();
        $classworks = $this->classworkModel->getAll();
        $classworks = array_reverse($classworks);
        // print("<pre>" . print_r($classworks, true) . "</pre>"); exit();

        return $this->loadView('layout.header')
            . $this->loadView('layout.navbar')
            . $this->loadView('frontend.classwork.main', [
                'classworks' => $classworks,
                'user' => $user
            ])
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

    /**
     * add new classwork
     */
    public function add()
    {
        $user = $this->getCurrentUser();

        if (isset($_POST['title'])) {
            // print("<pre>" . print_r(($_FILES), true) . "</pre>"); exit();
            // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
            $classwork['idTeacher'] = $user['id'];
            $classwork['title'] = $_POST['title'];
            $classwork['description'] = $_POST['description'];

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
                $filename = $filename1 . rand() . '.' . $extension;
                // die($filename);

                $destination = 'public/classwork/' . $filename;


                if (!in_array($extension, ['txt', 'pdf', 'docx', 'zip'])) {
                    $error = "Hệ thống chỉ chấp nhận file đính kèm định dạng txt, pdf, doc, docx, zip.";
                } else if ($size > 50000000) {
                    // > 50MB
                    $error = "File đính kèm dung lượng quá lớn.";
                } else {
                    if (move_uploaded_file($file, $destination)) {
                        $classwork['attachment'] = $filename;
                        $this->classworkModel->insert($classwork);
                        return header("Location: ?controller=classwork&action=main");
                    } else {
                        $error = "Upload file thất bại.";
                    }
                }


                // $classwork['attachment'] = file_get_contents($_FILES['file']['tmp_name']);
            } else {
                $classwork['attachment'] = "";
                $this->classworkModel->insert($classwork);
                return header("Location: ?controller=classwork&action=main");
            }

            // print("<pre>" . print_r($classwork, true) . "</pre>"); exit();
            return $this->loadView('layout.header')
                . $this->loadView('layout.navbar')
                . $this->loadView('frontend.classwork.add', ['error' => $error])
                . $this->loadView('layout.footer');
        }

        return $this->loadView('layout.header')
            . $this->loadView('layout.navbar')
            . $this->loadView('frontend.classwork.add')
            . $this->loadView('layout.footer');
    }

    /**
     * detail a classwork
     */
    public function detail()
    {
        $user = $this->getCurrentUser();
        $classwork = $this->classworkModel->getById($_GET['id']);
        $assignments = $this->classworkModel->getAssignments($classwork['id']);
        // print("<pre>" . print_r($assignments, true) . "</pre>"); exit();
        return $this->loadView('layout.header')
             . $this->loadView('layout.navbar')
             . $this->loadView('frontend.classwork.detail', ['classwork' => $classwork,
                                                             'user' => $user,
                                                             'assignments' => $assignments])
            . $this->loadView('layout.footer');
    }

    /**
     * download classwork attachment file
     */
    public function download()
    {
        // $filename = $_GET['filename'];
        // var_dump($filename);
        if (isset($_GET['filename'], $_GET['id'])) {
            $filename = $_GET['filename'];

            $filepath = 'public/classwork/' . $filename;
            // die($filepath);
            if (file_exists($filepath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($filepath));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));
                readfile($filepath);
            }
        }
    }
}
