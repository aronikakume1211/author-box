jQuery(document).ready(function ($) {
  $(".color-field").wpColorPicker();

  // Function to apply colors to layout cards
  function applyColors() {
    console.log("Applying colors...");
    var bgColor = $("#author_bg_color").val(); // Get background color
    var textColor = $("#author_text_color").val(); // Get text color

    // Update styles for each layout card
    $(".layout-card").each(function () {
      $(this).css("background-color", bgColor);
      $(this).find(".layout-preview-content").css("color", textColor);
      $(this).find("a.button").css("background-color", textColor); // Update button color
    });
  }

  // Initial color application
  applyColors();
  // When the color inputs change, re-apply the colors
  $("#author_bg_color, #author_text_color").on("input change", function () {
    applyColors();
  });

  $(".layout-card").on("click", function () {
    $(".layout-card").removeClass("selected-layout"); // Remove previous selection
    $(this).addClass("selected-layout"); // Highlight selected card
    $(this).find('input[type="radio"]').prop("checked", true); // Check the selected radio
  });
});
