$("document").ready(function() {
  $("#admin-level-form").validate({
    rules: {
      adminLevel: {
        required: true
      }
    },
    messages: {
      adminLevel: {
        required: "Select a Role"
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
      url: "ajax/admins-roles-ajax.php",
      type: "POST",
      data: $("#admin-level-form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("#action-buttons").slideUp("fast");
        $("select").prop("disabled", true);
        $("#loader-here").html(
          '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Sending Email...'
        );
      }
    })
      .done(function(data) {
        $("#action-buttons").slideUp("fast");
        $("select").prop("disabled", true);
        $("#loader-here").html(
          '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
        );

        setTimeout(function() {
          if (data.status === "success") {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-success">' + data.message + "</div>"
                );
                $("#admin-level-form").trigger("reset");
                $("select").prop("disabled", false);
                $("#loader-here")
                  .html("")
                  .prop("disabled", false);
                $("#action-buttons").slideDown("fast");
              })
              .delay(3000)
              .slideUp("fast");
            setTimeout(function() {
              location.reload(true);
            }, 3000);
          } else {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-warning">' + data.message + "</div>"
                );
                $("#admin-level-form").trigger("reset");
                $("select").prop("disabled", false);
                $("#loader-here")
                  .html("")
                  .prop("disabled", false);
                $("#action-buttons").slideDown("fast");
              })
              .delay(3000)
              .slideUp("fast");
          }
        }, 3000);
      })
      .fail(function() {
        $("#admin-level-form").trigger("reset");
        alert("An unknown error occured. Please contact the support team.");
      });
  }
});
