// Function to show a confirm window when deleting admin account
function confirmAdminDelete(adminUsername) {
    const userAnswer = confirm(`Are you sure you want to delete this account ${adminUsername}?`);
    if( userAnswer == true ) {
        window.location.href = `delete-admin.php?username=${adminUsername}`;
    }
}

// Function to show a confirm window when deleting an appointment
function confirmAppDelete(userFirstName, userLastName, appDate, appTime) {
    const userAnswer = confirm(`Are you sure you want to delete this appointment for ${userFirstName} ${userLastName}?`);
    if( userAnswer == true ) {
        window.location.href = `delete-appointment.php?date=${appDate}&time=${appTime}`;
    }
}