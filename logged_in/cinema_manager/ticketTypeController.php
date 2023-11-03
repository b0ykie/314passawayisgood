<?php
    session_start();

    require_once 'ticketType.php';

    //Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=bse_booking','root','');

    //Instantiate the ticketTypeController
    $ticket = new ticketType($db);

    //Retrieve form data
    $ticketType = $POST['ticketType'];
    $ticket_price = $POST['ticket_price'];

   
    $ticket->updateTicketPrice($ticket_price);
    header("location: manticketTypeBoundary.php");
    
    
?>