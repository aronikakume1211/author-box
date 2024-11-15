jQuery(document).ready(function ($) {
  let mediaUploader;
  $("#uploadimage").on("click", function (e) {
    e.preventDefault();

    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media.file_frame = wp.media({
      title: "Choose a profile Picture",
      button: {
        text: "Choose Picture",
      },
      multiple: false,
    });

    mediaUploader.on("select", function () {
      attachment = mediaUploader.state().get("selection").first().toJSON();
      console.log("attachment");
      $("#profile_picture").val(attachment.url);
      $("#profile-picture-preview").css(
        "background-image",
        "url(" + attachment.url + ")"
      );
    });

    mediaUploader.open();
  });

  // Handle remove picture button click
  $("#remove-picture").on("click", function (e) {
    e.preventDefault();

    const confirmation = confirm(
      "Are you sure you want to remove your profile picture?"
    );

    if (confirmation) {
      $("#profile_picture").val("");
      $("#profile-picture-preview").css(
        "background-image",
        "url('https://1.gravatar.com/avatar/d459c0256b4417973ea8b940d7a82021?s=96&d=mm&r=g')"
      );
    }
  });

  // Handle tab switching
  $('.nav-tab').on('click', function (e) {
    e.preventDefault();
    $('.nav-tab').removeClass('nav-tab-active');
    $(this).addClass('nav-tab-active');
    $('.tab-content').hide();
    $($(this).attr('href')).show();
});
});
