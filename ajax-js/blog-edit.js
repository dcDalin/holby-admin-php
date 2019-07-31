$("document").ready(function() {
  $("#edit-blog-form").validate({
    rules: {
      blogTitle: {
        required: true,
        minlength: 50,
      },
      blogBody: {
        required: true,
        minlength: 200,
      }
    },
    messages: {
      blogTitle: {
        required: 'What is the blog title?',
        minlength: 'Blog title should be at least 50 characters',
      },
      blogBody: {
        required: 'Blog body is required',
        minlength: 'Contents of the blog should be at least 200 characters long'
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
        url: "ajax/blog-edit-ajax.php",
        type: "POST",
        data: $("#edit-blog-form").serialize(),
        dataType: "json"
      })
      .done(function(data) {
        $("#blogBodyWrapper").slideUp('fast');
        $('#btn-create-blog').html('<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...').prop('disabled', true);
        $('#btn-delete-blog').prop('disabled', true);
        $('input, textarea').prop('disabled', true);

        setTimeout(function() {
          if (data.status === "success") {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-success">' + data.message + "</div>"
                );
                $("#edit-blog-form").trigger("reset");
                $(
                  "input, textarea"
                ).prop("disabled", false);
                $("#blogBodyWrapper").slideDown('fast');
              })
              .delay(3000)
              .slideUp("fast");
            $('#btn-create-blog').html('Edit Blog').prop('disabled', false);
            $('#btn-delete-blog').prop('disabled', false);
            setTimeout(function() {
              location.reload(true);
            }, 3000);

          } else {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-error">' + data.message + "</div>"
                );
                $(
                  "input, textarea"
                ).prop("disabled", false);

              })
              .delay(3000)
              .slideUp("fast");
            $('#btn-create-blog').html('Edit Blog').prop('disabled', false);
            $('#btn-delete-blog').prop('disabled', false);
            $("#blogBodyWrapper").slideDown('fast');
          }
        }, 3000);
      })
      .fail(function() {
        $("#edit-blog-form").trigger("reset");
        alert("An unknown error occoured, Please try again Later...");
      });
  }
});