$("#btn-delete-course").click(function() {
  swal({
    title: "Are you sure?",
    text: "Course will be deleted",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete Course",
    showLoaderOnConfirm: true,

    preConfirm: function() {
      return new Promise(function(resolve) {
        $.ajax({
          url: "ajax/course-delete-ajax.php",
          type: "POST",
          dataType: "json"
        })
          .done(function(data) {
            $("#btn-delete-course")
              .html(
                '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
              )
              .prop("disabled", true);
            $("#btn-create-course").prop("disabled", true);
            $("input, textarea, select").prop("disabled", true);
            setTimeout(function() {
              if (data.status === "success") {
                $("#btn-delete-course").html(
                  '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Deleting...'
                );
                setTimeout(' window.location.href = "course-view"; ', 3000);
              } else {
                $("#btn-delete-course").html(
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
