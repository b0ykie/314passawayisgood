<?php

class movieSuspendController {
    public function suspendMovie($movieID, $movieAvailability) {
        // Include the necessary files
        require_once 'movieListEntity.php';

        // Create an instance of the fnbType class
        $movie = new movieList();

        // checks if movieID exists first
        if ($movie->isMovieIdExist($movieID)) 
        {
            if ($movie->isMovieAlreadySuspended($movieID)) 
            {
                $message = "Movie has already been suspended previously. Please choose a different Movie to suspend";
                header("Location: movieListingSuspendBoundary.php?message=" . urlencode($message));
                exit();
            } 
            else {
                
                $movie->suspendMovieToDatabase($movieID, $movieAvailability);
                $message = "Movie suspended successfully";
                header("Location: movieListingSuspendBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else {
            
            $message = "Movie does not exist. Please choose a different Movie ID";
            header("Location: movieListingSuspendBoundary.php?message=" . urlencode($message));
            exit();
        }
        


    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $movieID = $_POST['movieID'];
   
    $movieAvailability = 0;
    // Create an instance of the movieSuspendController class
    $movieSuspendControllerObject = new movieSuspendController();

    // Call the suspendMovie function
    $movieSuspendControllerObject->suspendMovie($movieID, $movieAvailability);
}
?>
