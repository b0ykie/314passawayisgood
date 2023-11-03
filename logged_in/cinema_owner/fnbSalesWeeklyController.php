<?php
    class fnbSalesWeeklyController{
        
        public function printFnbSalesWeekly($week, $viewWeeklyOfMonth) {
            if ($week == 1){
                $startDate = 1;
                $endDate = 7;
            }
            else if ($week == 2){
                $startDate = 8;
                $endDate = 14;
            }
            else if ($week == 3){
                $startDate = 15;
                $endDate = 21;
            }
            else{
                $startDate = 22;
                $endDate = 31;
            }

            require_once 'bookfnbEntity.php';
            $fnbWeeklySales = new fnbSales();
            $retrieveWeeklyFnbSales = $fnbWeeklySales->retrieveFnbByWeek($viewWeeklyOfMonth, $startDate, $endDate);
        
            if (!empty($retrieveWeeklyFnbSales)) {
                return $retrieveWeeklyFnbSales;
            }
            else {
                return FALSE;
            }
        }
        


    }
?>
            
    