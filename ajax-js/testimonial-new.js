$("document").ready(function(e) {
  $("#new-slider-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 3,
        maxlength: 10
      },
      slogan: {
        required: true,
        minlength: 15,
        maxlength: 100
      },
      thumbnail: {
        required: true
      }
    },
    messages: {
      title: {
        required: "Name is required?",
        minlength: "Name should be at least 3 characters",
        maxlength: "Maximum length is 10 characters"
      },
      slogan: {
        required: "What is the testimonial?",
        minlength: "Testimonial should be at least 15 characters",
        maxlength: "Maximum length is 100 characters"
      },
      thumbnail: {
        required: "Image is required"
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
        url: "ajax/testimonial-new-ajax.php",
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
                .html("Add Testimonials")
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
                .html("Add Testimonial")
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
