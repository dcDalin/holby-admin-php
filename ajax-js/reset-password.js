// valid email pattern
var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$.validator.addMethod("validemail", function(value, element) {
  return this.optional(element) || eregex.test(value);
});

$("document").ready(function() {
  /* validation */
  $("#reset-password-form").validate({
    rules: {
      password: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      email: {
        required: true,
        validemail: true
      }
    },
    messages: {
      password: {
        required: "Please enter your password.",
        minlength: "Password should be at least 6 characters",
        maxlength: "Password should be less than 15"
      },
      email: {
        required: "Please enter your email address.",
        validemail: "Please enter a valid email address."
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
  /* validation */

  /* reset password submit */
  function submitForm() {
    $.ajax({
      url: "ajax/reset-password-ajax.php",
      type: "POST",
      data: $("#reset-password-form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("#btn-reset-pass")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:30%;"> &nbsp; Connecting...'
          )
          .prop("disabled", true);
        $("input[type=email],input[type=password],input[type=checkbox]").prop(
          "disabled",
          true
        );
        $("#back-to-login").slideUp("fast");
        $("#remember-me").slideUp("fast");
      }
    })
      .done(function(data) {
        $("#btn-reset-pass")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:30%;"> &nbsp; Sending...'
          )
          .prop("disabled", true);

        setTimeout(function() {
          if (data.status === "success") {
            $("#btn-reset-pass").html(
              '<img src="ajax-loader.gif" style="margin: auto; width:30%;"> &nbsp; Redirecting...'
            );
            $("#errorDiv")
              .slideDown("fast", function() {
                swal("Success!", data.message, "success");
                $("#reset-password-form").trigger("reset");
                $(
                  "input[type=email],input[type=password],input[type=checkbox]"
                ).prop("disabled", false);
                $("#btn-reset-pass")
                  .html("Reset Password")
                  .prop("disabled", false);
              })
              .delay(4000)
              .slideUp("fast");

            setTimeout(' window.location.href = "index"; ', 4000);
          } else if (data.status === "error") {
            $("#errorDiv")
              .slideDown("fast", function() {
                swal("Error!", data.message, "error");
                $("#reset-password-form").trigger("reset");
                $(
                  "input[type=email],input[type=password],input[type=checkbox]"
                ).prop("disabled", false);
                $("#btn-reset-pass")
                  .html("Reset Password")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
            $("#back-to-login").slideDown("fast");
            $("#remember-me").slideDown("fast");
          } else if (data.status === "unknown") {
            $("#errorDiv")
              .slideDown("fast", function() {
                swal("Error!", data.message, "error");
                $("#reset-password-form").trigger("reset");
                $(
                  "input[type=email],input[type=password],input[type=checkbox]"
                ).prop("disabled", false);
                $("#btn-reset-pass")
                  .html("Reset Password")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
            $("#back-to-login").slideDown("fast");
            $("#remember-me").slideDown("fast");
          }
        }, 3000);
      })
      .fail(function(err) {
        $("#reset-password-form").trigger("reset");
        console.log(JSON.stringify(err));
        alert(err);
      });
  }
  /* reset password submit */
});
