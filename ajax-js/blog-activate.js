$("#btn-activate-blog").click(function() {
  swal({
    title: "Are you sure?",
    text: "Blog will be activated",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Activate Blog",
    showLoaderOnConfirm: true,

    preConfirm: function() {
      return new Promise(function(resolve) {
        $.ajax({
          url: "ajax/blog-activate-ajax.php",
          type: "POST",
          dataType: "json"
        })
          .done(function(data) {
            $("#blogBodyWrapper").slideUp("fast");
            $("#btn-activate-blog")
              .html(
                '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
              )
              .prop("disabled", true);
            $("#btn-create-blog").prop("disabled", true);
            $("input, textarea").prop("disabled", true);
            setTimeout(function() {
              if (data.status === "success") {
                $("#btn-activate-blog").html(
                  '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Activating...'
                );
                setTimeout(' window.location.href = "blog-new"; ', 3000);
              } else {
                $("#btn-activate-blog").html(
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
