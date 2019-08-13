$("document").ready(function(e) {
  $("#edit-course-form").validate({
    rules: {
      title: {
        required: true,
        minlength: 5
      },
      duration: {
        required: true,
        minlength: 1
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
      duration: {
        required: "What is the duration?",
        minlength: "Duration should be at least 1 character"
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
