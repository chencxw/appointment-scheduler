<?php 
session_start();
// Variables.
$errorArray = array();
$selectedAdmin = "";

// Check if email in the URL has been passed correctly.
if ( !isset($_GET['username']) ) {
    $errorArray[] = '<p>Please select an account.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: admin-dashboard.php");
    die();
}

if ( empty($_GET['username']) ) {
    $errorArray[] = '<p>Please select an account.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: admin-dashboard.php");
    die();
}

// Store the admin email.
$selectedAdmin = trim($_GET['username']);

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
$selectedAdmin = $database->real_escape_string($selectedAdmin);

// // Check if it is a valid email
$query = "SELECT admin_username FROM admins WHERE admin_username='$selectedAdmin';";
$results = $database->query($query);

if( $results->num_rows != 1 ) {
    $errorArray[] = '<p>Please select a valid account.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: admin-dashboard.php");
    die();
}

$query2 = "DELETE FROM admins WHERE admin_username='$selectedAdmin';";
$results2 = $database->query($query2);

// // Check if delete was successful.
if( $database->affected_rows ==0 ) {
    $errorArray[] = "<p>There was a problem deleting the account from the Database. Please try again.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: admin-dashboard.php");
	die();
}else {
    $errorArray[] = "<p class='text-green'>The account has successfully been deleted.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: admin-dashboard.php");
	die();
}

$database->close();
?>

