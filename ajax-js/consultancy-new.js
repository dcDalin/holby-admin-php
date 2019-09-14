$("document").ready(function() {
  $("#form").validate({
    rules: {
      consultancyTitle: {
        required: true,
        minlength: 5
      },
      description: {
        required: true,
        minlength: 50
      }
    },
    messages: {
      consultancyTitle: {
        required: "What is the consultancy title?",
        minlength: "Title should be at least 5 characters"
      },
      description: {
        required: "Description is required",
        minlength:
          "Contents of the description should be at least 50 characters long"
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
  /* Create new user submit */
  function submitForm() {
    $.ajax({
      url: "ajax/consultancy-new-ajax.php",
      type: "POST",
      data: $("#form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("#btn-submit")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:30px;"> &nbsp; Working...'
          )
          .prop("disabled", true);
        $(
          "input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender"
        ).prop("disabled", true);
      }
    })
      .done(function(data) {
        $("#btn-submit")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:30px;"> &nbsp; Processing...'
          )
          .prop("disabled", true);
        // $('input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender').prop('disabled', true);

        setTimeout(function() {
          if (data.status === "success") {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#btn-submit").html(
                  '<img src="ajax-loader.gif" style="margin: auto; width:30px;"> &nbsp; Refreshing...'
                );
                $("#errorDiv").html(
                  '<div class="alert alert-success">' + data.message + "</div>"
                );
                $("#form").trigger("reset");
                $(
                  "input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender"
                ).prop("disabled", false);
                $("#btn-submit")
                  .html("Create New Admin")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
            setTimeout(function() {
              location.reload(true);
            }, 3000);
          } else if (data.status === "error") {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-danger">' + data.message + "</div>"
                );
                $("#form").trigger("reset");
                $(
                  "input[type=email],input[type=text],input[type=tel],input[type=number],input[type=password],input[type=checkbox],#gender"
                ).prop("disabled", false);
                $("#btn-submit")
                  .html("Create New Admin")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
          }
        }, 3000);
      })
      .fail(function() {
        $("#form").trigger("reset");
        alert("An unknown error occoured, Please try again Later...");
      });
  }
  /* Create new user */
});
