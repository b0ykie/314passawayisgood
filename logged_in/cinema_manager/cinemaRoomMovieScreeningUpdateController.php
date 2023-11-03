<?php

require_once 'cinemaRoomMovieScreeningEntity.php';

class cinemaRoomMovieScreeningUpdateController {
   
    

    public function updateCinemaRoomMovieScreening($cinema_rm_ID, $cinema_rm_number, $cinema_screening, $cinema_date, $cinema_time_slot) {

        $cinemaRoomMovieScreening = new cinemaRoomMovieScreeningType();

        if (($cinemaRoomMovieScreening->isCinemaRoomIdExist($cinema_rm_ID)) ===TRUE)
        {
            if (($cinemaRoomMovieScreening->isMovieNameExist($cinema_screening)) ===TRUE)
            {
                if (($cinemaRoomMovieScreening->isMovieListingAvailable($cinema_screening)) ===TRUE)
                {
                    if (($cinemaRoomMovieScreening->isMovieDateValid($cinema_date)) ===TRUE)
                    {
                        if (($cinemaRoomMovieScreening->isMovieTimeValid($cinema_time_slot, $cinema_date)) ===TRUE)
                        {
                            if (($cinemaRoomMovieScreening->isCinemaRoomTakenElsewhere($cinema_rm_ID, $cinema_rm_number, $cinema_date, $cinema_time_slot)) ===TRUE)
                            {
                                $message = "Current Cinema Room is already occupied with a movie screening for this date and time. Please choose another cinema room";
                                header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
                                exit();
                            } 
                            else 
                            {
                                $cinemaRoomMovieScreening->updateCinemaRoomMovieScreeningToDatabase($cinema_rm_ID, $cinema_rm_number, $cinema_screening, $cinema_date, $cinema_time_slot);
                                $message = "Cinema Room Movie Screening has been updated successfully!";
                                header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
                                exit();
                            }
                        } 
                        else 
                        {
                            $message = "Movie Time is invalid. Please choose a later timing.";
                            header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
                            exit();
                        }
                    } 
                    else 
                    {
                        $message = "Movie date is invalid. Please choose the same date as today or a later date.";
                        header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                }
                else 
                {
                    $message = "Movie is unavailable as it has been suspended. Please choose an available movie.";
                    header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
                    exit();
                }
            } 
            else 
            {
                $message = "Movie does not exist yet. Please create a movie listing first.";
                header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else 
        {
            $message = "No such Cinema Room Movie Screening has been created yet.";
            header("Location: cinemaRoomMovieScreeningUpdateBoundary.php?message=" . urlencode($message));
            exit();
        }




    }
}

if (isset($_POST['submit'])) {
     // Retrieve form data
     $cinema_rm_ID = $_POST['cinema_rm_ID'];
     $cinema_rm_number = $_POST['cinema_rm_number'];
     //$cinema_seat_list = $_POST['cinema_seat_list'];
     //$cinema_seat_list = 100;
     $cinema_screening = $_POST['cinema_screening'];
     $cinema_date = $_POST['cinema_date'];
     $cinema_time_slot = $_POST['cinema_time_slot'];

    $cinemaRoomMovieScreeningUpdateControllerObject = new cinemaRoomMovieScreeningUpdateController();
    $cinemaRoomMovieScreeningUpdateControllerObject->updateCinemaRoomMovieScreening($cinema_rm_ID, $cinema_rm_number, $cinema_screening, $cinema_date, $cinema_time_slot);
}

?>
