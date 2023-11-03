<?php
    class ticketSalesDailyController{
        
        public function printticketSalesDaily($searchArg) {
            require_once 'bookTicketEntity.php';
            $ticketDailySales = new ticketSales();
            $retrieveDailyTixSales = $ticketDailySales->retrieveByDay($searchArg);
        
            if (!empty($retrieveDailyTixSales)) {
                return $retrieveDailyTixSales;
            }
            else {
                return FALSE;
            }
        }
        


    }
?>
            
    