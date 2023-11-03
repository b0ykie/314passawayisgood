<?php
    class searchTicketController{

        public function searchTicketType($ticketType){
            
            require_once 'ticketType.php';

            $ticket = new ticketType();

            if($ticket->isTypeNameTaken($ticketType) != true){
            $message ="Ticket Type cannot be found.";
            header("Location:ticketTypeManageBoundary.php?message=" . urlencode($message));
            exit();
            }
            else{
            $ticket->displayTicketType($ticketType);
            
        }
    }
}


    if(isset($_POST['submit'])){
        $ticketType = $_POST['ticketType'];
        $searchTicketController = new searchTicketController();
        $searchTicketController -> searchTicketType($ticketType);
    }
?>