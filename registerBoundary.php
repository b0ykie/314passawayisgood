<?php
    session_start();

    // Check if a message is passed in the URL
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Café Staff Management System</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <!-- HEADER SECTION --> 
        <header>
            <div class="logo">
              
            </div>
            <nav>
                <ul>
                    <li><a href="homeBoundary.php">Home</a></li>
                    
                    <li><a href="aboutUsBoundary.php">About Us</a></li>
                    <li><a href="contactUsBoundary.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-actions">
              <a href="loginBoundary.php" class="login-btn">Login</a>
              <a href="registerBoundary.php" class="register-btn">Register</a>
            </div>
        </header>
        
        <main>
            <div class="registerContain">
                <form action="registerController.php" method="post">
                    <h1>Register</h1>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="v" name="confirm-password" required>

                    <label for="confirm-role">Role</label>
                    <select name="confirm-role" id="role" required>
                        <option value="--- Choose a role ---">--- Choose a role ---</option>
                        <option value="admin">admin</option>
                        <option value="owner">owner</option>
                        <option value="manager">manager</option>
                        <option value="staff">staff</option>
                    </select>

                    <br>
                    <button type="submit">Register</button>
                </form>
            </div>
        </main>

        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>
        
    </body>
</html>