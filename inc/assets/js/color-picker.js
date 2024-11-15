jQuery(document).ready(function ($) {
  $(".color-field").wpColorPicker();

  // Function to apply colors to layout cards
  function applyColors() {
    console.log("Applying colors...");
    var bgColor = $("#author_bg_color").val(); 
    var textColor = $("#author_text_color").val(); 

    // Update styles for each layout card
    $(".layout-card").each(function () {
      $(this).css("background-color", bgColor);
      $(this).find(".layout-preview-content").css("color", textColor);
      $(this).find("a.button").css("background-color", textColor); 
    });
  }

  // Initial color application
  applyColors();
  // When the color inputs change, re-apply the colors
  $("#author_bg_color, #author_text_color").on("input change", function () {
    applyColors();
  });

  $(".layout-card").on("click", function () {
    $(".layout-card").removeClass("selected-layout"); 
    $(this).addClass("selected-layout"); 
    $(this).find('input[type="radio"]').prop("checked", true); 
  });
});
