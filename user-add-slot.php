<?php 
// Save appointment slot to database.
session_start();
$errorArray = array();
// // Variables.
$dateSelected  = $_POST['date'];
$timeSelected  = $_POST['time'];
$userID        = $_SESSION['userID'];
$userFirstName = $_SESSION['userFirstName'];
$userLastName  = $_SESSION['userLastName'];

// Connect to database.
require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() !=0 ){
    $errorArray[] = "<p>Could not connect to database. Please try again later.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-login.php");
    die();
}

// Add the appointment to the database.
$query = "INSERT INTO appointments(app_date, app_slot, user_id, first_name, last_name) VALUES ('$dateSelected', '$timeSelected', $userID, '$userFirstName', '$userLastName');";
$results = $database->query($query);

if( $database->affected_rows < 1 ) {
    $errorArray = "<p>Could not book the appointment. Please try again.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-booking-page.php");
    die();
}

$database->close();

// Store the date and time selected in the session.
$_SESSION['app-date'] = $dateSelected;
$_SESSION['app-time'] = $timeSelected;
header("Location: user-confirm.php");
die();
?>