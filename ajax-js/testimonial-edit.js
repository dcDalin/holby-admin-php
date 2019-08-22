$("document").ready(function(e) {
  $("#edit-slider-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 3,
        maxlength: 10
      },
      slogan: {
        required: true,
        minlength: 10,
        maxlength: 100
      }
    },
    messages: {
      title: {
        required: "What is the name",
        minlength: "Name title should be at least 3 characters",
        maxlength: "Maximum length is 10 characters"
      },
      slogan: {
        required: "What is the testimonial?",
        minlength: "Testimonial should be at least 10 characters",
        maxlength: "Maximum length is 100 characters"
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
        url: "ajax/testimonial-edit-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-edit-slider")
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
                  $("#edit-slider-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-edit-slider")
                .html("Edit Slider")
                .prop("disabled", false);
              setTimeout(function() {
                location.reload(true);
              }, 3000);
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
              $("#btn-edit-slider")
                .html("Edit Slider")
                .prop("disabled", false);
            }
          }, 3000);
        })
        .fail(function() {
          $("#edit-slider-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
