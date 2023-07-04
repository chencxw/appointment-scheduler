<?php
session_start();

// Variables.
$errorArray = array();
$username   = '';
$password   = '';

// Check if form fields are set.
if ( !isset($_POST['username']) || !isset($_POST['password']) ) {
    $errorArray[] = '<p>Please login.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-login.php");
    die();
}

// Check if form fields contain data.
if( trim($_POST['username'])=="" ||  trim($_POST['password'])=="" ) {
    $errorArray[] = '<p>Please fill in the form.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-login.php");
    die();
}

// Store form fiel data.
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Connect to the database and confirm user exists.
require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Output error message if unable to connect.
if(mysqli_connect_errno() !=0 ){
    $errorArray[] = "<p>Could not connect to database to log you in. Please try again later.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: user-login.php");
	die();
}

// Protect against SQL injection.
$username = $database->real_escape_string($username);
$password = $database->real_escape_string($password);

// Confirm password.
$query = "SELECT user_password FROM users WHERE user_name='$username';";
$results = $database->query($query);

if( $results->num_rows != 1 ) {
    $errorArray[] = "<p>Invalid username. Please try again.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-login.php");
    die();
}

// If user name is in the database, get the record.
$record = $results->fetch_row();
$passwordFromDatabase = $record[0];

if( password_verify($password, $passwordFromDatabase) == false ) {
    $errorArray[] = "<p>Invalid password. Please try again.</p>";
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-login.php");
    die();
}

// Get the user ID, first name, and last name to store it in a session to use for the booking page
$query2 = "SELECT user_id, first_name, last_name FROM users WHERE user_name='$username';";
$results2 = $database->query($query2);
$record2 = $results2->fetch_row();
$userIDFromDatabase = $record2[0];
$userFirstNameFromDatabase = $record2[1];
$userLastNameFromDatabase = $record2[2];

$database->close();

// Store username.
$_SESSION['username'] = ucfirst(strtolower($username));
$_SESSION['timeLastActive'] = time();
$_SESSION['userID'] = $userIDFromDatabase;
$_SESSION['userFirstName'] = $userFirstNameFromDatabase;
$_SESSION['userLastName'] = $userLastNameFromDatabase;
header("location: user-booking-page.php");
die();
?>