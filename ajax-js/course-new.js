$("document").ready(function(e) {
  $.validator.addMethod("lessThan", function(value, element, param) {
    var i = parseFloat(value);
    var j = parseFloat(param);
    return i < j ? true : false;
  });

  $("#new-course-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 5
      },
      months: {
        required: true,
        lessThan: 12
      },
      weeks: {
        required: true,
        lessThan: 4
      },
      days: {
        required: true,
        lessThan: 31
      },
      hours: {
        required: true,
        lessThan: 24
      },
      minutes: {
        required: true,
        lessThan: 60
      },
      individual: {
        required: true
      },
      organizational: {
        required: true
      },
      price: {
        required: true
      },
      thumbnail: {
        required: true
      },
      level: {
        required: true,
        minlength: 1
      }
    },
    messages: {
      title: {
        required: "What is the course title?",
        minlength: "Course title should be at least 5 characters"
      },
      months: {
        required: "What is the duration? Set 0 if none",
        lessThan: "Should be less than 12 months"
      },
      weeks: {
        required: "What is the duration? Set 0 if none",
        lessThan: "Should be less than 4 weeks"
      },
      days: {
        required: "What is the duration? Set 0 if none",
        lessThan: "Should be less than 31 days"
      },
      hours: {
        required: "What is the duration? Set 0 if none",
        lessThan: "Should be less than 24 hours"
      },
      minutes: {
        required: "What is the duration? Set 0 if none",
        lessThan: "Should be less than 60 minutes"
      },
      individual: {
        required: "Pick 'Yes' or 'No'"
      },
      organizational: {
        required: "Pick 'Yes' or 'No'"
      },
      price: {
        required: "Price is required"
      },
      thumbnail: {
        required: "Select a thumbnail"
      },
      level: {
        required: "What is the level?",
        minlength: "Level should be at least 1 character"
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
        url: "ajax/course-new-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-create-course")
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
              $("#btn-create-course")
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
              $("#btn-create-course")
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
