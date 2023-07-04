<?php 
session_start();
// Variables.
$errorArray = array();
$selectedUser = "";

// Check if email in the URL has been passed correctly.
if ( !isset($_GET['date']) || !isset($_GET['time']) ) {
    $errorArray[] = '<p>Please select an appointment.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: admin-dashboard.php");
    die();
}

if ( !isset($_GET['date']) || !isset($_GET['time']) ) {
    $errorArray[] = '<p>Please select an appointment.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: admin-dashboard.php");
    die();
}

// Store the user id.
$selectedDate = trim($_GET['date']);
$selectedTime = trim($_GET['time']);

// // Connect to the database.
require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() !=0 ){
    $errorArray[] = "<p>Could not connect to database. Please try again later.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: logout.php");
    die();
}

// // Escape the input
$selectedDate = $database->real_escape_string($selectedDate);
$selectedTime = $database->real_escape_string($selectedTime);

// // Check if it is a valid appointment
$query = "SELECT user_id FROM appointments WHERE app_date='$selectedDate' AND app_slot='$selectedTime';";
$results = $database->query($query);

if( $results->num_rows != 1 ) {
    $errorArray[] = '<p>Please select a valid appointment.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: admin-dashboard.php");
    die();
}

$query2 = "DELETE FROM appointments WHERE app_date='$selectedDate' AND app_slot='$selectedTime';";
$results2 = $database->query($query2);

// // Check if delete was successful.
if( $database->affected_rows ==0 ) {
    $errorArray[] = "<p>There was a problem deleting the appointment from the Database. Please try again.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: admin-dashboard.php");
	die();
}else {
    $errorArray[] = "<p class='text-green'>The appointment has successfully been deleted.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: admin-dashboard.php");
	die();
}

$database->close();
?>

