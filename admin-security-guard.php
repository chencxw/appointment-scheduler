<?php 
session_start();
// Variables
Const TIMEOUT_IN_SECONDS = 3600;

// Confirm that users are logged in
if( !isset($_SESSION['username']) ) {
    $error = array("<p>Please login to view the page.</p>");
    $_SESSION['errorMessages'] = $error;
    header("Location: admin-login.php");
    die();
}

// Check if the session has timed out.
if( isset($_SESSION['timeLastActive'])) {
    $timeNow = time();
    $difference = $timeNow - $_SESSION['timeLastActive']; 

    if( $difference > TIMEOUT_IN_SECONDS ) {
        $error = array('<p>You have been logged out due to inactivity.</p>');
        $_SESSION['errorMessages'] = $error;
        unset($_SESSION['username']);
        unset($_SESSION['adminID']);
        header("Location:admin-login.php");
        die();
    }else {
        $_SESSION['timeLastActive'] = time();
    }
}
?>