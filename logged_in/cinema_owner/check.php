<?php
    // session_start();
    // //$username = $_SESSION['username'];
    // $month = $_POST['viewMonth'];

    // echo $month;
    // //require_once('ticketSalesMonthlyController.php');

    // echo $currentDateTime = date('Y-m-d H:i:s');

    require_once('bookTicketEntity.php');
    $ticketSales = new ticketSales();

    $availableMonths = $ticketSales->retrieveMonth();

    foreach ($availableMonths as $month) {
        echo $month;
        }

?>



<!-- while ($row = mysqli_fetch_assoc($result)) {
    //Create an option for each month
    $month = $row['month'];
    echo "<option value='$month'>$month</option>";
} -->