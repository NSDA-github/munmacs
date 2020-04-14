$(document).ready(function () {
  const pathname = window.location.pathname;
  if (pathname === "/home") dir = "home";
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
});
