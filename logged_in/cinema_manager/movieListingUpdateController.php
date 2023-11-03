<?php

class movieUpdateController {
    public function updateMovie($movieID, $movieName, $movieDescription, $movieAvailability) {
        // Include the necessary files
        require_once 'movieListEntity.php';

        // Create an instance of the movieList class
        $movie = new movieList();
        /*
        // Check if the movieID exist, update the records
        if ($movie->isMovieIdExist($movieID)) {
            // Add the movie to the database
            $movie->updateMovieToDatabase($movieID,$movieName, $movieAvailability, $movieDescription);
            $message = "Movie listing has been updated";
            header("Location: movieListingUpdateBoundary.php?message=" . urlencode($message));
            exit();
        } 
        else {
            $message = "movieID cannot be found. Please choose a different movieID.";
            header("Location: movieListingUpdateBoundary.php?message=" . urlencode($message));
            exit();
        }
        */

        if (($movie->isMovieIdExist($movieID)) ===TRUE )
        {
            if ( ($movie->isMovieNameCorrespondToCurrentMovieID($movieID, $movieName))===TRUE) 
            {
                $movie->updateMovieToDatabase($movieID, $movieName, $movieAvailability, $movieDescription);
                $message = "Movie listing has been updated";
                header("Location: movieListingUpdateBoundary.php?message=" . urlencode($message));
                exit();
            }
            else
            {
                if (($movie->isMovieNameAlreadyExistsElsewhere($movieID, $movieName))===TRUE) 
                {
                    $message = "Movie name already exists. Please key in a different name.";
                    header("Location: movieListingUpdateBoundary.php?message=" . urlencode($message));
                    exit();
                }
                else
                {
 
                    $movie->updateMovieToDatabase($movieID,$movieName, $movieAvailability, $movieDescription);
                $message = "Movie listing has been updated";
                header("Location: movieListingUpdateBoundary.php?message=" . urlencode($message));
                exit();

                }
            }
        }
        else 
        {
            // return error message
            $message = "movieID cannot be found. Please choose a different movieID.";
            header("Location: movieListingUpdateBoundary.php?message=" . urlencode($message));
            exit();
        }
    
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $movieID = $_POST['movieID'];
    $movieName = $_POST['movieName'];
    $movieDescription = $_POST['movieDescription'];
    $movieAvailability = 1;

    //$movieAvailability = isset($_POST['movieAvailability']) ? 1 : 0;

    // Create an instance of the movieUpdateController class
    $movieUpdateControllerObject = new movieUpdateController();

    // Call the updateMovie function
    $movieUpdateControllerObject->updateMovie($movieID, $movieName, $movieDescription, $movieAvailability);
}
?>
