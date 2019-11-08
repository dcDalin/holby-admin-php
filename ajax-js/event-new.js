$("document").ready(function(e) {

  $("#new-course-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 5
      },
      description: {
        required: true,
        minlength: 30
      },
      venue: {
        required: true,
        minlength: 4
      },
      date: {
        required: true
      },
      startTime: {
        required: true
      },
      endTime: {
        required: true
      },
      price: {
        required: true
      },
      thumbnail: {
        required: true
      }
    },
    messages: {
      title: {
        required: "What is the event title?",
        minlength: "Event title should be at least 5 characters"
      },
      description: {
        required: "What's the description of the event",
        minlength: "Should have at least 30 characters"
      },
      venue: {
        required: "What's the event venue?",
        minlength: "Should have at least 4 characters"
      },
      date: {
        required: "Date is required"
      },
      startTime: {
        required: "Event start time is required"
      },
      endTime: {
        required: "Event end time is required"
      },
      price: {
        required: "Price is required"
      },
      thumbnail: {
        required: "Select a thumbnail"
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
        url: "ajax/event-new-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-submit")
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
                  $("#new-course-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-submit")
                .html("Post Course")
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
              $("#btn-submit")
                .html("Post Course")
                .prop("disabled", false);
            }
          }, 3000);
        })
        .fail(function() {
          $("#new-course-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
}); 
