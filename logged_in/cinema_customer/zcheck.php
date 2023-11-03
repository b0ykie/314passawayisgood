<?php

  session_start();
  $username = $_SESSION['username'];
  $movieselected = $_SESSION['moviename'];

  class bookingSuccessController{

    public function checkTicketQty($ticket_qtyVal, $ticket_leftIDVal){
      $ticketQty = $ticket_qtyVal;
      $ticketLeft = $ticket_leftIDVal;

      require_once 'cinema_roomEntity.php';
      $cinemaRoom = new cinemaRoom();
      $rmLeft = $cinemaRoom->getRoomLeft($ticketLeft);

      if ($ticketQty > $rmLeft) {
          $message = "Not enough seats!!";
          $referer = $_SERVER['HTTP_REFERER'];
          $refererWithMessage = $referer . "&message=" . urlencode($message);
          header("Location: " . $refererWithMessage);
          exit();
      }

    }

    public function roomDetails($roomIDVal){
      $roomID = $roomIDVal;

      require_once 'cinema_roomEntity.php';
      $cinemaRoom = new cinemaRoom();
      $roomDetails = $cinemaRoom->getRoomDetails($roomID);

      return $roomDetails;
    }

    public function addBookTicket($tixQtyVal, $movieNameVal, $tixTypeVal, $tixPriceVal, 
                                  $movieIDVal, $movieDateVal, $movieTimeVal, 
                                  $roomNumberVal, $saetIDVal, $bookByVal) {
      $tixQty = $tixQtyVal;
      $movieName = $movieNameVal;
      $tixType = $tixTypeVal;
      $tixPrice = $tixPriceVal;
      $movieID = $movieIDVal;
      $movieDate = $movieDateVal;
      $movieTime = $movieTimeVal;
      $roomNumber = $roomNumberVal;
      $saetID = $saetIDVal;
      $bookBy = $bookByVal;

      require_once 'bookTicketEntity.php';
      $addTixToDB = new ticketSales();
      $addTickets = $addTixToDB->addToBookTicketDB($tixQty, $movieName, $tixType, 
                                                  $tixPrice, $movieID, $movieDate, 
                                                  $movieTime, $roomNumber, $saetID, 
                                                  $bookBy);
  
      if (!empty($addTickets)) {
          return $addTickets;
      }
      else {
          return FALSE;
      }
    }
      

  }
  
  
  $bookingSuccess = new bookingSuccessController();    
  
  $ticket_qty = isset($_POST['ticket_qty']) ? $_POST['ticket_qty'] : '';
  $ticket_leftID = isset($_POST['date']) ? $_POST['date'] : '';

  echo "ticket_qty : ".$ticket_qty. "<br>";
  $bookingSuccess->checkTicketQty($ticket_qty, $ticket_leftID);

  //$ticket_type_price = isset($_POST['ticket_type']) ? $_POST['ticket_type'] : '';
  if (isset($_POST['ticket_type'])) {
    $selectedOption = $_POST['ticket_type'];
    // Extract the ticketType and ticketPrice from the selected option value
    $ticketType = substr($selectedOption, 0, strpos($selectedOption, '|'));
    $ticketPrice = substr($selectedOption, strpos($selectedOption, '|') + 1);
    echo "ticketType : " . $ticketType . "<br>"; //take here
    echo "ticketPrice : " . $ticketPrice . "<br>"; //take here
  }

  

  $date_time_ID = isset($_POST['date']) ? $_POST['date'] : '';
  $selectedTicketType = $ticketType;
  $tixCost = $ticketPrice * $ticket_qty;
  $roomID = isset($_POST['date']) ? $_POST['date'] : '';

  $getRoomDetails = $bookingSuccess->roomDetails($roomID);
  $movieDateGet = $getRoomDetails->getCinemaDate();
  $movieTime = $getRoomDetails->getCinemaTimeSlot();
  $roomNumber = $getRoomDetails->getCinemaRmNumber();

  $seatLeftInRm = $getRoomDetails->getCinemaSeatList();
  if ($ticket_qty == 1) {
      $assignSeat = $seatLeftInRm;
      $seatLeftForDB = $assignSeat - 1;
  } else {
      $assignSeat = $seatLeftInRm;
      $seatLeftForDB = $assignSeat - 1;
      $ticket_qty--;
      while ($ticket_qty > 0) {
          $assignSeat .= " and " . $seatLeftForDB;
          $seatLeftForDB--;
          $ticket_qty--;
      }
  }

  if (isset($_POST['fnbCheckbox']) && $_POST['fnbCheckbox'] === 'on') {
    //$fnb = isset($_POST['fnb']) ? $_POST['fnb'] : '';
    if (isset($_POST['fnb'])) {
      $fnbOption = $_POST['fnb'];
      // Extract the ticketType and ticketPrice from the selected option value
      $fnbName = substr($fnbOption, 0, strpos($fnbOption, '|'));
      $fnbPrice = substr($fnbOption, strpos($fnbOption, '|') + 1);
    }
  }
  else {
    $fnbName = "";
    $fnbPrice = 0;
  }
  
  echo "ticket_leftID : ".$ticket_leftID. "<br>";
  echo "ticket_type_price : ".$ticketPrice. "<br>";
  echo "date_time_ID : ".$date_time_ID. "<br>";
  echo "selectedTicketType : ".$selectedTicketType. "<br>";
  echo "tixCost : ".$tixCost. "<br>";
  echo "roomID : ".$roomID. "<br>";

  echo "movieDateGet : ".$movieDateGet. "<br>";
  echo "movieTime : ".$movieTime. "<br>";
  echo "roomNumber : ".$roomNumber. "<br>";

  echo "assignSeat : ".$assignSeat. "<br>";
  echo "seatLeftForDB : ".$seatLeftForDB. "<br>";

  echo "fnbName : ".$fnbName. "<br>";
  echo "fnbPrice : ".$fnbPrice. "<br>";



?>
            
    
