<?php
    session_start();
    
    class viewTicketTypeController{
        public function viewTicketTypeList(){
            require_once 'ticketType.php';

            $ticket = new ticketType();
            $ticketType = $ticket->viewTicketType();
            return $ticketType;
        }
    }

    if (isset($_POST['viewAll'])){
        require_once 'ticketType.php';

        $viewTicketTypeController = new viewTicketTypeController();
        $ticketType = $viewTicketTypeController->viewTicketTypeList();

        $_SESSION['ticketType'] = $ticketType;
        header("Location: ticketTypeViewBoundary.php");
        exit();
    }
?>