// Function to filter table rows based on the search input
function filterTable() {
    // Get the search input value
    var searchValue = document.getElementById("searchInput").value.toLowerCase();

    // Get all table rows with class 'searchable-card'
    var tableRows = document.getElementsByClassName("searchable-card");
    var noUsersMessage = document.querySelector(".no-users-message");

    // Initialize a variable to keep track of whether any matching rows are found
    var found = false;

    // Loop through the table rows and hide/show them based on the search input
    for (var i = 0; i < tableRows.length; i++) {
        var userId = tableRows[i].querySelector("td:first-child").textContent.toLowerCase();
        var firstName = tableRows[i].querySelector("td:nth-child(3)").textContent.toLowerCase();
        var lastName = tableRows[i].querySelector("td:nth-child(4)").textContent.toLowerCase();
        var email = tableRows[i].querySelector("td:nth-child(5)").textContent.toLowerCase();

        if (
            userId.includes(searchValue) ||
            firstName.includes(searchValue) ||
            lastName.includes(searchValue) ||
            email.includes(searchValue)
        ) {
            tableRows[i].style.display = "";
            found = true; // Matching row found
        } else {
            tableRows[i].style.display = "none";
        }
    }

    // Update the no-users-message and table visibility based on whether any matching rows are found
    if (found) {
        noUsersMessage.style.display = "none"; // Hide the message
    } else {
        noUsersMessage.textContent = "No users found";
        noUsersMessage.style.display = "block"; // Show the message
    }

    // Hide or show the entire table based on whether any matching rows are found
    document.querySelector(".user-table").style.display = found ? "table" : "none";
}

// Add an input event listener to the search input field
document.getElementById("searchInput").addEventListener("input", filterTable);
