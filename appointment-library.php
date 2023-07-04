<?php 
// Variables.
$start             = strtotime("+". 1 ." day"); // Next day
$end               = strtotime("+". 20 ." day"); // Next 30 days
$from              = date("Y-m-d", $start);
$to                = date("y-m-d", $end);
$allAppointments   = [];
$openTime          = strtotime('9 am');
$openTime2         = strtotime('9 am');
$closeTime         = strtotime('5 pm');
$app_slots         = [];
$display_app_slots = [];
$errorArray        = [];

// Create appointment slot array.
// Function from Dark Knight on https://stackoverflow.com/questions/3903317/how-can-i-make-an-array-of-times-with-half-hour-intervals
while( $closeTime >= $openTime ) {
    $app_slots[] = date("h:i:s", $openTime);
    $openTime = strtotime('+30 minutes', $openTime);
}

// Create another array to display in the header in a different format
while( $closeTime >= $openTime2 ) {
    $display_app_slots[] = date("g:i", $openTime2);
    $openTime2 = strtotime('+30 minutes', $openTime2);
}

// Connect to database.
require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() !=0 ){
    $errorArray[] = "<p>Could not connect to database. Please try again later.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: logout.php");
    die();
}

// Get appointments in a date range
$query = "SELECT * FROM appointments WHERE app_date BETWEEN '$from' AND '$to';";
$result = $database->query($query);

while( $record = $result->fetch_row() ) {
    $allAppointments[$record[0]][$record[1]] = $record[2];
}

$database->close();

?>