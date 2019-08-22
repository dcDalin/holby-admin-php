$("document").ready(function(e) {
  $("#new-partner-logo-form").validate({
    rules: {
      name: {
        required: true,
        minlength: 5,
        maxlength: 10
      },
      thumbnail: {
        required: true
      }
    },
    messages: {
      name: {
        required: "What is the name of the partner?",
        minlength: "Name title should be at least 5 characters",
        maxlength: "Maximum length is 10 characters"
      },
      thumbnail: {
        required: "Logo image is required"
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
        url: "ajax/partner-logo-new-ajax.php",
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
                  $("#new-partner-logo-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-create-slider")
                .html("Add Partner Item")
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
          $("#new-partner-logo-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
