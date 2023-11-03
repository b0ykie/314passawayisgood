<?php
    class ticketSalesController{
        
        public function printAllTixSales() {
            require_once 'bookTicketEntity.php';
            $ticketSales = new ticketSales();
            $retrieveTixSalse = $ticketSales->retrieveAllSales();
        
            if (!empty($retrieveTixSalse)) {
                return $retrieveTixSalse;
            }
            else {
                return FALSE;
            }
        }
        
        public function getAvailableMonths() {
            require_once 'bookTicketEntity.php';
            $ticketMonth = new ticketSales();
            $retrieveMonth = $ticketMonth->retrieveMonth();

            if (!empty($retrieveMonth)) {
                return $retrieveMonth;
            }
            else {
                echo "No month sales found.";
            }
        }

        public function getAvailableYears() {
            require_once 'bookTicketEntity.php';
            $ticketYear = new ticketSales();
            $retrieveYear = $ticketYear->retrieveYear();

            if (!empty($retrieveYear)) {
                return $retrieveYear;
            }
            else {
                echo "No month sales found.";
            }
        }

        public function getAvailableDays() {
            require_once 'bookTicketEntity.php';
            $ticketDays = new ticketSales();
            $retrieveDay = $ticketDays->retrieveDay();

            if (!empty($retrieveDay)) {
                return $retrieveDay;
            }
            else {
                echo "No month sales found.";
            }
        }

    }
?>
            
    