<?php
  class fnbSales {
    private $db;

    public function __construct() {
      $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
    }

    //retrieve All book ticket.
    public function retrieveAllFnbSales(){
      try{
        $query = "SELECT * FROM book_fnb ";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $bookFnb = []; // Array to store BookTicket objects

        foreach ($stmt as $row) {
          $bookFnb[] = new BookFnb(
            $row['book_fbID'],
            $row['fbName'],
            $row['fbCost'],
            $row['fbLoyalty_Pts'],
            $row['fnb_movie_screening_date'],
            $row['fbBookBy']
          );
        }
    
        return $bookFnb;
      }
      catch(Exception $e){
        echo "retrieveAllFnbSales failed";
      }
    }

    // retrieve available month
    public function retrieveFnbMonth() {
      try {
        $query = "SELECT DISTINCT MONTH(fnb_movie_screening_date) AS month FROM book_fnb";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $retrieveFnbMonth = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $retrieveFnbMonth[] = $row['month'];
        }
    
        return $retrieveFnbMonth;
      } catch (Exception $e) {
        echo "retrieveMonth failed";
      }
    }
    
    // retrieve available day
    public function retrieveFnbDay(){
      try{
        $query = "SELECT DISTINCT fnb_movie_screening_date FROM book_fnb";             
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $retrieveFnbDay = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $retrieveFnbDay[] = $row['fnb_movie_screening_date'];
        }
    
        return $retrieveFnbDay;
      } 
      catch (Exception $e) {
        echo "retrieveFnbDay failed";
      }

    }

    //retrieve by selected month
    public function retrieveFnbByMonth($searchArg){
      try{
        $query = "SELECT * FROM book_fnb WHERE MONTH(fnb_movie_screening_date) = :searchVal";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchVal', $searchArg);
        $stmt->execute();

        $retrieveFnbChooseMonth = [];
    
        foreach ($stmt as $row) {
          $retrieveFnbChooseMonth[] = new BookFnb(
            $row['book_fbID'],
            $row['fbName'],
            $row['fbCost'],
            $row['fbLoyalty_Pts'],
            $row['fnb_movie_screening_date'],
            $row['fbBookBy']
          );
        }

        return $retrieveFnbChooseMonth;
      }
      catch(Exception $e){
        echo "retrieveFnbChooseMonth failed";
      }
    }

    //retrieve by selected week
    public function retrieveFnbByWeek($searchValMonth, $startDay, $endDay){
      try{
        $query = "SELECT * FROM book_fnb WHERE MONTH(fnb_movie_screening_date) = :searchValMonth AND DAY(fnb_movie_screening_date) BETWEEN :startDay AND :endDay";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchValMonth', $searchValMonth);
        $stmt->bindValue(':startDay', $startDay);
        $stmt->bindValue(':endDay', $endDay);
        $stmt->execute();

        $retrieveFnbChooseWeek = [];
    
        foreach ($stmt as $row) {
          $retrieveFnbChooseWeek[] = new BookFnb(
            $row['book_fbID'],
            $row['fbName'],
            $row['fbCost'],
            $row['fbLoyalty_Pts'],
            $row['fnb_movie_screening_date'],
            $row['fbBookBy']
          );
        }
        
        return $retrieveFnbChooseWeek;
      }
      catch(Exception $e){
        echo "retrieveByView failed";
      }
    }

    //retrieve by selected day
    public function retrieveFnbByDay($searchArg){
      try{
        $query = "SELECT * FROM book_fnb WHERE fnb_movie_screening_date = :searchVal";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchVal', $searchArg);
        $stmt->execute();

        $retrieveFnbChooseDay = [];
    
        foreach ($stmt as $row) {
          $retrieveFnbChooseDay[] = new BookFnb(
            $row['book_fbID'],
            $row['fbName'],
            $row['fbCost'],
            $row['fbLoyalty_Pts'],
            $row['fnb_movie_screening_date'],
            $row['fbBookBy']
          );
        }

        return $retrieveFnbChooseDay;
      }
      catch(Exception $e){
        echo "retrieveByView failed";
      }
    }

    public function retrieveFnBPurchaseHist($searchArg){
      try{
        $query = "SELECT * FROM book_fnb WHERE fbBookBy = :searchArg";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchArg', $searchArg);
        $stmt->execute();

        $retrieveFnBPurchaseHist = [];
    
        foreach ($stmt as $row) {
          $retrieveFnBPurchaseHist[] = new BookFnb(
            $row['book_fbID'],
            $row['fbName'],
            $row['fbCost'],
            $row['fbLoyalty_Pts'],
            $row['fnb_movie_screening_date'],
            $row['fbBookBy']
          );
        }

        return $retrieveFnBPurchaseHist;
      }
      catch(Exception $e){
        echo "retrieveByView failed";
      }
    }

    //update to book_fnb DB.
    public function addToBookFnbDB($fbNameVal, $fbCostVal, $fbLoyalty_PtsVal, $fnb_movie_screening_dateVal, $fbBookByVal){
      try {
        $query = "INSERT INTO book_fnb (fbName, fbCost, fbLoyalty_Pts, fnb_movie_screening_date, fbBookBy) 
                  VALUES (:fbNameVal, :fbCostVal, :fbLoyalty_PtsVal, :fnb_movie_screening_dateVal, :fbBookByVal)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':fbNameVal', $fbNameVal);
        $stmt->bindValue(':fbCostVal', $fbCostVal);
        $stmt->bindValue(':fbLoyalty_PtsVal', $fbLoyalty_PtsVal);
        $stmt->bindValue(':fnb_movie_screening_dateVal', $fnb_movie_screening_dateVal);
        $stmt->bindValue(':fbBookByVal', $fbBookByVal);
        $stmt->execute();

        // Optionally, you can return the ID of the inserted record if needed
        return $this->db->lastInsertId();
        
    } catch (Exception $e) {
        echo "addToBookFnbDB failed: " . $e->getMessage();
    }
    }



  } 
    
    

    
  class BookFnb {
    private $book_fbID ;
    private $fbName;
    private $fbCost;
    private $fbLoyalty_Pts;
    private $fnb_movie_screening_date;
    private $fbBookBy;
    
  
    public function __construct($book_fbID , $fbName, $fbCost, $fbLoyalty_Pts, $fnb_movie_screening_date, $fbBookBy) {
      $this->book_fbID  = $book_fbID;
      $this->fbName = $fbName;
      $this->fbCost = $fbCost;
      $this->fbLoyalty_Pts = $fbLoyalty_Pts;
      $this->fnb_movie_screening_date = $fnb_movie_screening_date;
      $this->fbBookBy = $fbBookBy;
    }
  
    // getter methods
    public function getBookFnbID() {
      return $this->book_fbID ;
    }
  
    public function getFnbName() {
      return $this->fbName;
    }
  
    public function getFnbCost() {
      return $this->fbCost;
    }
  
    public function getFnbLoyaltyPts() {
      return $this->fbLoyalty_Pts;
    }
  
    public function getFnbMovieScreeningDate() {
      return $this->fnb_movie_screening_date;
    }
  
    public function getFnbBookBy() {
      return $this->fbBookBy;
    }
  }
?>      