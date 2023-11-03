<?php

class ticketAddController{

        public function addTicketType($ticketTypeVal, $ticketPriceVal){

        require_once 'ticketType.php';

        $ticket1 = new ticketType();
        
        if($ticket1->isTypeNameTaken($ticketTypeVal)){
            $message= "Ticket Type with the same name already created. Please choose a different name.";
            header("Location: ticketTypeManageBoundary.php?message=" . urlencode($message));
            exit();
        }
        else{
        $ticket1->addTicket($ticketTypeVal,$ticketPriceVal);
        $message = "New ticket type added";
        header("Location: ticketTypeManageBoundary.php?message=" . urlencode($message));
        exit();
        }
        }
    }

    if(isset($_POST['update'])){
        // Retrieve form data

        $ticketTypeVal = $_POST['ticketType'];

        $ticketPriceVal = $_POST['ticket_price'];

        $ticketAddController = new ticketAddController();

        $ticketAddController -> addTicketType($ticketTypeVal,$ticketPriceVal);
    }
?>