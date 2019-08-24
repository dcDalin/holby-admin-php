$("document").ready(function() {
  $("#new-blog-form").validate({
    rules: {
      blogBody: {
        required: true,
        minlength: 200
      }
    },
    messages: {
      blogBody: {
        required: "Blog body is required",
        minlength: "Contents of the blog should be at least 200 characters long"
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
      url: "ajax/about-text-ajax.php",
      type: "POST",
      data: $("#new-blog-form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("#blogBodyWrapper").slideUp("fast");
        $("#btn-create-blog")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
          )
          .prop("disabled", true);
        $("#btn-delete-blog").prop("disabled", true);
        $("input, textarea").prop("disabled", true);
      }
    })
      .done(function(data) {
        $("#blogBodyWrapper").slideUp("fast");
        $("#btn-create-blog")
          .html(
            '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
          )
          .prop("disabled", true);
        $("#btn-delete-blog").prop("disabled", true);
        $("input, textarea").prop("disabled", true);

        setTimeout(function() {
          if (data.status === "success") {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-success">' + data.message + "</div>"
                );
                $("#new-blog-form").trigger("reset");
                $("input, textarea").prop("disabled", false);
                $("#blogBodyWrapper").slideDown("fast");
              })
              .delay(3000)
              .slideUp("fast");
            $("#btn-create-blog")
              .html("Update")
              .prop("disabled", false);
            $("#btn-delete-blog").prop("disabled", false);
            setTimeout(function() {
              location.reload(true);
            }, 3000);
          } else {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("#errorDiv").html(
                  '<div class="alert alert-error">' + data.message + "</div>"
                );
                $("input, textarea").prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
            $("#btn-create-blog")
              .html("Update")
              .prop("disabled", false);
            $("#btn-delete-blog").prop("disabled", false);
            $("#blogBodyWrapper").slideDown("fast");
          }
        }, 3000);
      })
      .fail(function() {
        $("#new-blog-form").trigger("reset");
        alert("An unknown error occured, Please try again Later...");
      });
  }
});
