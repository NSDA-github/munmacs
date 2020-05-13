$(document).ready(function () {
  const pathname = window.location.pathname;
  if (pathname === "/adminpanel/registrants") dir = "registrants-link";
  else if (pathname === "/adminpanel/approved") dir = "approved-link";
  else if (pathname === "/adminpanel/data") dir = "data-link";
  else if (pathname === "/adminpanel/settings") dir = "settings-link";
  else if (pathname === "/adminpanel/approval") dir = "approval-link";
  if (typeof dir != "undefined") {
    $("#" + dir).addClass("active");
    console.log(dir);
  }
  $("#navbar").hide();
  $("body").show();
  $("#brand").height(
    $("#navbar").height() - parseInt($("#brand").css("padding-top")) * 2
  );
  $("#brand").width(
    $("#navbar").height() - parseInt($("#brand").css("padding-top")) * 2
  );
  $("#navbar").show();
});
