<?php

class cinemaRoomMovieScreeningDeleteController {
    public function deleteCinemaRoomMovieScreening($cinema_rm_ID) {
        // Include the necessary files
        require_once 'cinemaRoomMovieScreeningEntity.php';

        // Create an instance of the fnbType class
        $cinemaRoomMovieScreening = new cinemaRoomMovieScreeningType();

        
        /*
        if ($cinemaRoomMovieScreening->isCinemaRoomIdExist($cinema_rm_ID)) 
        {
            if ($cinemaRoomMovieScreening->hasCustomerBookedScreening($cinema_rm_ID)) 
            {
                [$cinema_date, $cinema_time_slot]=$cinemaRoomMovieScreening->getCinemaMovieScreeningDateTime($cinema_rm_ID);
                    
                if ($cinemaRoomMovieScreening->isMovieTimeValid($cinema_time_slot, $cinema_date)) 
                {
                    $message = "Cinema Room Movie Screening cannot be deleted as current movie screening has been booked by customer(s).";
                    header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                    exit();
                    
                } 
                else 
                {
                    // Delete here
                    $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                    $message = "Cinema Room Movie Screening deleted successfully as no booking has passed the current date and time.";
                    header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                    exit();
                }
            } 
            else 
            {
                // Delete here
                $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                $message = "Cinema Room Movie Screening deleted successfully as no booking has been made.";
                header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else 
        {

            $message = "Cinema Room Movie Screening cannot be found. Please enter another Cinema Room ID.";
            header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
            exit();
        }
        */
        /*
        if ($cinemaRoomMovieScreening->isCinemaRoomIdExist($cinema_rm_ID)) 
        {
            [$cinema_date, $cinema_time_slot]=$cinemaRoomMovieScreening->getCinemaMovieScreeningDateTime($cinema_rm_ID);
                    
            if ($cinemaRoomMovieScreening->isMovieTimeValid($cinema_time_slot, $cinema_date)) 
            {
                if ($cinemaRoomMovieScreening->hasCustomerBookedScreening($cinema_rm_ID)) 
                {
                    $message = "Cinema Room Movie Screening cannot be deleted as current movie screening has been booked by customer(s).";
                    header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                    exit();
                } 
                else 
                {
                    // Delete here
                    $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                    $message = "Cinema Room Movie Screening deleted successfully as no booking has been made.";
                    header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                    exit();
                }
            }
            else 
            {
                // Delete here
                $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                $message = "Cinema Room Movie Screening deleted successfully as Cinema Room Movie Screening has passed current date and time.";
                header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else 
        {

            $message = "Cinema Room Movie Screening cannot be found. Please enter another Cinema Room ID.";
            header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
            exit();
        }
        */
        if (($cinemaRoomMovieScreening->isCinemaRoomIdExist($cinema_rm_ID)) === TRUE)
        {
            [$cinema_date, $cinema_time_slot]=$cinemaRoomMovieScreening->getCinemaMovieScreeningDateTime($cinema_rm_ID);
                    
            if (($cinemaRoomMovieScreening->isMovieTimeValid($cinema_time_slot, $cinema_date)) === TRUE)
            {
                if (($cinemaRoomMovieScreening->hasCustomerBookedScreening($cinema_rm_ID)) === TRUE)
                {
                    if (($cinemaRoomMovieScreening->isCurrentCinemaMovieScreeningSameAsCustomerBooked($cinema_rm_ID)) === TRUE)
                    {
                        $message = "Cinema Room Movie Screening cannot be deleted as current movie screening has been booked by customer(s).";
                        header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                        exit();
                    } 
                    else 
                    {
                        // Delete here
                        $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                        $message = "Cinema Room Movie Screening deleted successfully.";
                        header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                } 
                else 
                {
                    // Delete here
                    $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                    $message = "Cinema Room Movie Screening deleted successfully as no booking has been made.";
                    header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                    exit();
                }
            }
            else 
            {
                // Delete here
                $cinemaRoomMovieScreening->deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID);
                $message = "Cinema Room Movie Screening deleted successfully as Cinema Room Movie Screening has passed current date and time.";
                header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else 
        {

            $message = "Cinema Room Movie Screening cannot be found. Please enter another Cinema Room ID.";
            header("Location: cinemaRoomMovieScreeningDeleteBoundary.php?message=" . urlencode($message));
            exit();
        }

    }
}





// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $cinema_rm_ID = $_POST['cinema_rm_ID'];


    // Create an instance of the cinemaRoomCreateController class
    $cinemaRoomMovieScreeningDeleteControllerObject = new cinemaRoomMovieScreeningDeleteController();

    // Call the createFnb function
    $cinemaRoomMovieScreeningDeleteControllerObject->deleteCinemaRoomMovieScreening($cinema_rm_ID);
}
?>
