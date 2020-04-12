$(document).ready(function () {
  $("head").append('<link rel="stylesheet" href="/css/navbar.css" />');
  $.get("/fragments/navbar.html", function (data) {
    $("body").children(":first").before(data);
    const pathname = window.location.pathname;
    if (pathname === "/") dir = "home";
    else if (pathname === "/about") dir = "about";
    else if (pathname === "/register") dir = "register";
    $("#" + dir).addClass("active");
    console.log(dir);
    $(".img-hover").click(function () {
      var el = this;
      $(el).addClass("focus");
      setTimeout(function () {
        $(el).removeClass("focus");
      }, 250);
    });
    $.get("/fragments/footer.html", function (data) {
      $("body").children(":last").after(data);
      $("body").show();
    });
  });
});
