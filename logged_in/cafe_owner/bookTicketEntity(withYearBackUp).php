<?php
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
            $row['cinema_rm_ID'],
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

    // retrieve available year
    public function retrieveYear() {
      try {
        $query = "SELECT DISTINCT YEAR(movie_screening_date) AS year FROM book_ticket";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $retrieveYear = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $retrieveYear[] = $row['year'];
        }
    
        return $retrieveYear;
      } catch (Exception $e) {
        echo "retrieveMonth failed";
      }
    }

    // retrieve available month
    public function retrieveMonth() {
      try {
        $query = "SELECT DISTINCT MONTH(movie_screening_date) AS month FROM book_ticket";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $retrievemonth = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $retrievemonth[] = $row['month'];
        }
    
        return $retrievemonth;
      } catch (Exception $e) {
        echo "retrieveMonth failed";
      }
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
    public function retrieveByMonth($searchArgMonth, $searchArgYear){
      try{
        $query = "SELECT * FROM book_ticket WHERE MONTH(movie_screening_date) = :searchValMonth AND YEAR(movie_screening_date) = :searchValYear";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchValMonth', $searchArgMonth);
        $stmt->bindValue(':searchValYear', $searchArgYear);
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
            $row['cinema_rm_ID'],
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
            $row['cinema_rm_ID'],
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
    private $cinemaRmID;
    private $seatID;
    private $bookBy;
  
    public function __construct($bookTicketID, $noOfTicketsBooked, $movieNameBooked, $ticketTypeIndex, $ticketPricePaid, $movieID, $movieScreeningDate, $movieScreeningTime, $cinemaRmID, $seatID, $bookBy) {
      $this->bookTicketID = $bookTicketID;
      $this->noOfTicketsBooked = $noOfTicketsBooked;
      $this->movieNameBooked = $movieNameBooked;
      $this->ticketTypeIndex = $ticketTypeIndex;
      $this->ticketPricePaid = $ticketPricePaid;
      $this->movieID = $movieID;
      $this->movieScreeningDate = $movieScreeningDate;
      $this->movieScreeningTime = $movieScreeningTime;
      $this->cinemaRmID = $cinemaRmID;
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
      return $this->cinemaRmID;
    }
  
    public function getSeatID() {
      return $this->seatID;
    }
  
    public function getBookBy() {
      return $this->bookBy;
    }
  }
?>      