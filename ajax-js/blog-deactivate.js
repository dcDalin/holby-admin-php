$("#btn-deactivate-blog").click(function() {
  swal({
    title: "Are you sure?",
    text: "Blog will be deactivated",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Deactivate Blog",
    showLoaderOnConfirm: true,

    preConfirm: function() {
      return new Promise(function(resolve) {
        $.ajax({
          url: "ajax/blog-deactivate-ajax.php",
          type: "POST",
          dataType: "json"
        })
          .done(function(data) {
            $("#blogBodyWrapper").slideUp("fast");
            $("#btn-deactivate-blog")
              .html(
                '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
              )
              .prop("disabled", true);
            $("#btn-create-blog").prop("disabled", true);
            $("input, textarea").prop("disabled", true);
            setTimeout(function() {
              if (data.status === "success") {
                $("#btn-deactivate-blog").html(
                  '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Deactivating...'
                );
                setTimeout(' window.location.href = "blog-new"; ', 3000);
              } else {
                $("#btn-deactivate-blog").html(
                  '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Failed...'
                );
                setTimeout(function() {
                  location.reload(true);
                }, 3000);
              }
            }, 3000);
          })
          .fail(function() {
            swal("Oops...", "Something went wrong with ajax !", "error");
          });
      });
    },
    allowOutsideClick: false
  });
});
