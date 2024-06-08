(function ($) {
  "use strict";
  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();
  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1500,
      "easeInOutExpo"
    );
    return false;
  });
  // Sidebar Toggler
  $(".sidebar-toggler").click(function () {
    $(".sidebar, .content").toggleClass("open");
    return false;
  });

  // showpass
  $("#showpass").click(function () {
    var x = document.getElementById("Password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  });

  ///////////////////////////

  $(document).ready(function () {
    var table = $("#table_control").DataTable({
      colReorder: true,
      fixedHeader: true,
      processing: true,
      columnDefs: [
        {
          orderable: false,
          searchable: false,
          className: "select-checkbox",
          targets: [0],
        },
        {
          orderable: false,
          searchable: false,
          targets: [11],
        },
      ],
      select: {
        style: "os",
        selector: "td:first-child",
      },
      order: [[1, "asc"]],
      dom: '<"dt-buttons"Bf><"clear">lirtp',
      buttons: [
        {
          extend: "selectAll",
          text: '<i class="fas fa-check"></i>',
          className: "my-2 me-2 rounded btn-success",
        },
        {
          extend: "selectNone",
          text: '<i class="fas fa-times"></i>',
          className: "my-2 me-2 rounded btn-danger",
        },
        {
          text: "Total Cost",
          className: "colvisButton my-2 me-2 rounded btn-secondary",
          action: function () {
            var sumAge = table
              .rows({
                selected: true,
              })
              .data()
              .pluck(10)
              .sum();

            Swal.fire({
              title: "Total Cost : " + (sumAge * 20) / 100,
              showClass: {
                popup: "animate__animated animate__fadeInDown",
              },
              hideClass: {
                popup: "animate__animated animate__fadeOutUp",
              },
            });
          },
        },
        {
          extend: "collection",
          popoverTitle: "Export",
          text: "Export",
          buttons: ["excelHtml5", "pdfHtml5", "print", "copyHtml5", "csvHtml5"],
          className: "ExportButton my-2 rounded ",
          fade: true,
        },
        {
          extend: "colvis",
          popoverTitle: "Visibility control",
          className: "colvisButton my-2 ms-2 rounded",
          fade: true,
        },
      ],
      language: {
        processing:
          '<div class="text-center"><button class="btn btn-main" type="button"><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><label class="px-4 py-2"> Loading...</label></button></div>',
      },
      scrollX: true,
      colResize: {
        isEnabled: true,
        hoverClass: "dt-colresizable-hover",
        hasBoundCheck: true,
        minBoundClass: "dt-colresizable-bound-min",
        maxBoundClass: "dt-colresizable-bound-max",
        saveState: false,
        onResizeStart: function (column, columns) {
          table.colReorder.enable(false);
        },
        onResize: function (column) {
          table.colReorder.enable(false);
        },
        onResizeEnd: function (column, columns) {
          table.colReorder.enable(true);
        },
      },
    });

    /////////////////////////////////////////////////////////////////////////////////////////////
    window.uni_modal = function ($title = "", $url = "", $size = "") {
      $.ajax({
        url: $url,
        error: (err) => {
          console.log();
          alert("An error occured");
        },
        success: function (resp) {
          if (resp) {
            $("#uni_modal .modal-title").html($title);
            $("#uni_modal .modal-body").html(resp);
            if ($size != "") {
              $("#uni_modal .modal-dialog")
                .removeAttr("class")
                .addClass("modal-dialog");
              $("#uni_modal .modal-dialog").addClass(
                $size + "  modal-dialog-centered"
              );
            } else {
              $("#uni_modal .modal-dialog")
                .removeAttr("class")
                .addClass("modal-dialog modal-md modal-dialog-centered");
            }
            $("#uni_modal").modal({
              show: true,
              backdrop: "static",
              keyboard: false,
              focus: true,
            });
            $("#uni_modal").modal("show");
          }
        },
      });
    };
  });
  ///////////////////
  window.alert_toast = function (
    $msg = "Z-TECH",
    $bg = "success",
    $t = "1500"
  ) {
    var Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: $t,
    });
    Toast.fire({
      icon: $bg,
      text: $msg,
    });
  };
  ///////////////////
  window.alert_reload = function (
    $msg = "Z-TECH",
    $bg = "success",
    $t = "1500",
    $ur = ""
  ) {
    let timerInterval;
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: $bg,
      text: $msg,
      timer: $t,
      showConfirmButton: false,
      willClose: () => {
        clearInterval(timerInterval);
      },
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        if ($ur === "") {
          window.location.reload();
        } else {
          window.location.href = $ur;
        }
      }
    });
  };
  ///////////////////

  $(".form-select").select2({
    theme: "bootstrap-5",
    selectionCssClass: "select2--small",
    dropdownCssClass: "select2--small",
  });
})(jQuery);
