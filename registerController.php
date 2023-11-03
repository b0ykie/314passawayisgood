<?php
    
    class registerController{

        public function newRegister($usernameVal, $emailVal, $passwordVal, $confirmpasswordVal, $confirmRole) {
            // Retrieve the form data
            $username = $usernameVal;
            $email = $emailVal;
            $password = $passwordVal;
            $confirmpassword = $confirmpasswordVal;
            $role = $confirmRole;

            require_once 'userAccountEntity.php';

            $user = new User();

            if ($user->isUsernameTaken($username)) {
                $message = "Username is already taken. Please choose a different username.";
                header("Location: registerBoundary.php?message=" . urlencode($message));
                exit();
            }

            else if ($user->isEmailTaken($email)) {
                $message = "Email is already taken. Please choose a different Email.";
                header("Location: registerBoundary.php?message=" . urlencode($message));
                exit();
            }

            else if ($password != $confirmpassword) {
                $message = "Password and confirm password do not match.";
                header("Location: registerBoundary.php?message=" . urlencode($message));
                exit();
            }

            else if ($role == "--- Choose a role ---") {
                $message = "Please choose a role.";
                header("Location: registerBoundary.php?message=" . urlencode($message));
                exit();
            }

            else {
                $user->addUserToDatabase($username, $password, $email, $role);
                $message = "Registration success!";
                header("Location: loginBoundary.php?message=" . urlencode($message));
                exit();
            }
        }
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm-password'];
    $confirmrole = $_POST['confirm-role'];

    $registerController = new registerController();

    $registerController ->newRegister($username, $email, $password, $confirmpassword, $confirmrole);


?>

