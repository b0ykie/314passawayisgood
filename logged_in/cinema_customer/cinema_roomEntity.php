<?php

    class cinemaRoom {

        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }

        public function getDateOfMovie($searchArg){
            try{
                $query = "SELECT * FROM cinema_room WHERE cinema_screening = :searchArg AND cinema_seat_list > 0" ;
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':searchArg', $searchArg);
                $stmt->execute();
        
                $getDate = [];
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $getDate[] = new cinemaRoomE($row['cinema_rm_ID'], $row['cinema_rm_number'], $row['cinema_seat_list'], $row['cinema_screening'], $row['cinema_date'], $row['cinema_time_slot']);
                }
        
                return $getDate;
            }
            catch(Exception $e){
                echo "getDateOfMovie failed";
            }
        }

        public function getTimeOfMovie($movieArg, $dateArg){
            try{
                $query = "SELECT * FROM cinema_room WHERE cinema_screening = :searchArg AND cinema_date = :dateArg" ;
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':searchArg', $movieArg);
                $stmt->bindValue(':dateArg', $dateArg);
                $stmt->execute();
        
                $getTime = [];
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $getTime[] = new cinemaRoomE($row['cinema_rm_ID'], $row['cinema_rm_number'], $row['cinema_seat_list'], $row['cinema_screening'], $row['cinema_date'], $row['cinema_time_slot']);
                }
                
                return $getTime;
            }
            catch(Exception $e){
                echo "getTimeOfMovie failed";
            }
        }

        public function getRoomLeft($searchArg) {
            try {
                $query = "SELECT cinema_seat_list FROM cinema_room WHERE cinema_rm_ID = :searchArg";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':searchArg', $searchArg);
                $stmt->execute();
                
                $getRoomLeft = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($getRoomLeft !== false && isset($getRoomLeft['cinema_seat_list'])) {
                    return $getRoomLeft['cinema_seat_list'];
                } else {
                    // Handle the case when no rows were returned or the column is not present in the result set
                    return null; // or any other appropriate value
                }
            } catch (Exception $e) {
                echo "getRoomLeft failed: " . $e->getMessage();
            }
        }


        
        public function getRoomDetails($searchArg) {
            try {
                $query = "SELECT * FROM cinema_room WHERE cinema_rm_ID = :searchArg";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':searchArg', $searchArg);
                $stmt->execute();
        
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                // Create a new cinemaRoomE object using the fetched row data
                $getRoomDetails = new cinemaRoomE(
                    $row['cinema_rm_ID'],
                    $row['cinema_rm_number'],
                    $row['cinema_seat_list'],
                    $row['cinema_screening'],
                    $row['cinema_date'],
                    $row['cinema_time_slot']
                );
        
                return $getRoomDetails;
            } catch (Exception $e) {
                echo "getRoomDetails failed: " . $e->getMessage();
            }
        }
        
        // update remaining seat 
        public function updateSeat($cinemaRmID, $remainingSeats) {
            $query = "UPDATE cinema_room SET cinema_seat_list = :remainingSeats WHERE cinema_rm_ID = :cinemaRmID";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':remainingSeats', $remainingSeats);
            $stmt->bindParam(':cinemaRmID', $cinemaRmID);
            $stmt->execute();
            
        }
        
        
    }


    class cinemaRoomE {
       
        private int $cinema_rm_ID;
        private int $cinema_rm_number;
        private int $cinema_seat_list;
        private String $cinema_screening;
        private string $cinema_date;
        private string $cinema_time_slot;

        public function __construct($cinema_rm_ID, $cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot) {
            $this->cinema_rm_ID = $cinema_rm_ID;
            $this->cinema_rm_number = $cinema_rm_number;
            $this->cinema_seat_list = $cinema_seat_list;
            $this->cinema_screening = $cinema_screening;
            $this->cinema_date = $cinema_date;
            $this->cinema_time_slot = $cinema_time_slot;
        }

        #getter and setters
        public function getCinemaRmID(){
            return $this->cinema_rm_ID;
        }
    
        public function getCinemaRmNumber(){
            return $this->cinema_rm_number;
        }
    
        public function getCinemaSeatList(){
            return $this->cinema_seat_list;
        }
    
        public function getCinemaScreening(){
            return $this->cinema_screening;
        }

        public function getCinemaDate(){
            return $this->cinema_date;
        }
    
        public function getCinemaTimeSlot(){
            return $this->cinema_time_slot;
        }
    
    }

?>