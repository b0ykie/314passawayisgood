<?php
    class ticketSalesMonthlyController{
        
        public function printticketSalesMonthly($searchArg) {
            require_once 'bookTicketEntity.php';
            $ticketMonthlySales = new ticketSales();
            $retrieveMonthlyTixSales = $ticketMonthlySales->retrieveByMonth($searchArg);
        
            if (!empty($retrieveMonthlyTixSales)) {
                return $retrieveMonthlyTixSales;
            }
            else {
                return FALSE;
            }
        }
    }
?>
            
    