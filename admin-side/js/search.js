function liveSearch() {
    const searchInput = document.querySelector(".admin-search-bar input");
    const chatPeopleContainer = document.querySelector(".chat-people");

    searchInput.addEventListener("input", function () {
        const searchText = searchInput.value.trim();

        $.ajax({
            method: "POST",
            url: "search_users.php",
            data: { search: searchText },
            success: function (response) {
                chatPeopleContainer.innerHTML = response;
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status, error);
            }
        });
    });
}

liveSearch();
