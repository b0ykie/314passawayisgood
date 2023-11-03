<?php

class cinemaRoomMovieScreeningCreateController {
    public function createCinemaRoomMovieScreening($cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot) {
        // Include the necessary files
        require_once 'cinemaRoomMovieScreeningEntity.php';

        // Create an instance of the fnbType class
        $cinemaRoomMovieScreening = new cinemaRoomMovieScreeningType();
       
        if (($cinemaRoomMovieScreening->isMovieNameExist($cinema_screening)) ===TRUE)
        {
            if (($cinemaRoomMovieScreening->isMovieListingAvailable($cinema_screening)) ===TRUE)
            {
                if (($cinemaRoomMovieScreening->isMovieDateValid($cinema_date)) ===TRUE)
                {
                    if (($cinemaRoomMovieScreening->isMovieTimeValid($cinema_time_slot, $cinema_date)) ===TRUE)
                    {
                        if (($cinemaRoomMovieScreening->isMovieDateExist($cinema_date)) ===TRUE)
                        {
                            if (($cinemaRoomMovieScreening->isMovieTimeExist($cinema_time_slot)) ===TRUE)
                            {
                                if (($cinemaRoomMovieScreening->isCinemaRoomNumberTaken($cinema_rm_number, $cinema_date, $cinema_time_slot)) ===TRUE)
                                {
                                    $message = "Current Cinema ROOM is already occupied with a movie screening for this date and time. Please choose another cinema room";
                                    header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                                    exit();
                                } 
                                else 
                                {
                                    $cinemaRoomMovieScreening->addCinemaRoomToDatabase($cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot);
                                    $message = "New Cinema Room Movie Screening has been created(A)";
                                    header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                                    exit();
                                }
                            } 
                            else 
                            {
                                $cinemaRoomMovieScreening->addCinemaRoomToDatabase($cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot);
                                $message = "New Cinema Room Movie Screening has been created(B)";
                                header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                                exit();
                            }
                        } 
                        else 
                        {
                            $cinemaRoomMovieScreening->addCinemaRoomToDatabase($cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot);
                            $message = "New Cinema Room Movie Screening has been created(C)";
                            header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                            exit();
                        }
                    } 
                    else 
                    {
                        $message = "Movie Time is invalid. Please choose a later timing.";
                        header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                } 
                else 
                {
                    $message = "Movie date is invalid. Please choose the same date as today or a later date.";
                    header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                    exit();
                }
            }
            else
            {
                $message = "Movie is unavailable. Please choose a different movie.";
                header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else 
        {
            $message = "Movie does not exist yet. Please create a movie listing first.";
            header("Location: cinemaRoomMovieScreeningCreateBoundary.php?message=" . urlencode($message));
            exit();
        }

    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $cinema_rm_number = $_POST['cinema_rm_number'];
    //$cinema_seat_list = $_POST['cinema_seat_list'];
    $cinema_seat_list = 100;
    $cinema_screening = $_POST['cinema_screening'];
    $cinema_date = $_POST['cinema_date'];
    $cinema_time_slot = $_POST['cinema_time_slot'];

    // Create an instance of the cinemaRoomCreateController class
    $cinemaRoomMovieScreeningCreateControllerObject = new cinemaRoomMovieScreeningCreateController();

    // Call the createFnb function
    $cinemaRoomMovieScreeningCreateControllerObject->createCinemaRoomMovieScreening($cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot);
}
?>
