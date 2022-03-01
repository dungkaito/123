<?php

class AssignmentController extends BaseController
{
    private $assignmentModel;
    private $userModel;

    public function __construct()
    {
        $this->loadModel('AssignmentModel');
        $this->assignmentModel = new AssignmentModel;
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



    public function add()
    {
        // require_once "./Controllers/ClassworkController.php";
        // $c = new $ClassworkController;
        $user = $this->getCurrentUser();
        $classwork = $this->assignmentModel->getClassworkById($_POST['idClasswork']);
        // print("<pre>" . print_r($classwork, true) . "</pre>"); exit();
        // $classwork = $c
        if (isset($_POST['description'])) {
            if ($this->assignmentModel->checkSubmited($user['id'], $classwork['id'])) {
                return $this->loadView('layout.header')
                    . $this->loadView('layout.navbar')
                    . $this->loadView('frontend.classwork.detail', [
                        'classwork' => $classwork,
                        'error2' => "Bạn đã nộp bài trước đó",
                        'user' => $user
                    ])
                    . $this->loadView('layout.footer');
            }
            // print("<pre>" . print_r(($_FILES), true) . "</pre>"); exit();
            // print("<pre>" . print_r($_POST, true) . "</pre>"); exit();
            $assignment['idStudent'] = $user['id'];
            $assignment['studentName'] = $user['name'];
            $assignment['idClasswork'] = $_POST['idClasswork'];
            $assignment['description'] = $_POST['description'];

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

                $destination = 'public/assignment/' . $filename;


                if (!in_array($extension, ['txt', 'pdf', 'docx', 'zip'])) {
                    $error2 = "Hệ thống chỉ chấp nhận file đính kèm định dạng txt, pdf, doc, docx, zip.";
                } else if ($size > 50000000) {
                    // > 50MB
                    $error2 = "File đính kèm dung lượng quá lớn.";
                } else {
                    if (move_uploaded_file($file, $destination)) {
                        $assignment['attachment'] = $filename;
                        $this->assignmentModel->insert($assignment);
                        return header("Location: ?controller=classwork&action=detail&id={$assignment['idClasswork']}");
                    } else {
                        $error2 = "Upload file thất bại.";
                    }
                }


                // $classwork['attachment'] = file_get_contents($_FILES['file']['tmp_name']);
            } else {
                $assignment['attachment'] = "";
                $this->assignmentModel->insert($assignment);
                return header("Location: ?controller=classwork&action=detail&id={$assignment['idClasswork']}");
            }

            // print("<pre>" . print_r($classwork, true) . "</pre>"); exit();
            return $this->loadView('layout.header')
                . $this->loadView('layout.navbar')
                . $this->loadView('frontend.classwork.detail', [
                    'classwork' => $classwork,
                    'error2' => $error2,
                    'user' => $user
                ])
                . $this->loadView('layout.footer');
        }
    }

    public function detail()
    {
        $assignment = $this->assignmentModel->getById($_GET['id']);
        return $this->loadView('layout.header')
            . $this->loadView('layout.navbar')
            . $this->loadView('frontend.assignment.detail', ['assignment' => $assignment])
            . $this->loadView('layout.footer');
    }

    /**
     * download assignment attachment file
     */
    public function download()
    {
        if (isset($_GET['filename'], $_GET['id'])) {
            $filename = $_GET['filename'];

            $filepath = 'public/assignment/' . $filename;
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
