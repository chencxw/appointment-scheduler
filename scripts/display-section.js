// Get elements.
const appointmentsTab = document.querySelector('.appointments-tab');
const accountsTab = document.querySelector('.accounts-tab');

// Display scheduled appointments tab
function displayAppointments() {
    // Toggle display.
    appointmentsTab.style.display = 'block';
    accountsTab.style.display = 'none';
}

// Display admin accounts tab.
function displayAdminAccounts() {
    // Toggle display.
    appointmentsTab.style.display = 'none';
    accountsTab.style.display = 'block';
}