<?php
    class movieList{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }

        public function addMovieToDatabase($movieName, $movieDescription, $movieAvailability){
            $stmt = $this->db->prepare('INSERT INTO movie (movieName, movieDescription, movieAvailability) VALUES (:movieName, :movieDescription, :movieAvailability)');
            $stmt->execute(array(':movieName'=>$movieName, ':movieDescription'=>$movieDescription,':movieAvailability'=>$movieAvailability));
        }

        public function isMovieNameTaken($movieName){
            $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieName=:movieName");
            $stmt->bindValue(':movieName', $movieName);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // movieName already exists
            } else {
                return false; // movieName doesn't exist
            }
        }
        public function displayMovie($keyword) {
            $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieName LIKE :keyword");            
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function viewMovieListing(){
            $stmt = $this->db->prepare("SELECT * FROM movie");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function isMovieIdExist($movieID) {
            $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieID= :movieID");
            $stmt->bindValue(':movieID', $movieID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // movieID exists
            } else {
                return false; // movieID doesn't exist
            }
        }

         // Update movie to the database
         public function updateMovieToDatabase($movieID, $movieName, $movieAvailability, $movieDescription) {
            // Prepare a statement to update the movie information in the database
            $stmt = $this->db->prepare('UPDATE movie SET movieName = :movieName, movieAvailability = :movieAvailability, movieDescription = :movieDescription WHERE movieID = :movieID');
            $stmt->execute(array(
                ':movieID' => $movieID,
                ':movieName' => $movieName,
                ':movieAvailability' => $movieAvailability,
                ':movieDescription' => $movieDescription
            ));
        }

        public function isMovieAlreadySuspended($movieID) {
            $stmt = $this->db->prepare("SELECT movieAvailability FROM movie WHERE movieID = :movieID");
            $stmt->bindValue(':movieID', $movieID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result && $result['movieAvailability'] == 0) {
                return true; // Movie is already suspended
            } else {
                return false; // Movie is not suspended
            }
        }

        public function suspendMovieToDatabase($movieID, $movieAvailability) {
            // Prepare a statement to suspend (update movieAvailability to 0) in the database
            $stmt = $this->db->prepare('UPDATE movie SET movieAvailability = :movieAvailability WHERE movieID = :movieID');
            $stmt->execute(array(
                ':movieID' => $movieID,
                ':movieAvailability' => $movieAvailability
            ));
        }

        public function isMovieNameCorrespondToCurrentMovieID($movieID, $movieName) {
            $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieID = :movieID AND movieName = :movieName");
            $stmt->bindValue(':movieID', $movieID);
            $stmt->bindValue(':movieName', $movieName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; 
            } else {
                return false; 
            }
        }

        public function isMovieNameAlreadyExistsElsewhere($movieID, $movieName) {
            $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieID != :movieID AND movieName = :movieName");
            $stmt->bindValue(':movieID', $movieID);
            $stmt->bindValue(':movieName', $movieName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; 
            } else {
                return false; 
            }
        }
        
    }

    class movie{
        private $movieID;
        private $movieName;
        private $movieDescription;
        private $movieAvailability;

        public function __construct($movieID, $movieName, $movieDescription, $movieAvailability){
            $this->movieID = $movieID;
            $this->movieName = $movieName;
            $this->movieDescription = $movieDescription;
            $this->movieAvailability = $movieAvailability;
        }

        public function getMovieID(){
            return $this->movieID;
        }

        public function getMovieName(){
            return $this->movieName;
        }

        public function getMovieDescription(){
            return $this->movieDescription;
        }

        public function getMovieAvailability(){
            return $this->movieAvailability;
        }
    }    
?>