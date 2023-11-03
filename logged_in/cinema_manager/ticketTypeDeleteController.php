<?php

class ticketDeleteController{

    public function deleteTicketType($ticketType){
    
    require_once 'ticketType.php';

    $ticket = new ticketType();
    
    $ticket->deleteTicketType($ticketType);
    $message="Successfully removed.";
    header("location: ticketTypeManageBoundary.php?message=" . urlencode($message));
    }
}

    if(isset($_POST['delete'])){

    //Retrieve form data

    $ticketType = $_POST['ticketType'];

    $ticketDeleteController = new ticketDeleteController();
    $ticketDeleteController -> deleteTicketType($ticketType);
    }
?>