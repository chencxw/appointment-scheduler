// Function to update form on the booking page with the selected value.
function select(cell, date, time) {
    // Update selected cell.
    let previouslySelected = document.querySelector('.selected');
    if ( previouslySelected != null ) {
        previouslySelected.classList.remove("selected");
    }
    cell.classList.add("selected");

    // Update confirm form.
    document.getElementById("date").value = date;
    document.getElementById("time").value = time;
    document.getElementById("confirm-slot").disabled = false;
}