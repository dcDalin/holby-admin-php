$("document").ready(function() {
  $("#form").validate({
    rules: {
      categoryName: {
        required: true
      }
    },
    messages: {
      categoryName: {
        required: "Select a Category name"
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
      url: "ajax/sub-category-view-ajax.php",
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
        consle.log(data.responseText);
        setTimeout(function() {
          // $("something-here").append(data.subCategoryName);
        }, 3000);
      })
      .fail(function(err) {
        $("#form").trigger("reset");
        console.log(err);
        alert("An unknown error occoured, Please try again Later...");
      });
  }
  /* Create new user */
});
