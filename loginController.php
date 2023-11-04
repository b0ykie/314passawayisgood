<?php

    class loginController{

        public function login($usernameVal, $passwordVal, $roleVal){
            
            require_once 'userAccountEntity.php';

            // Instantiate the UserAccount entity
            $user = new User();

            // Retrieve the form data
            $username = $usernameVal;
            $password = $passwordVal;
            $role = $roleVal;

            // Attempt to authenticate the user
            $result = $user->authenticate($username, $password, $role);

            if ($result) {
                
                // Set the username in the session
                session_start();
                $_SESSION['username'] = $result->getUsername(); 
                // Successful login
                
                switch ($result->getRole()) {
                    case 'customer':
                        header('Location: logged_in/cinema_customer/cushomeBoundary.php');
                        exit();
                    case 'admin':
                        header('Location: logged_in/system_admin/adminhomeBoundary.php');
                        exit();
                    case 'owner':
                        header('Location: logged_in/cafe_owner/ownerhomeBoundary.php');
                        exit();
                    case 'manager':
                        header('Location: logged_in/cinema_manager/managerhomeBoundary.php');
                        exit();
                    default:
                        // Invalid role
                        $message = "Invalid role";
                        header("Location: loginBoundary.php?message=" . urlencode($message));
                        exit();
                }
            }

            else {
                // Failed login
                $message = "Either your Username, Password or Role is incorrect.";
                header("Location: loginBoundary.php?message=" . urlencode($message));
            }
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $loginController = new loginController();

    $loginController ->login($username, $password, $role);



?>