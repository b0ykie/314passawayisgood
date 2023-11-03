<?php
    session_start();

    $username = $_SESSION['username'];
    $movieselected = $_SESSION['moviename'];

    class bookingSuccessController{

        public function retrieveSuccess($searchArg) {
            $successID = $searchArg;
            require_once '../cinema_owner/bookTicketEntity.php';
            $ticket = new ticketSales();
            $retrieveTix = $ticket->retrievePurchaseHist($successID);
        
            if (!empty($retrieveTix)) {
                return $retrieveTix;
            }
            else {
                return FALSE;
            }
        }

    }
  

?>
            
    
