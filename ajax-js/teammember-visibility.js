$("document").ready(function(e) {
  $("#new-team-member-form").validate({
    rules: {
      meetTheTeam: {
        required: true
      },
      partner: {
        required: true
      },
      trainer: {
        required: true
      },
      consultant: {
        required: true
      }
    },
    messages: {
      meetTheTeam: {
        required: "This field is required"
      },
      partner: {
        required: "This field is required"
      },
      trainer: {
        required: "This field is required"
      },
      consultant: {
        required: "This field is required"
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
    submitHandler: submitForm
  });

  function submitForm() {
    $.ajax({
      url: "ajax/team-member-visibility.php",
      type: "POST",
      data: $("#new-team-member-form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("#btn-create-team-member")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
          )
          .prop("disabled", true);
        $("input, textarea, select").prop("disabled", true);
      }
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
                  '<div class="alert alert-success">' + data.message + "</div>"
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
