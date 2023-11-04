<?php
  //session_start();
  class ticketSales {
    private $db;

    public function __construct() {
      $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
    }

    //retrieve All book ticket.
    public function retrieveAllSales(){
      try{
        $query = "SELECT * FROM book_ticket ";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        // Query to get the total row count
        //$queryrowcount = "SELECT COUNT(*) AS total FROM book_ticket";
        // Execute the query
        //$result = $this->db->query($queryrowcount);
        // Fetch the row count from the result
        //$row = $result->fetch(PDO::FETCH_ASSOC);

        $bookTickets = []; // Array to store BookTicket objects

        foreach ($stmt as $row) {
          $bookTickets[] = new BookTicket(
            $row['book_ticketID'],
            $row['no_of_ticket_booked'],
            $row['movie_name_booked'],
            $row['ticket_type'],
            $row['ticketPricePaid'],
            $row['movie_ID'],
            $row['movie_screening_date'],
            $row['movie_screening_time'],
            $row['cinema_rm_number'],
            $row['seatID'],
            $row['seatID']
          );
        }
    
        return $bookTickets;
      }
      catch(Exception $e){
        echo "retrieveAllSales failed";
      }
    }

    // retrieve available month
    public function retrieveMonth() {
      $query = "SELECT DISTINCT MONTH(movie_screening_date) AS month FROM book_ticket";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
    
      $retrievemonth = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
      return $retrievemonth;
    }
    
    
    // retrieve available day
    public function retrieveDay(){
      try{
        $query = "SELECT DISTINCT movie_screening_date FROM book_ticket";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $retrieveDay = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $retrieveDay[] = $row['movie_screening_date'];
        }
    
        return $retrieveDay;
      } 
      catch (Exception $e) {
        echo "retrieveMonth failed";
      }

    }

    //retrieve by selected month
    public function retrieveByMonth($searchArg){
      try{
        $query = "SELECT * FROM book_ticket WHERE MONTH(movie_screening_date) = :searchVal";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchVal', $searchArg);
        $stmt->execute();

        $retrieveChooseMonth = [];
    
        foreach ($stmt as $row) {
          $retrieveChooseMonth[] = new BookTicket(
            $row['book_ticketID'],
            $row['no_of_ticket_booked'],
            $row['movie_name_booked'],
            $row['ticket_type'],
            $row['ticketPricePaid'],
            $row['movie_ID'],
            $row['movie_screening_date'],
            $row['movie_screening_time'],
            $row['cinema_rm_number'],
            $row['seatID'],
            $row['bookBy']
          );
        }

        return $retrieveChooseMonth;
      }
      catch(Exception $e){
        echo "retrieveByView failed";
      }
    }

    //retrieve by selected week
    public function retrieveByWeek($searchValMonth, $startDay, $endDay){
      try{
        $query = "SELECT * FROM book_ticket WHERE MONTH(movie_screening_date) = :searchValMonth AND DAY(movie_screening_date) BETWEEN :startDay AND :endDay";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchValMonth', $searchValMonth);
        $stmt->bindValue(':startDay', $startDay);
        $stmt->bindValue(':endDay', $endDay);
        $stmt->execute();

        $retrieveChooseWeek = [];
    
        foreach ($stmt as $row) {
          $retrieveChooseWeek[] = new BookTicket(
            $row['book_ticketID'],
            $row['no_of_ticket_booked'],
            $row['movie_name_booked'],
            $row['ticket_type'],
            $row['ticketPricePaid'],
            $row['movie_ID'],
            $row['movie_screening_date'],
            $row['movie_screening_time'],
            $row['cinema_rm_number'],
            $row['seatID'],
            $row['bookBy']
          );
        }

        return $retrieveChooseWeek;
      }
      catch(Exception $e){
        echo "retrieveByView failed";
      }
    }

    //retrieve by selected day
    public function retrieveByDay($searchArg){
      try{
        $query = "SELECT * FROM book_ticket WHERE movie_screening_date = :searchVal";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchVal', $searchArg);
        $stmt->execute();

        $retrieveChooseDay = [];
    
        foreach ($stmt as $row) {
          $retrieveChooseDay[] = new BookTicket(
            $row['book_ticketID'],
            $row['no_of_ticket_booked'],
            $row['movie_name_booked'],
            $row['ticket_type'],
            $row['ticketPricePaid'],
            $row['movie_ID'],
            $row['movie_screening_date'],
            $row['movie_screening_time'],
            $row['cinema_rm_number'],
            $row['seatID'],
            $row['bookBy']
          );
        }

        return $retrieveChooseDay;
      }
      catch(Exception $e){
        echo "retrieveByView failed";
      }
    }

    //retrieve Purchase Hist
    public function retrievePurchaseHist($searchArg) {
      try {
          $query = "SELECT * FROM book_ticket WHERE bookBy = :searchArg";
          $stmt = $this->db->prepare($query);
          $stmt->bindValue(':searchArg', $searchArg);
          $stmt->execute();
  
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
          $retrievePurchaseHist = array();
          foreach ($rows as $row) {
              $retrievePurchaseHist[] = new BookTicket(
                  $row['book_ticketID'],
                  $row['no_of_ticket_booked'],
                  $row['movie_name_booked'],
                  $row['ticket_type'],
                  $row['ticketPricePaid'],
                  $row['movie_ID'],
                  $row['movie_screening_date'],
                  $row['movie_screening_time'],
                  $row['cinema_rm_number'],
                  $row['seatID'],
                  $row['bookBy']
              );
          }
  
          return $retrievePurchaseHist;
      } catch (Exception $e) {
          echo "retrievePurchaseHist failed: " . $e->getMessage();
      }
  }
  

    //add to database
    public function addToBookTicketDB($tixQtyVal, $movieNameVal, $tixTypeVal, $tixPriceVal, $movieIDVal, $movieDateVal, $movieTimeVal, $roomNumberVal, $saetIDVal, $bookByVal) {
      try {
          $query = "INSERT INTO book_ticket (no_of_ticket_booked, movie_name_booked, ticket_type, ticketPricePaid, movie_ID, movie_screening_date, movie_screening_time, cinema_rm_number, seatID, bookBy) 
                    VALUES (:tixQtyVal, :movieNameVal, :tixTypeVal, :tixPriceVal, :movieIDVal, :movieDateVal, :movieTimeVal, :roomNumberVal, :seatIDVal, :bookByVal)";
          $stmt = $this->db->prepare($query);
          $stmt->bindValue(':tixQtyVal', $tixQtyVal);
          $stmt->bindValue(':movieNameVal', $movieNameVal);
          $stmt->bindValue(':tixTypeVal', $tixTypeVal);
          $stmt->bindValue(':tixPriceVal', $tixPriceVal);
          $stmt->bindValue(':movieIDVal', $movieIDVal);
          $stmt->bindValue(':movieDateVal', $movieDateVal);
          $stmt->bindValue(':movieTimeVal', $movieTimeVal);
          $stmt->bindValue(':roomNumberVal', $roomNumberVal);
          $stmt->bindValue(':seatIDVal', $saetIDVal);
          $stmt->bindValue(':bookByVal', $bookByVal);
          $stmt->execute();
  
          $_SESSION['lastInsertedID'] = $this->db->lastInsertId();

          return $_SESSION['lastInsertedID'];
      } catch (Exception $e) {
          echo "addToDatabase failed: " . $e->getMessage();
      }
    }


    public function retrieveSuccessBooking($searchArg){
      try {
        $query = "SELECT * FROM book_ticket WHERE book_ticketID  = :searchArg";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchArg', $searchArg);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Create a new BookTicket object using the fetched row data
        $retrieveSuccessBooking = new BookTicket(
            $row['book_ticketID '],
            $row['no_of_ticket_booked'],
            $row['movie_name_booked'],
            $row['ticket_type  '],
            $row['ticketPricePaid '],
            $row['movie_ID '],
            $row['movie_screening_date'],
            $row['movie_screening_time'],
            $row['cinema_rm_number'],
            $row['seatID'],
            $row['bookBy']
        );

        return $retrieveSuccessBooking;
    } catch (Exception $e) {
        echo "retrieveSuccessBooking failed: " . $e->getMessage();
    }
}
    
  
    
  }
    
    

    
  class BookTicket {
    private $bookTicketID;
    private $noOfTicketsBooked;
    private $movieNameBooked;
    private $ticketTypeIndex;
    private $ticketPricePaid;
    private $movieID;
    private $movieScreeningDate;
    private $movieScreeningTime;
    private $cinemaRmNumber;
    private $seatID;
    private $bookBy;
  
    public function __construct($bookTicketID, $noOfTicketsBooked, $movieNameBooked, $ticketTypeIndex, $ticketPricePaid, $movieID, $movieScreeningDate, $movieScreeningTime, $cinemaRmNumber, $seatID, $bookBy) {
      $this->bookTicketID = $bookTicketID;
      $this->noOfTicketsBooked = $noOfTicketsBooked;
      $this->movieNameBooked = $movieNameBooked;
      $this->ticketTypeIndex = $ticketTypeIndex;
      $this->ticketPricePaid = $ticketPricePaid;
      $this->movieID = $movieID;
      $this->movieScreeningDate = $movieScreeningDate;
      $this->movieScreeningTime = $movieScreeningTime;
      $this->cinemaRmNumber = $cinemaRmNumber;
      $this->seatID = $seatID;
      $this->bookBy = $bookBy;
    }
  
    // getter methods
    public function getBookTicketID() {
      return $this->bookTicketID;
    }
  
    public function getNoOfTicketsBooked() {
      return $this->noOfTicketsBooked;
    }
  
    public function getMovieNameBooked() {
      return $this->movieNameBooked;
    }
  
    public function getTicketTypeIndex() {
      return $this->ticketTypeIndex;
    }
  
    public function getTicketPricePaid() {
      return $this->ticketPricePaid;
    }
  
    public function getMovieID() {
      return $this->movieID;
    }
  
    public function getMovieScreeningDate() {
      return $this->movieScreeningDate;
    }
  
    public function getMovieScreeningTime() {
      return $this->movieScreeningTime;
    }
  
    public function getCinemaRmID() {
      return $this->cinemaRmNumber;
    }
  
    public function getSeatID() {
      return $this->seatID;
    }
  
    public function getBookBy() {
      return $this->bookBy;
    }
  }
?>      