$("document").ready(function(e) {
  $.validator.addMethod("lessThan", function(value, element, param) {
    var i = parseFloat(value);
    var j = parseFloat(param);
    return i < j ? true : false;
  });
  $("#edit-course-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 5
      },
      months: {
        required: true,
        lessThan: 12
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
        url: "ajax/course-edit-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-edit-course")
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
                  $("#edit-course-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-edit-course")
                .html("Edit Course")
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
              $("#btn-edit-course")
                .html("Edit Course")
                .prop("disabled", false);
            }
          }, 3000);
        })
        .fail(function() {
          $("#edit-course-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
