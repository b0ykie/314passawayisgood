<?php
    class fnbSalesMonthlyController{
        
        public function printFnbSalesMonthly($searchArg) {
            require_once 'bookfnbEntity.php';
            $fnbMonthlySales = new fnbSales();
            $retrieveMonthlyFnbSales = $fnbMonthlySales->retrieveFnbByMonth($searchArg);
        
            if (!empty($retrieveMonthlyFnbSales)) {
                return $retrieveMonthlyFnbSales;
            }
            else {
                return FALSE;
            }
        }
    }
?>
            
    