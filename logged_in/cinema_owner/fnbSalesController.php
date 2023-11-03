<?php
    class fnbSalesController{
        
        public function printAllFnbSales() {
            require_once 'bookfnbEntity.php';
            $fnbSales = new fnbSales();
            $retrieveFnbSalse = $fnbSales->retrieveAllFnbSales();
        
            if (!empty($retrieveFnbSalse)) {
                return $retrieveFnbSalse;
            }
            else {
                return FALSE;
            }
        }
        
        public function getAvailableFnbMonths() {
            require_once 'bookfnbEntity.php';
            $fnbMonth = new fnbSales();
            $retrieveFnbMonth = $fnbMonth->retrieveFnbMonth();

            if (!empty($retrieveFnbMonth)) {
                return $retrieveFnbMonth;
            }
            else {
                echo "No month sales found.";
            }
        }

        public function getAvailableFnbDays() {
            require_once 'bookTicketEntity.php';
            $fnbDays = new fnbSales();
            $retrieveFnbDay = $fnbDays->retrieveFnbDay();

            if (!empty($retrieveFnbDay)) {
                return $retrieveFnbDay;
            }
            else {
                echo "No month sales found.";
            }
        }

    }
?>
            
    