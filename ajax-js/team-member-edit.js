$("document").ready(function(e) {
  $("#new-team-member-form").validate({
    rules: {
      name: {
        required: true,
        minlength: 5,
        maxlength: 15
      },
      isPartner: {
        required: true
      },
      isTrainer: {
        required: true
      },
      isConsultant: {
        required: true
      },
      bio: {
        required: true,
        minlength: 15,
        maxlength: 200
      }
    },
    messages: {
      name: {
        required: "What is the name of the team member?",
        minlength: "Name should be at least 5 characters",
        maxlength: "Maximum length is 15 characters"
      },
      isPartner: {
        required: "This field is required"
      },
      isTrainer: {
        required: "This field is required"
      },
      isConsultant: {
        required: "This field is required"
      },
      bio: {
        required: "Bio is required",
        minlength: "Should be at least 15 characters",
        maxlength: "Maximum length is 50 characters"
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
        url: "ajax/teammember-edit.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-create-team-member")
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
                  $("#new-team-member-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-create-team-member")
                .html("Add Partner Item")
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
              $("#btn-create-team-member")
                .html("Add Slider Item")
                .prop("disabled", false);
            }
          }, 3000);
        })
        .fail(function() {
          $("#new-team-member-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
