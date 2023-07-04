<?php 
// Use session.
session_start();

// Variables.
// const EMAIL_REGEX = '^[\w\.=-]+@[\w\.-]+\.[\w]{2,3}$';
$username				= "";
$userFirstName 			= "";
$userLastName			= "";
$email                  = "";
$password				= "";
$passwordRetyped		= "";
$errorArray             = array();

// Check that the form data is set.
if(	!isset($_POST['username']) ||
	!isset($_POST['userFirstName']) ||
	!isset($_POST['userLastName']) ||
    !isset($_POST['email']) ||
	!isset($_POST['password']) || 
	!isset($_POST['passwordRetyped'])){
		
    $errorArray[] = '<p>Please fill in the form.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-registration.php");
    die();
}

// Check that the form fields contain data.
if(	trim($_POST['username'])=="" || 
	trim($_POST['userFirstName']) =="" ||
	trim($_POST['userLastName']) =="" ||
    trim($_POST['email']) =="" ||
	trim($_POST['password'])=="" || 
	trim($_POST['passwordRetyped'])=="" ) {
		
    $errorArray[] = '<p>Please fill in the form.</p>';
    $_SESSION['errorMessages'] = $errorArray;
    header("Location: user-registration.php");
    die();
}

// Store data in variables.
$username				= trim($_POST['username']);
$userFirstName 			= trim($_POST['userFirstName']);
$userLastName			= trim($_POST['userLastName']);
$email                  = trim($_POST['email']);
$password				= trim($_POST['password']);
$passwordRetyped		= trim($_POST['passwordRetyped']);
// Store entered values in a session to autofill inputs if user makes a mistake when filling out form
$_SESSION['enteredUsername'] = $username;
$_SESSION['enteredFirstName'] = $userFirstName;
$_SESSION['enteredLastName'] = $userLastName;
$_SESSION['enteredEmail'] = $email;

// Check if email is the correct format.
// if( preg_match(EMAIL_REGEX, $email) == 0 ) {
//     $errorArray[] = "<p>Please enter a valid email address.</p>";
// 	$_SESSION['errorMessages'] = $errorArray;
// 	header("Location: user-registration.php");
// 	die();
// }

// Check if typed passwords match.
if( $password != $passwordRetyped	){
    $errorArray[] = "<p>The entered passwords do not match. Please try again.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: user-registration.php");
	die();
}

// Check if username already exists in database.
require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Output error message if unable to connect to database.
if(mysqli_connect_errno() !=0 ){
    $errorArray[] = "<p>Could not connect to database to register you. Please try again later.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: user-registration.php");
	die();
}

// Escape strings
$username = $database->real_escape_string($username);
$userFirstName = $database->real_escape_string($userFirstName);
$userLastName = $database->real_escape_string(($userLastName));
$email = $database->real_escape_string($email);
$password = $database->real_escape_string($password);

// Check database for username.
$query = "SELECT * FROM users WHERE user_name='$username';";
$results = $database->query( $query );

// If results return more than 0 rows, the username is already being used
if( $results->num_rows > 0 ){
    $errorArray[] = "<p>The username $username already exists. Please choose a different name.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: user-registration.php");
	die();
}

// Hash the password before adding it to the database.
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$query2 = "INSERT INTO users(user_name, first_name, last_name, user_email, user_password) VALUES('$username', '$userFirstName', '$userLastName', '$email', '$hashedPassword');";
$results = $database->query($query2);

// Check if user has successfully been added
if( $database->affected_rows == 0) {
    $errorArray[] = "<p>There was a problem adding you to the database. Please try again.</p>";
	$_SESSION['errorMessages'] = $errorArray;
	header("Location: user-registration.php");
	die();
}

// Close the connection.
$database->close();

// Store success message in the error array to avoid repeating code.
$errorArray[] = "<p class='text-green'>Your account has been registered. Please login to book an appointment.</p>";
$_SESSION['errorMessages'] = $errorArray;
header("Location: user-login.php");
die();
?>