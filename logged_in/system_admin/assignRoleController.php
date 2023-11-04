<?php
    
    class assignController{

        public function newRegister($usernameVal, $emailVal) {
            // Retrieve the form data
            $username = $usernameVal;
            $email = $emailVal;

            require_once 'userAccountEntity.php';

            $user = new Staff();

            if ($user->addUserToDatabase($username, $email)) {
                $message = "Assignment success!";
                header("Location: adminRoleBoundary.php?message=" . urlencode($message));
            }

            // else {
            //     $user->addUserToDatabase($username, $email);
            //     $message = "Assignment success!";
            //     header("Location: assignRoleBoundary.php?message=" . urlencode($message));
            //     exit();
            // }
        }
    }

    $username = $_POST['userName'];
    $email = $_POST['userEmail'];
    // $password = $_POST['password'];
    // $confirmpassword = $_POST['confirm-password'];
    // $confirmrole = $_POST['confirm-role'];

    $registerController = new assignController();

    $registerController ->newRegister($username, $email);


?>

