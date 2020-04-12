$(document).ready(function () {
  $.get("/fragments/sidebar.html", function (data) {
    $("#2").children("div:first").before(data);
    const pathname = window.location.pathname;
    if (pathname === "/adminpanel/registrants") dir = "registrants-link";
    else if (pathname === "/adminpanel/approved") dir = "approved-link";
    else if (pathname === "/adminpanel/data") dir = "data-link";
    else if (pathname === "/adminpanel/settings") dir = "settings-link";
    $("#" + dir).addClass("active");
    console.log(dir);
    $.get("/fragments/admin-nav.html", function (data) {
      $("body").children(":first").before(data);
      $("#navbar").hide();
      $("body").show();
      $("#brand").height(
        $("#navbar").height() - parseInt($("#brand").css("padding-top")) * 2
      );
      $("#brand").width(
        $("#navbar").height() - parseInt($("#brand").css("padding-top")) * 2
      );
      $("#sidebar").height($("#sidebar").height() - $("#navbar").height());
      $("#sidebar").css("top", $("#navbar").height() + "px");
      $("#navbar").show();
    });
  });
});
