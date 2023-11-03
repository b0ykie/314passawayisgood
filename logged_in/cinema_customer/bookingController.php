<?php
    session_start();
    
    class bookingController{

        public function retrieveTickets() {
            require_once 'ticketEntity.php';
            $ticket = new ticket();
            $retrieveTix = $ticket->getTicket();
        
            if (!empty($retrieveTix)) {
                return $retrieveTix;
            }
            else {
                return FALSE;
            }
        }
        
        public function retrieveMovieDetails($movieselected) {
            require_once '../../movieEntity.php';
            $Movie = new Movie();
            $MovieDetails = $Movie->movieDetails($movieselected);
        
            if (!empty($MovieDetails)) {
                return $MovieDetails;
            }
            else {
                return FALSE;
            }
        }

        public function retrieveDateOfMovie($movieselected) {
            require_once 'cinema_roomEntity.php';
            $cinemaRoom = new cinemaRoom();
            $movieDate = $cinemaRoom->getDateOfMovie($movieselected);
        
            if (!empty($movieDate)) {
                return $movieDate;
            }
            else {
                return FALSE;
            }
        }

        public function retrieveTimeOfMovie($movieArg, $dateArg) {
            require_once 'cinema_roomEntity.php';
            $cinemaRoom = new cinemaRoom();
            $movieTime = $cinemaRoom->getTimeOfMovie($movieArg, $dateArg);
        
            if (!empty($movieTime)) {
                return $movieTime;
            }
            else {
                return FALSE;
            }
        }

        public function retrieveAvailfnb() {
            require_once 'fnbEntity.php';
            $fnb = new fnb();
            $retrieveAvailfnb = $fnb->getAvailfnb();
        
            if (!empty($retrieveAvailfnb)) {
                return $retrieveAvailfnb;
            }
            else {
                return FALSE;
            }
        }


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

            require_once '../cinema_owner/bookTicketEntity.php';
            $addTixToDB = new ticketSales();
            $addTickets = $addTixToDB->addToBookTicketDB($tixQty, $movieName, $tixType, 
                                                        $tixPrice, $movieID, $movieDate, 
                                                        $movieTime, $roomNumber, $saetID, 
                                                        $bookBy);

            $lastInsertedID = $_SESSION['lastInsertedID'];

            if (!empty($lastInsertedID)) {
                return $lastInsertedID;
            }
            else {
                return FALSE;
            }
        }
            

        public function addToBookFnb($fbNameVal, $fbCostVal, $fbLoyalty_PtsVal, $fnb_movie_screening_dateVal, $fbBookByVal){
            $fbName = $fbNameVal;
            $fbCost = $fbCostVal;
            $fbLoyalty_Pts = $fbLoyalty_PtsVal;
            $fnb_movie_screening_date = $fnb_movie_screening_dateVal;
            $fbBookBy = $fbBookByVal;

            require_once '../cinema_owner/bookfnbEntity.php';
            $fnbSales = new fnbSales();
            $updatefnbSales = $fnbSales->addToBookFnbDB($fbName, $fbCost, $fbLoyalty_Pts, $fnb_movie_screening_date, $fbBookBy);
        }


        public function updateSeat($cinemaRmIDVal, $remainingSeatsVal){
            $cinemaRmID = $cinemaRmIDVal;
            $remainingSeats = $remainingSeatsVal;

            require_once 'cinema_roomEntity.php';
            $cinemaRoom = new cinemaRoom();
            $updateSeatLeft = $cinemaRoom->updateSeat($cinemaRmID, $remainingSeats);
        }

        /*
        public function retrieveSuccessBooking($searchArg){
            $retriveBookSuccess = $searchArg;

            require_once 'cinema_roomEntity.php';
            $cinemaRoom = new cinemaRoom();
            $updateSeatLeft = $cinemaRoom->retrieveSuccessBooking($retriveBookSuccess);

            if (!empty($updateSeatLeft)) {
                return $updateSeatLeft;
            }
            else {
                return FALSE;
            }

        }
        */

    }

    $username = $_SESSION['username'];
    $movieselected = $_SESSION['moviename'];

    if (isset($_POST['submit'])) {
        $booking = new bookingController();    
    
        $ticket_qty = isset($_POST['ticket_qty']) ? $_POST['ticket_qty'] : 0;
        $selectedTixQty = $ticket_qty;
        $ticket_leftID = isset($_POST['date']) ? $_POST['date'] : '';

        //   echo "ticket_qty : ".$ticket_qty. "<br>";
        $booking->checkTicketQty($ticket_qty, $ticket_leftID);

        //$ticket_type_price = isset($_POST['ticket_type']) ? $_POST['ticket_type'] : '';
        if (isset($_POST['ticket_type'])) {
            $selectedOption = $_POST['ticket_type'];
            // Extract the ticketType and ticketPrice from the selected option value
            $ticketType = substr($selectedOption, 0, strpos($selectedOption, '|'));
            $ticketPrice = substr($selectedOption, strpos($selectedOption, '|') + 1);
        }
        else {
            $ticketType = "";
            $ticketPrice = 0;
        }

    

        $date_time_ID = isset($_POST['date']) ? $_POST['date'] : '';
        $selectedTicketType = $ticketType;
        $tixCost = $ticketPrice * $ticket_qty;
        $roomID = isset($_POST['date']) ? $_POST['date'] : '';

        $getRoomDetails = $booking->roomDetails($roomID);
        $movieDateGet = $getRoomDetails->getCinemaDate();
        $movieTime = $getRoomDetails->getCinemaTimeSlot();
        $roomNumber = $getRoomDetails->getCinemaRmNumber();

        $seatLeftInRm = $getRoomDetails->getCinemaSeatList();
        if ($ticket_qty == 1) {
            $assignSeat = $seatLeftInRm;
            $seatLeftForDB = $assignSeat - 1;
        } 
        
        else {
            $assignSeat = $seatLeftInRm;
            $seatLeftForDB = $assignSeat - 1;
            $ticket_qty--;
            while ($ticket_qty > 0) {
                $assignSeat .= ", " . $seatLeftForDB;
                $seatLeftForDB--;
                $ticket_qty--;
            }
        }

        //add to book_ticket DB...
        $bookingAdd = $booking->addBookTicket($selectedTixQty, $movieselected, $ticketType, $tixCost, 
        $roomID, $movieDateGet, $movieTime, $roomNumber, $assignSeat, $username);

        $_SESSION['bookTixSuccess'] = $bookingAdd;
        $_SESSION['selectedTixQty'] = $selectedTixQty;
        $_SESSION['movieselected'] = $movieselected;
        $_SESSION['ticketType'] = $ticketType;
        $_SESSION['tixCost'] = $tixCost;
        $_SESSION['roomID'] = $roomID;
        $_SESSION['movieDateGet'] = $movieDateGet;
        $_SESSION['movieTime'] = $movieTime;
        $_SESSION['roomNumber'] = $roomNumber;
        $_SESSION['assignSeat'] = $assignSeat;
        

        $updateSeatLeft = $booking->updateSeat($roomID, $seatLeftForDB);


        //$_SESSION['SuccessBooking'] = $SuccessBooking;

        if (isset($_POST['fnbCheckbox']) && $_POST['fnbCheckbox'] === 'on') {
            //$fnb = isset($_POST['fnb']) ? $_POST['fnb'] : '';
            if (isset($_POST['fnb'])) {
            $fnbOption = $_POST['fnb'];
            // Extract the ticketType and ticketPrice from the selected option value
            $fnbName = substr($fnbOption, 0, strpos($fnbOption, '|'));
            $fnbPrice = substr($fnbOption, strpos($fnbOption, '|') + 1);
            $_SESSION['fnbName'] = $fnbName;
            $_SESSION['fnbPrice'] = $fnbPrice;
            // add to book_fnb
            $addFnbDB = $booking->addToBookFnb($fnbName, $fnbPrice, $fnbPrice, $movieDateGet, $username);
            $_SESSION['SuccessBookingFnb'] = $addFnbDB;
            }
        }
        else {
            $fnbName = "";
            $fnbPrice = 0;
        }

        header("Location: bookingSuccessBoundary.php");
        exit;
    
        // echo "ticket_leftID : ".$ticket_leftID. "<br>";
        // echo "ticket_type_price : ".$ticketPrice. "<br>";
        // echo "date_time_ID : ".$date_time_ID. "<br>";
        // echo "selectedTicketType : ".$selectedTicketType. "<br>";
        // echo "tixCost : ".$tixCost. "<br>";
        // echo "roomID : ".$roomID. "<br>";

        // echo "movieDateGet : ".$movieDateGet. "<br>";
        // echo "movieTime : ".$movieTime. "<br>";
        // echo "roomNumber : ".$roomNumber. "<br>";

        // echo "assignSeat : ".$assignSeat. "<br>";
        // echo "seatLeftForDB : ".$seatLeftForDB. "<br>";

        // echo "fnbName : ".$fnbName. "<br>";
        // echo "fnbPrice : ".$fnbPrice. "<br>";
    }


?>
            
    