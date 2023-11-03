<?php
    class fnbSalesDailyController{
        
        public function printFnbSalesDaily($searchArg) {
            require_once 'bookfnbEntity.php';
            $fnbDailySales = new fnbSales();
            $retrieveDailyFnbSales = $fnbDailySales->retrieveFnbByDay($searchArg);
        
            if (!empty($retrieveDailyFnbSales)) {
                return $retrieveDailyFnbSales;
            }
            else {
                return FALSE;
            }
        }
        


    }
?>
            
    