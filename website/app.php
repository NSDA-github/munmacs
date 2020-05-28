<?php
include __DIR__ . "/api/Countries.php";
include __DIR__ . "/api/Validator.php";

class Website
{
  public static function show($page)
  {
?>
    <html>

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <link rel="stylesheet" href="/css/bootstrap.min.css" />
      <script src="/dist/js/jquery-3.4.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="/style.css" />
      <link rel="stylesheet" href="/css/navbar.css" />
      <link rel="stylesheet" href="/css/website.css" />
      <script src="/js/general.js"></script>
      <script src="/js/navbar.js"></script>
      <link rel="shortcut icon" type="image/png" href="/imgs/icon.png" />
      <?php
      switch ($page) {
        case 'Home':
      ?><title>Home | MUN NIS Uralsk</title>
        <?php
          break;
        case 'About':
        ?><title>About | MUN NIS Uralsk</title>
        <?php
          break;
        case 'Register':
        ?>
          <title>MUN deputy registration</title>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
          <script src="https://unpkg.com/xregexp/xregexp-all.js"></script>
          <link href="/dist/css/bootstrap-select.min.css" rel="stylesheet" />
          <script src="/dist/js/bootstrap-select.min.js"></script>
          <script src="/js/website/register.js"></script>
          <meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT">
          <meta http-equiv="Pragma" content="no-cache">
        <?php
          break;
        case "Registration Closed":
        ?>
          <title>MUN deputy registration</title>
        <?php
          break;
        case 'Adminlogin':
        ?><title>Log In | MUN NIS Uralsk</title>
        <?php
          break;
        case 'Adminregister':
        ?><title>Admin Register | MUN NIS Uralsk</title>
        <?php
          break;
        case 'PrivacyPolicy':
        ?><title>Privacy Policy | MUN NIS Uralsk</title>
      <?php
          break;
        default:
          break;
      }
      ?>
    </head>

    <body>
      <?php

      switch ($page) {
        case 'Home':
          include_once __DIR__ . "/templates/navbar.php";
          include_once __DIR__ . "/pages/home.php";
          include_once __DIR__ . "/templates/footer.php";
          break;
        case 'About':
          include_once __DIR__ . "/templates/navbar.php";
          include_once __DIR__ . "/pages/about.php";
          include_once __DIR__ . "/templates/footer.php";
          break;
        case 'Register':
          include_once __DIR__ . "/templates/navbar.php";
          include_once __DIR__ . "/pages/register.php";
          include_once __DIR__ . "/templates/footer.php";
          break;
        case 'Registration Closed':
          include_once __DIR__ . "/templates/navbar.php";
          include_once __DIR__ . "/pages/registration-closed.php";
          include_once __DIR__ . "/templates/footer.php";
          break;
        case 'Adminlogin':
          include_once __DIR__ . "/pages/adminlogin.php";
          break;
        case 'Adminregister':
          include_once __DIR__ . "/pages/adminregister.php";
          break;
        case 'PrivacyPolicy':
          include_once __DIR__ . "/templates/navbar.php";
          include_once __DIR__ . "/pages/privacypolicy.php";
          include_once __DIR__ . "/templates/footer.php";
        default:
          break;
      }

      ?>
    </body>

    </html>
<?php
  }
}

class AuthPages
{
  public static function show($page)
  {
    switch ($page) {
      case 'login':
        include_once __DIR__ . "/pages/adminlogin.php";
        break;
      case 'register':
        include_once __DIR__ . "/pages/adminregister.php";
        break;

      default:
        # code...
        break;
    }
  }
}
?>