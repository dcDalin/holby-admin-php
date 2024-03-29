$("document").ready(function() {
  $("#new-blog-form").validate({
    rules: {
      thumbnail: {
        required: true
      },
      blogTitle: {
        required: true,
        minlength: 50
      },
      blogBody: {
        required: true,
        minlength: 200
      }
    },
    messages: {
      thumbnail: {
        required: "Thumbnail is required"
      },
      blogTitle: {
        required: "What is the blog title?",
        minlength: "Blog title should be at least 50 characters"
      },
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
    submitHandler: function(form) {
      var formData = new FormData(form);
      $.ajax({
        url: "ajax/blog-new-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#blogBodyWrapper").slideUp("fast");
          $("#btn-create-blog")
            .html(
              '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
            )
            .prop("disabled", true);
          $("input, textarea").prop("disabled", true);

          setTimeout(function() {
            if (data.status === "success") {
              $("#errorDiv")
                .slideDown("fast", function() {
                  $("#errorDiv").html(
                    '<div class="alert alert-success">' +
                      data.message +
                      "</div>"
                  );
                  $("#new-blog-form").trigger("reset");
                  $("input, textarea").prop("disabled", false);
                  $("#blogBodyWrapper").slideDown("fast");
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-create-blog")
                .html("Post Blog")
                .prop("disabled", false);
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
                .html("Post Blog")
                .prop("disabled", false);
              $("#blogBodyWrapper").slideDown("fast");
            }
          }, 3000);
        })
        .fail(function(err) {
          console.log(JSON.stringify(err));
          $("#new-blog-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
