$("#btn-delete-event").click(function() {
  swal({
    title: "Are you sure?",
    text: "Event will be deleted",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete Event",
    showLoaderOnConfirm: true,

    preConfirm: function() {
      return new Promise(function(resolve) {
        $.ajax({
          url: "ajax/event-delete-ajax.php",
          type: "POST",
          dataType: "json"
        })
          .done(function(data) {
            $("#btn-delete-event")
              .html(
                '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Processing...'
              )
              .prop("disabled", true);
            $("#btn-create-event").prop("disabled", true);
            $("input, textarea, select").prop("disabled", true);
            setTimeout(function() {
              if (data.status === "success") {
                $("#btn-delete-event").html(
                  '<img src="ajax-loader.gif" style="margin: auto; width:10%;"> &nbsp; Deleting...'
                );
                setTimeout(' window.location.href = "event-view"; ', 3000);
              } else {
                $("#btn-delete-event").html(
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
