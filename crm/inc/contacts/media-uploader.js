jQuery(document).ready(function ($) {
  $(".upload-image-button").on("click", function (e) {
    e.preventDefault();

    var frame = wp.media({
      title: "Upload or Select Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    frame.on("select", function () {
      var attachment = frame.state().get("selection").first().toJSON();
      var targetField = $(this).data("target");
      $('input[name="' + targetField + '"]').val(attachment.url);
    });

    frame.open();
  });
});
