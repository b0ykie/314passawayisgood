<?php
    
    class ticketUpdateController{
    
        public function updateTicketType($ticketType, $ticket_price){
        require_once 'ticketType.php';

        $ticket = new ticketType();

        $ticket->updateTicketPrice($ticketType,$ticket_price);
        $message = "Successfully updated!";
        header("location: ticketTypeManageBoundary.php?message=" . urlencode($message));
        }
    }

    if(isset($_POST['update'])){
        // Retrieve form data

        $ticketType = $_POST['ticketType'];

        $ticketPrice = $_POST['ticket_price'];

        $ticketUpdateController = new ticketUpdateController();

        $ticketUpdateController -> updateTicketType($ticketType,$ticketPrice);
    }
        
?>