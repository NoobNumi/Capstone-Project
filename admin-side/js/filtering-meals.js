
$(document).ready(function () {
    $("#searchInput, .sorting-list").on("input change", function () {
        filterMeals();
    });

    function filterMeals() {
        var searchText = $("#searchInput").val().toLowerCase();
        var selectedCategory = $(".sorting-list").val().toLowerCase();
        var $meals = $(".searchable-card");

        $meals.each(function () {
            var $meal = $(this);
            var mealID = $meal.find("td:nth-child(1)").text().toLowerCase();
            var mealName = $meal.find("td:nth-child(2)").text().toLowerCase();
            var mealCategory = $meal.find("td:nth-child(3)").text().toLowerCase();

            var isTextMatch = mealID.includes(searchText) || mealName.includes(searchText);
            var isCategoryMatch = selectedCategory === '' || mealCategory === selectedCategory;

            if (isTextMatch && isCategoryMatch) {
                $meal.show();
            } else {
                $meal.hide();
            }
        });

        updateNoMealsMessage();
    }

    function updateNoMealsMessage() {
        var $visibleMeals = $(".searchable-card:visible");
        var $noMealsMessage = $(".no-meals-message");

        if ($visibleMeals.length === 0) {
            $noMealsMessage.text("No meals found");
            $noMealsMessage.show();
        } else {
            $noMealsMessage.text("");
            $noMealsMessage.hide();
        }
    }
});