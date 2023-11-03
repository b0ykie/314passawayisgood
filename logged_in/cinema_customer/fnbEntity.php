<?php

    class fnb {

        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }

        public function getAvailfnb(){
            try {
                $query = "SELECT * FROM fnb WHERE fnb_availability = 1";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
        
                $availFnb = [];
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $availFnb[] = new fnbE($row['fnbID'], $row['fnbName'], $row['fnb_availability'], $row['fnb_loyalty_pt'], $row['fnb_price']);
                }
        
                return $availFnb;

            } catch(Exception $e){
                echo "getAvailfnb failed";
            }
        }
        

        
        
    }


    class fnbE {
       
        private int $fnbID ;
        private string $fnbName ;
        private int $fnb_availability;
        private int $fnb_loyalty_pt;
        private int $fnb_price;

        public function __construct($fnbID, $fnbName, $fnb_availability, $fnb_loyalty_pt, $fnb_price) {
            $this->fnbID = $fnbID;
            $this->fnbName = $fnbName;
            $this->fnb_availability = $fnb_availability;
            $this->fnb_loyalty_pt = $fnb_loyalty_pt;
            $this->fnb_price = $fnb_price;
        }

        #getter and setters
        public function getfnbID(){
            return $this->fnbID;
        }
    
        public function getfnbName(){
            return $this->fnbName;
        }
    
        public function getfnbAvailability(){
            return $this->fnb_availability;
        }
    
        public function getfnbLoyaltyPts(){
            return $this->fnb_loyalty_pt;
        }

        public function getfnbPrice(){
            return $this->fnb_price;
        }
    
    }

?>