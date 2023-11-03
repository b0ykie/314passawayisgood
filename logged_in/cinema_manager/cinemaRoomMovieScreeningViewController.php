<?php
session_start();

class cinemaRoomMovieScreeningViewController {
    public function viewCinemaRoomMovieScreening() {
        // Include the necessary files
        require_once 'cinemaRoomMovieScreeningEntity.php';

        // Create an instance of the cinemaRoomMovieScreeningType class
        $cinemaRoomMovieScreening = new cinemaRoomMovieScreeningType();

        // calling the retrieveAllCinemaRoomMovieScreening function that belongs to cinemaRoomMovieScreening class
        $cinemaRoomMovieScreeningList = $cinemaRoomMovieScreening->retrieveAllCinemaRoomMovieScreening();
        return $cinemaRoomMovieScreeningList;
        
    }
}

// Check if the form is submitted
if (isset($_POST['viewAll'])) {
    // Include the necessary files
    require_once 'cinemaRoomMovieScreeningEntity.php';

    // Create an instance of the cinemaRoomMovieScreeningViewController class
    $cinemaRoomMovieScreeningViewControllerObject = new cinemaRoomMovieScreeningViewController();

    // Call the viewCinemaRoomMovieScreening function
    $cinemaRoomMovieScreeningList = $cinemaRoomMovieScreeningViewControllerObject->viewCinemaRoomMovieScreening();

     // Pass the cinemaRoomMovieScreeningList to the boundary file
     $_SESSION['cinemaRoomMovieScreeningList'] = $cinemaRoomMovieScreeningList;
     header("Location: cinemaRoomMovieScreeningViewBoundary.php");
     exit();
}
?>
