<?php

class movieCreateController {
    public function createMovie($movieName, $movieDescription, $movieAvailability) {
        // Include the necessary files
        require_once 'movieListEntity.php';

        // Create an instance of the movieList class
        $movie = new movieList();

        // Check if the movieName is already taken
        if ($movie->isMovieNameTaken($movieName)) {
            $message = "Movie Listing with the same name already created. Please choose a different name.";
            header("Location: movieListingCreateBoundary.php?message=" . urlencode($message));
            exit();
        } 
        else {
            // Add the movie to the database
            $movie->addMovieToDatabase($movieName, $movieDescription, $movieAvailability);
            $message = "New Movie Listing has been created";
            header("Location: movieListingCreateBoundary.php?message=" . urlencode($message));
            exit();
        }
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $movieName = $_POST['movieName'];
    $movieDescription = $_POST['movieDescription'];
    //$movieAvailability = isset($_POST['movieAvailability']) ? 1 : 0;
    $movieAvailability = 1;

    // Create an instance of the movieCreateController class
    $movieCreateControllerObject = new movieCreateController();

    // Call the createMovie function
    $movieCreateControllerObject->createMovie($movieName, $movieDescription, $movieAvailability);
}
?>
