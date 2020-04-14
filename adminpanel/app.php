<?php
class AdminPanel
{
  public static function show($page)
  {
?>
    <html>

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <link rel="stylesheet" href="/css/bootstrap.css" />
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
      </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
      </script>

      <script src="/js/sidebar.js"></script>
      <script src="/js/general.js"></script>
      <script src="/js/adminpanel/general.js"></script>
      <link rel="stylesheet" href="/style.css" />
      <?php
      echo "<title> $page | Admin Panel</title>";
      switch ($page) {
        case 'Registrants':
          echo '<script src="/js/adminpanel/registrants.js"></script>';
          break;
        case 'Approved':
          echo '<script src="/js/adminpanel/approved.js"></script>';
          break;
        case 'Data Export':
          echo '<script src="/js/adminpanel/data.js"></script>';
          break;
        case 'Settings':
          echo '<script src="/js/adminpanel/settings.js"></script>';
          break;

        default:
          # code...
          break;
      }
      ?>
    </head>

    <body>
      <?php include_once __DIR__ . "/templates/admin-nav.php"; ?>
      <div id="1" class="container-fluid">
        <div id="2" class="row">
          <?php
          include_once __DIR__ . "/templates/sidebar.php";
          switch ($page) {
            case 'Registrants':
              include_once __DIR__ . "/pages/registrants.php";
              break;
            case 'Approved':
              include_once __DIR__ . "/pages/approved.php";
              break;
            case 'Data Export':
              include_once __DIR__ . "/pages/data.php";
              break;
            case 'Settings':
              include_once __DIR__ . "/pages/settings.php";
              break;
            case 'Help':
              include_once __DIR__ . "/pages/help.php";
              break;

            default:
              break;
          } ?>
        </div>
      </div>
    </body>

    </html>
<?php
  }
}
?>