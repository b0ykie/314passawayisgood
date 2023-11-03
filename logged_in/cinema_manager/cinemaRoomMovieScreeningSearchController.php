<?php
session_start();

class cinemaRoomMovieScreeningSearchController{
    public function searchCinemaRoomMovieScreening($cinema_screening){
        require_once 'cinemaRoomMovieScreeningEntity.php';

        // Create an instance of the fnbType class
        $cinemaRoomMovieScreening = new cinemaRoomMovieScreeningType();

        $cinemaRoomMovieScreeningList = $cinemaRoomMovieScreening->displayCinemaRoomMovieScreening($cinema_screening);
        if (empty($cinemaRoomMovieScreeningList)) {
            $message = "Cinema Room Movie Screening cannot be found. Please choose a different movie title.";
            header("Location: cinemaRoomMovieScreeningSearchBoundary.php?message=" . urlencode($message));
            exit();
        } else {
            return $cinemaRoomMovieScreeningList;
        }
    }
}

if(isset($_POST['submit'])){
    $cinema_screening = $_POST['cinema_screening'];

    // Create an instance of the FnbController class
    $cinemaRoomMovieScreeningSearchControllerObject = new cinemaRoomMovieScreeningSearchController();
    $cinemaRoomMovieScreeningList = $cinemaRoomMovieScreeningSearchControllerObject->searchCinemaRoomMovieScreening($cinema_screening);
    
    // Pass the fnbList to the boundary file
    $_SESSION['cinemaRoomMovieScreeningList'] = $cinemaRoomMovieScreeningList;
    header("Location: cinemaRoomMovieScreeningSearchBoundary.php");
    exit();
}
?>