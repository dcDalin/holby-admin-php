$("document").ready(function(e) {
  $("#new-product-form").validate({
    rules: {
      categoryName: {
        required: true
      },
      subCategory: {
        required: true
      },
      productName: {
        required: true,
        minlength: 5,
        maxlength: 10
      },
      shortDescription: {
        required: true,
        minlength: 10
      },
      longDescription: {
        required: true,
        minlength: 30
      },
      price: {
        required: true
      }
    },
    messages: {
      categoryName: {
        required: "Select a Category Name"
      },
      subCategory: {
        required: "Select a Sub Category or create a new one"
      },
      productName: {
        required: "What's the name of the product?",
        minlength: "Name should be at least 5 characters",
        maxlength: "Maximum length is 10 characters"
      },
      shortDescription: {
        required: "What's the short description?",
        minlength: "Description should be at least 10 characters"
      },
      longDescription: {
        required: "What's the long description?",
        minlength: "Description should be at least 30 characters"
      },
      price: {
        required: "What's the price?"
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
        url: "ajax/product-edit-ajax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false
      })
        .done(function(data) {
          $("#btn-submit")
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
                  $("#new-product-form").trigger("reset");
                  $("input, textarea, select").prop("disabled", false);
                })
                .delay(3000)
                .slideUp("fast");
              $("#btn-submit")
                .html("Edit Product")
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
              $("#btn-submit")
                .html("Add Slider Item")
                .prop("disabled", false);
            }
          }, 3000);
        })
        .fail(function(err) {
          console.log(err);
          $("#new-product-form").trigger("reset");
          alert("An unknown error occoured, Please try again Later...");
        });
    }
  });
});
