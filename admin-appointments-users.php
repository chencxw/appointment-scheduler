<?php
// Variables.
$allAppointments = array();
$allAdminUsers = array();

// Connect to database.
require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() !=0 ){
    $errorArray[] = "<p>Could not connect to database. Please try again later.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: logout.php");
    die();
}

// Get all booked appointments.
$query = "SELECT * FROM appointments;";
$result = $database->query($query);

while( $record = $result->fetch_row() ) {
    $allAppointments[] = $record;
}

// Get all admin users.
$query2 = "SELECT * FROM admins;";
$results2 = $database->query($query2);

while( $record2 = $results2->fetch_assoc() ) {
    $allAdminUsers[] = $record2;
}

$database->close();
?>