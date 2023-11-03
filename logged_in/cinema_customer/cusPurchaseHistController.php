<?php
    class cusPurchaseHistController{  
    
        public function retrievePurHist($searchArg){
            require_once '../cinema_owner/bookTicketEntity.php';
            $ticketSales = new ticketSales();
            $retrievePurHist = $ticketSales->retrievePurchaseHist($searchArg);

            if (!empty($retrievePurHist)) {
                return $retrievePurHist;
            }
            else {
                return FALSE;
            }

        }

        public function retrieveFnBPurHist($searchArg){
            require_once '../cinema_owner/bookfnbEntity.php';
            $fnbSales = new fnbSales();
            $retrieveFnBPurHist = $fnbSales->retrieveFnBPurchaseHist($searchArg);

            if (!empty($retrieveFnBPurHist)) {
                return $retrieveFnBPurHist;
            }
            else {
                return FALSE;
            }

        }

    }
?>