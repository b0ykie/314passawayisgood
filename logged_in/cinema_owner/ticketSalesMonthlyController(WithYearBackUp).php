<?php
    class ticketSalesMonthlyController{
        
        public function printticketSalesMonthly($searchArgMonth, $searchArgYear) {
            require_once 'bookTicketEntity.php';
            $ticketMonthlySales = new ticketSales();
            $retrieveMonthlyTixSales = $ticketMonthlySales->retrieveByMonth($searchArgMonth, $searchArgYear);
        
            if (!empty($retrieveMonthlyTixSales)) {
                return $retrieveMonthlyTixSales;
            }
            else {
                echo "No ticket sales found.";
            }
        }
        


    }
?>
            
    