<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    
    $studentInstructorNo = $_POST['StudentInstructorNo'];
    $loginType = $_POST['LoginType'];
    $email = $_POST['email'];

    if (empty($studentInstructorNo) || empty($email) || empty($loginType)) {
        $message = [
            'type' => 'error',
            'title' => 'Error',
            'text' => 'Please fill in all fields.'
        ];
    } else {
        // VALIDATE THE LOGIN 
        if ($loginType == 'Student') {
            require("../models/StudentModel.php");
            $studentNo = $_POST['StudentInstructorNo'];
            $studentModel = new StudentModel($db);

            if ($studentModel->validateStudent($studentNo, $email)) {
                $_SESSION['studentNo'] = $studentNo;
                
                $_SESSION['user_type'] = 'student'; 
                header('Location: studentpage.php');
                exit;
            } else {
                $message = [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Invalid credentials for student.'
                ];
            }
        } elseif ($loginType == 'Instructor') {
            require("../models/InstructorModel.php");
            $instructorNo = $_POST['StudentInstructorNo'];
            $instructorModel = new InstructorModel($db);
  
            if ($instructorModel->validateInstructor($instructorNo, $email)) {
                $_SESSION['instructorNo'] = $instructorNo;
                
                $_SESSION['user_type'] = 'instructor'; 
                header('Location: instructorpage.php');
                exit;
            } else {
                $message = [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Invalid credentials for instructor.'
                ];
            }
        }
    }
    $_SESSION['message'] = $message;
}

require("../views/authentication.view.php");

