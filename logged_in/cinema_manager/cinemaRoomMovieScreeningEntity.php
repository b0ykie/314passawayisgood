<?php
    class cinemaRoomMovieScreeningType{
        private $db;

        //default constructor
        public function __construct() {
            // Connect to the database
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }
        
        
        // Add new FnB to the database
        public function addCinemaRoomToDatabase($cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot) {
            // Prepare a statement to insert the fnb information into the database
            $stmt = $this->db->prepare('INSERT INTO cinema_room (cinema_rm_number, cinema_seat_list, cinema_screening, cinema_date, cinema_time_slot) VALUES (:cinema_rm_number, :cinema_seat_list, :cinema_screening, :cinema_date, :cinema_time_slot)');
            $stmt->execute(array(':cinema_rm_number' =>$cinema_rm_number ,':cinema_seat_list'=>$cinema_seat_list, ':cinema_screening' =>$cinema_screening, ':cinema_date' =>$cinema_date, ':cinema_time_slot' =>$cinema_time_slot));
        }
        
        // Didnt use in the search function
        // Checks if movie_screening (movie name) exists as a movie listing
        public function isMovieNameExist($cinema_screening) {
            $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieName = :cinema_screening");
            $stmt->bindParam(':cinema_screening', $cinema_screening);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // movie_screening (movie name) exists 
            } else {
                return false; // movie_screening (movie name) doesnt exist
            }
        }

        public function isMovieDateValid($cinema_date) {
            $current_date = date('Y-m-d'); // Get the current system's date
            
            if ($cinema_date >= $current_date) {
                return true; // $cinema_date is the same date or after the current system's date
            } else {
                return false; // $cinema_date is before the current system's date
            }
        }

        public function isMovieTimeValid($cinema_time_slot, $cinema_date) {
            // Get the current system's date and time
            $currentDateTime = date('Y-m-d H:i:s');
        
            // Convert current system time and given time to Unix timestamps
            $currentTime = strtotime($currentDateTime);
            $givenTime = strtotime("$cinema_date $cinema_time_slot");
        
            // Compare the given time with the current system's time
            if ($givenTime >= $currentTime) {
                return true; // Movie time is valid (same or after current system time)
            } else {
                return false; // Movie time has passed the current system time
            }
        }



        public function isMovieDateExist($cinema_date) {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room WHERE cinema_date = :cinema_date");
            $stmt->bindParam(':cinema_date', $cinema_date);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // $cinema_date exists in the cinema_date column
            } else {
                return false; // $cinema_date doesn't exist in the cinema_date column
            }
        }

        public function isMovieTimeExist($cinema_time_slot) {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room WHERE cinema_time_slot = :cinema_time_slot");
            $stmt->bindParam(':cinema_time_slot', $cinema_time_slot);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return true; // cinema_time_slot exists
            } else {
                return false; // cinema_time_slot doesn't exist
            }
        }

        // Checks if a cinema room record with the exact given parameters already exists.
        public function isCinemaRoomNumberTaken($cinema_rm_number, $cinema_date, $cinema_time_slot) {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room WHERE cinema_rm_number = :cinema_rm_number 
                                        AND cinema_date = :cinema_date 
                                        AND cinema_time_slot = :cinema_time_slot");
            $stmt->bindValue(':cinema_rm_number', $cinema_rm_number);
            $stmt->bindValue(':cinema_date', $cinema_date);
            $stmt->bindValue(':cinema_time_slot', $cinema_time_slot);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // Record with the exact parameters already exists
            } else {
                return false; // No matching record found
            }
        }

        // Retrieve all cinemaRoomMovieScreening records from the database
        public function retrieveAllCinemaRoomMovieScreening() {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

         // Retrieve valid cinemaRoomMovieScreening records from the database and display
         public function displayCinemaRoomMovieScreening($cinema_screening) {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room WHERE cinema_screening LIKE :cinema_screening");
            $stmt->bindValue(':cinema_screening', '%' . $cinema_screening . '%');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        
        public function isCinemaRoomIdExist($cinema_rm_ID) {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room WHERE cinema_rm_ID = :cinema_rm_ID");
            $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // cinema_rm_id exists 
            } else {
                return false; // cinema_rm_id doesnt exist
            }
        }

        public function updateCinemaRoomMovieScreeningToDatabase($cinema_rm_ID, $cinema_rm_number, $cinema_screening, $cinema_date, $cinema_time_slot) {
            // Prepare a statement to update the cinema room movie screening information in the database
            $stmt = $this->db->prepare('UPDATE cinema_room SET cinema_rm_number = :cinema_rm_number, cinema_screening = :cinema_screening, cinema_date = :cinema_date, cinema_time_slot = :cinema_time_slot WHERE cinema_rm_ID = :cinema_rm_ID');
            $stmt->execute(array(
                ':cinema_rm_ID' => $cinema_rm_ID,
                ':cinema_rm_number' => $cinema_rm_number,
                ':cinema_screening' => $cinema_screening,
                ':cinema_date' => $cinema_date,
                ':cinema_time_slot' => $cinema_time_slot
            ));
        }

        // Checks if a cinema room record with the exact given parameters exists other than itself.
        public function isCinemaRoomTakenElsewhere($cinema_rm_ID, $cinema_rm_number, $cinema_date, $cinema_time_slot) {
            $stmt = $this->db->prepare("SELECT * FROM cinema_room WHERE cinema_rm_ID != :cinema_rm_ID
                                        AND cinema_rm_number = :cinema_rm_number 
                                        AND cinema_date = :cinema_date 
                                        AND cinema_time_slot = :cinema_time_slot");
            $stmt->bindValue(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->bindValue(':cinema_rm_number', $cinema_rm_number);
            $stmt->bindValue(':cinema_date', $cinema_date);
            $stmt->bindValue(':cinema_time_slot', $cinema_time_slot);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // Record with the exact parameters already exists
            } else {
                return false; // No matching record found
            }
        }

        // used in Create and Update 
        // Checks movie listing availability (when cinema manager suspends movie listing)
        function isMovieListingAvailable($cinema_screening)
        {
            // Assuming you have a database connection established

            // Fetch movie availability
            $query = "SELECT movieAvailability
                    FROM movie
                    WHERE movieName = :movieName";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':movieName', $cinema_screening, PDO::PARAM_STR);
            $stmt->execute();

            $movieAvailability = $stmt->fetchColumn();

            // Check if the movie listing is available
            if ($movieAvailability === 1) {
                return true;
            }

            return false; // Movie listing is not available
        }
        

        public function hasCustomerBookedScreening($cinema_rm_ID) {
            $stmt = $this->db->prepare("SELECT * FROM book_ticket WHERE cinema_rm_ID = :cinema_rm_ID");
            $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // The cinema room has customer bookings
            } else {
                return false; // The cinema room has no customer bookings
            }
        }

        // Retrieve cinema_date and cinema_time_slot based on cinema_rm_ID
        public function getCinemaMovieScreeningDateTime($cinema_rm_ID) {
            $stmt = $this->db->prepare("SELECT cinema_date, cinema_time_slot FROM cinema_room WHERE cinema_rm_ID = :cinema_rm_ID");
            $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Extract cinema_date and cinema_time_slot from the result
            $cinema_date = $result['cinema_date'];
            $cinema_time_slot = $result['cinema_time_slot'];

            // Return the cinema_date and cinema_time_slot as separate attributes
            return [$cinema_date, $cinema_time_slot];
        }
        
        // Delete cinema room movie screening
        function deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID) {

            $this->db->exec('SET FOREIGN_KEY_CHECKS = 0');
            // Prepare the delete statement
            $stmt = $this->db->prepare("DELETE FROM cinema_room WHERE cinema_rm_ID = :cinema_rm_ID");
            $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->execute();   
            
            $this->db->exec('SET FOREIGN_KEY_CHECKS = 1');
        }
        /*
        // Delete cinema room movie screening
        function deleteCinemaRoomMovieScreeningFromDatabase($cinema_rm_ID) {
            try {
                // Prepare the delete statement
                $stmt = $this->db->prepare("DELETE FROM cinema_room WHERE cinema_rm_ID = :cinema_rm_ID");
                $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
                $stmt->execute();   
            } catch (PDOException $e) {
                // Handle the exception appropriately
                echo "Error: " . $e->getMessage();
            }
        }
        */
        
        function isCurrentCinemaMovieScreeningSameAsCustomerBooked($cinema_rm_ID)
        {
            // Fetch cinema screening details
            $query = "SELECT cinema_screening, cinema_date, cinema_time_slot
                    FROM cinema_room
                    WHERE cinema_rm_ID = :cinema_rm_ID";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->execute();

            $cinemaScreeningDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            // Fetch movie booking details
            $query = "SELECT movie_name_booked, movie_screening_date, movie_screening_time
                    FROM book_ticket
                    WHERE cinema_rm_ID = :cinema_rm_ID";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':cinema_rm_ID', $cinema_rm_ID);
            $stmt->execute();

            $movieBookingDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            // Compare the values and return the result
            if ($cinemaScreeningDetails && $movieBookingDetails) {
                return $cinemaScreeningDetails['cinema_screening'] === $movieBookingDetails['movie_name_booked'] &&
                    $cinemaScreeningDetails['cinema_date'] === $movieBookingDetails['movie_screening_date'] &&
                    $cinemaScreeningDetails['cinema_time_slot'] === $movieBookingDetails['movie_screening_time'];
            }

            return false; // Either cinema or booking details not found
        }
        
        
    }

    class cinemaRoomMovieScreening {
        private int $cinema_rm_ID;
        private int $cinema_rm_number;
        private int $cinema_seat_list; //seat capacity
        private string $cinema_screening; //what movie is being screened
        private string $cinema_date; //what date is the cinema screening a movie
        private string $cinema_time_slot; //what time is the cinema screening a movie
    
        
        public function __construct($cinema_rm_ID, $cinema_rm_number, $cinema_seat_list, $cinema_screening, $cinema_date, $cinema_time_slot) {
            $this->cinema_rm_ID = $cinema_rm_ID;
            $this->cinema_rm_number = $cinema_rm_number;
            $this->cinema_seat_list = $cinema_seat_list;
            $this->cinema_screening = $cinema_screening;
            $this->cinema_date = $cinema_date;
            $this->cinema_time_slot = $cinema_time_slot;
        }

        public function getCinema_rm_ID() {
            return $this->cinema_rm_ID;
        }

        public function getCinema_rm_number() {
            return $this->cinema_rm_number;
        }

        public function getCinema_seat_list() {
            return $this->cinema_seat_list;
        }

        public function getCinema_screening() {
            return $this->cinema_screening;
        }

        public function getCinema_date() {
            return $this->cinema_date;
        }

        public function getCinema_time_slot() {
            return $this->cinema_time_slot;
        }

        public function setCinema_rm_ID($cinema_rm_ID){
            $this->cinema_rm_ID = $cinema_rm_ID;
        }

        public function setCinema_rm_number($cinema_rm_number){
            $this->cinema_rm_number = $cinema_rm_number;
        }

        public function setCinema_seat_list($cinema_seat_list){
            $this->cinema_seat_list = $cinema_seat_list;
        }

        public function setCinema_screening($cinema_screening){
            $this->cinema_screening = $cinema_screening;
        }

        public function setCinema_date($cinema_date){
            $this->cinema_date = $cinema_date;
        }

        public function setCinema_time_slot($cinema_time_slot){
            $this->cinema_time_slot = $cinema_time_slot;
        }

    
    }

?>