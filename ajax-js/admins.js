var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$.validator.addMethod(
  "validemail",
  function (value, element) {
    return (
      this.optional(element) ||
      eregex.test(value)
    );
  }
);

// name validation
var nameregex = /^[a-zA-Z_']+$/;

$.validator.addMethod(
  "validname",
  function (value, element) {
    return (
      this.optional(element) ||
      nameregex.test(value)
    );
  }
);

$("document").ready(function () {
  /* validation */
  $("#new-admin-form").validate({
    rules: {
      firstName: {
        required: true,
        validname: true,
        minlength: 2
      },
      lastName: {
        required: true,
        validname: true,
        minlength: 2
      },
      email: {
        required: true,
        validemail: true,
        remote: {
          url: "ajax/check-exists.php",
          type: "post",
          data: {
            email: function () {
              return $(
                "#email"
              ).val();
            }
          }
        }
      },
      gender: {
        required: true
      },
      phoneNumber: {
        required: true,
        number: true,
        minlength: 10,
        maxlength: 10,
        remote: {
          url: "ajax/check-exists.php",
          type: "post",
          data: {
            phoneNumber: function () {
              return $(
                "#phoneNumber"
              ).val();
            }
          }
        }
      },
      idNumber: {
        required: true,
        number: true,
        minlength: 5,
        maxlength: 15,
        remote: {
          url: "ajax/check-exists.php",
          type: "post",
          data: {
            idNumber: function () {
              return $(
                "#idNumber"
              ).val();
            }
          }
        }
      }
    },
    messages: {
      firstName: {
        required: "Please enter your First Name.",
        validname: "Your First Name is invalid",
        minlength: "First Name should be at least 2 letters"
      },
      lastName: {
        required: "Please enter your Last Name.",
        validname: "Your Last Name is invalid",
        minlength: "Last Name should be at least 2 letters"
      },
      email: {
        required: "Please enter your email address.",
        validemail: "Please enter a valid email address.",
        remote: "Email exists, try another one"
      },
      gender: {
        required: "Please select a gender"
      },
      phoneNumber: {
        required: "Phone Number is required",
        number: "Phone number is invalid",
        minlength: "Number seems short",
        maxlength: "Number seems long",
        remote: "Phone number already exists, try another one"
      },
      idNumber: {
        required: "ID Number is required",
        number: "ID Number is invalid",
        minlength: "ID Number is short",
        maxlength: "ID Number is too long",
        remote: "ID Number exists, try another one"
      }
    },
    errorPlacement: function (
      error,
      element
    ) {
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html(error.html());
    },
    highlight: function (element) {
      $(element)
        .closest(".form-group")
        .removeClass(
          "has-success"
        )
        .addClass("has-error");
    },
    unhighlight: function (
      element,
      errorClass,
      validClass
    ) {
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

  /* Create new user submit */
  function submitForm() {
    $.ajax({
        url: "ajax/admins-ajax.php",
        type: "POST",
        data: $(
          "#new-admin-form"
        ).serialize(),
        dataType: "json",
        beforeSend: function () {
          $("#btn-create-admin")
            .html(
              '<img src="ajax-loader.gif" style="margin: auto; width:30px;"> &nbsp; Working...'
            )
            .prop("disabled", true);
          $(
            "input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender"
          ).prop("disabled", true);
        }
      })
      .done(function (data) {
        $("#btn-create-admin")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:30px;"> &nbsp; Processing...'
          )
          .prop("disabled", true);
        // $('input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender').prop('disabled', true);

        setTimeout(function () {
          if (
            data.status ===
            "success"
          ) {
            $("#errorDiv")
              .slideDown(
                "fast",
                function () {
                  $(
                    "#btn-create-admin"
                  ).html(
                    '<img src="ajax-loader.gif" style="margin: auto; width:30px;"> &nbsp; Refreshing...'
                  );
                  $(
                    "#errorDiv"
                  ).html(
                    '<div class="alert alert-success">' +
                    data.message +
                    "</div>"
                  );
                  $(
                    "#new-admin-form"
                  ).trigger(
                    "reset"
                  );
                  $(
                    "input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender"
                  ).prop(
                    "disabled",
                    false
                  );
                  $(
                      "#btn-create-admin"
                    )
                    .html(
                      "Create New Admin"
                    )
                    .prop(
                      "disabled",
                      false
                    );
                }
              )
              .delay(3000)
              .slideUp("fast");
            setTimeout(function () {
              location.reload(true);
            }, 3000);
          } else if (
            data.status ===
            "error"
          ) {
            $("#errorDiv")
              .slideDown(
                "fast",
                function () {
                  $(
                    "#errorDiv"
                  ).html(
                    '<div class="alert alert-danger">' +
                    data.message +
                    "</div>"
                  );
                  $(
                    "#new-admin-form"
                  ).trigger(
                    "reset"
                  );
                  $(
                    "input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender"
                  ).prop(
                    "disabled",
                    false
                  );
                  $(
                      "#btn-create-admin"
                    )
                    .html(
                      "Create New Admin"
                    )
                    .prop(
                      "disabled",
                      false
                    );
                }
              )
              .delay(3000)
              .slideUp("fast");
          }
        }, 3000);
      })
      .fail(function () {
        $(
          "#new-admin-form"
        ).trigger("reset");
        alert(
          "An unknown error occoured, Please try again Later..."
        );
      });
  }
  /* Create new user */

  /* Clicking the sidebar menu, view users */
  $("#view-users").click(
    function () {
      $(
        "#create-new-user"
      ).slideUp();
      $(
        "#view-all-users"
      ).slideDown();
      return false;
    }
  );
});
