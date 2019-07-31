$("document").ready(function(e) {
  $("#new-slider-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 5,
        maxlength: 10
      },
      slogan: {
        required: true,
        minlength: 5,
        maxlength: 20
      },
      thumbnail: {
        required: true
      }
    },
    messages: {
      title: {
        required: "What is the slider title?",
        minlength: "Slider title should be at least 5 characters",
        maxlength: "Maximum length is 10 characters"
      },
      slogan: {
        required: "What is the slogan?",
        minlength: "Slogan should be at least 5 characters",
        maxlength: "Maximum length is 20 characters"
      },
      thumbnail: {
        required: "Slider image is required"
      }
    },
    errorPlacement: function(error, element) {
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html(error.html());
    },
    highlight: function(element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element)
        .closest(".form-group")
        .removeClass("has-error");
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html("");
    },
    submitHandler: function(form) {
      var formData = new FormData(form);
      $.ajax({
        url: "ajax/slider-new-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-create-slider")
            .html(
              '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
            )
            .prop("disabled", true);
          $("input, textarea, select").prop("disabled", true);

          setTimeout(function() {
            if (data.status === "success") {
              $("#errorDiv")
                .slideDown("fast", function() {
                  $("#errorDiv").html(
                    '<div class="alert alert-success">' +
                      data.message +
                      "</div>"
                  );
                  $("#new-slider-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-create-slider")
                .html("Add Slider Item")
                .prop("disabled", false);
            } else {
              $("#errorDiv")
                .slideDown("fast", function() {
                  $("#errorDiv").html(
                    '<div class="alert alert-error">' + data.message + "</div>"
                  );
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-create-slider")
                .html("Add Slider Item")
                .prop("disabled", false);
            }
          }, 3000);
        })
        .fail(function() {
          $("#new-slider-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
