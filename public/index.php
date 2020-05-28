<?php

session_start();

use Propel\Runtime\Propel;

require_once __DIR__ . "/../Server.php";
require_once __DIR__ . "/../config.php";
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('UTC');

$klein = new \Klein\Klein();

$klein->respond('GET', '/', function () {
  header("Location: /home");
  exit();
});

$klein->respond('GET', '/[a:action]', function ($request, $response, $service) {
  switch ($request->action) {
    case 'register':
      Website::show("Register");
      break;
    case 'home':
      Website::show("Home");
      break;
    case 'about':
      Website::show("About");
      break;
    case 'adminlogin':
      Website::show("Adminlogin");
      break;
    case 'adminregister':
      Website::show("Adminregister");
      break;
    case 'privacypolicy':
      Website::show("PrivacyPolicy");
      break;
    default:
      # code...
      break;
  }
});

$klein->respond('GET', '/logout', function () {
  $_SESSION = array();

  // Delete all cookies
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }

  session_destroy();
  header("Location: /");
  exit();
});

$klein->respond('GET', '/adminpanel[/]?', function ($request, $response, $service) {
  if (isset($_SESSION["user"])) {
    header("Location: /adminpanel/registrants");
  } else {
    header("Location: /adminlogin");
  }
  exit();
});

$klein->respond('GET', '/adminpanel/[*:action]', function ($request, $response, $service) {
  if (isset($_SESSION["user"])) {
    switch ($request->action) {
      case 'registrants':
        AdminPanel::show("Registrants");
        break;
      case 'approval':
        AdminPanel::show("Registrants Approval");
        break;
      case 'settings':
        AdminPanel::show("Settings");
        break;
      case 'approved':
        AdminPanel::show("Approved");
        break;
      case 'data':
        AdminPanel::show("Data Export");
        break;
      case 'help':
        AdminPanel::show("Help");
        break;
      default:
        return "404 Page not found";
        break;
    }
  } else {
    header("Location: /adminlogin");
    exit();
  }
});

$klein->respond('GET', '/prohibited', function ($request, $response, $service) {
  echo "Access Prohibited!";
});

$klein->respond('POST', '/api/reset/[:action]', function ($request, $response, $service) {
  try {
    switch ($request->action) {
      case 'database':
        if (Server::adminPassCheck($request->password)) {
          if (!!(db\db\RegistrantEventQuery::create()->findOne()) && !!(db\db\TopicCountryQuery::create()->findOne())) {
            $response->code(400);
            $res["success"] = false;
            $res["msg"] = "Countries data is in use!";
            $response->json($res);
            exit();
          } else {
            Server::resetDatabase();
            $res["success"] = true;
            $res["msg"] = "Operation completed successfully";
            $response->json($res);
            exit();
          }
        } else {
          $response->code(400);
          $res["success"] = false;
          $res["msg"] = "Wrong Admin Password like $request->password.";
          $response->json($res);
          exit();
        }
        break;

      default:
        $response->code(404);
        break;
    }
  } catch (\Throwable $th) {
    $response->code(500);
    $res["success"] = false;
    $res["msg"] = "Internal Server Error";
    $res["error"] = (string) $th;
    $response->json($res);
    exit();
  }
});

$klein->respond('POST', '/api/data/[:action]', function ($request, $response, $service) {
  if (isset($_SESSION["user"])) {
    try {
      if (isset($request->action)) {
        if ($request->action == 'prepare') {
          $registrants = Server::registrants($request);
          $registrantsArray = array();
          $registrantsHeaders = array("Surname", "Name", "Institution", "Occupation", "Topic", "Country", "Phone", "Email", "Approved", "Local", "Attended");
          array_push($registrantsArray, $registrantsHeaders);
          $registrantsList = array();
          foreach ($registrants as $registrant) {
            $phone = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
            $phone->createText($registrant["phone"]);
            array_push($registrantsList, $registrant["surname"]);
            array_push($registrantsList, $registrant["name"]);
            array_push($registrantsList, $registrant["institution"]);
            array_push($registrantsList, $registrant["occupation"]);
            array_push($registrantsList, $registrant["topic"]);
            array_push($registrantsList, $registrant["country"]);
            array_push($registrantsList, $phone);
            array_push($registrantsList, $registrant["email"]);
            array_push($registrantsList, ($registrant["approved"] === null ? "" : ($registrant["approved"] ? 'TRUE' : 'FALSE')));
            array_push($registrantsList, ($registrant["local"] === null ? "" : ($registrant["local"] ? 'TRUE' : 'FALSE')));
            array_push($registrantsList, ($registrant["attended"] === null ? "" : ($registrant["attended"] ? 'TRUE' : 'FALSE')));
            array_push($registrantsArray, $registrantsList);
            unset($registrantsList);
            $registrantsList = array();
          }
          $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
          $borders = [
            'borders' => [
              'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
              ],
            ],
          ];
          $bold = [
            'font' => [
              'bold' => true,
            ],
          ];
          $spreadsheet->getActiveSheet()
            ->fromArray(
              $registrantsArray,  // The data to set
              NULL        // Array values with this value will not be set
              //    we want to set these values (default is A1)
            );
          for ($x = 'A';; $x++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
            if ($x == 'K') break;
          }
          $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(false)->setWidth(20);

          $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(1, 1, sizeof($registrantsArray[0]), sizeof($registrantsArray))
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
          $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(1, 1, sizeof($registrantsArray[0]), sizeof($registrantsArray))
            ->applyFromArray($borders);
          $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(1, 1, sizeof($registrantsArray[0]), 1)
            ->applyFromArray($bold);
          $spreadsheet->getActiveSheet()->setAutoFilter(
            $spreadsheet->getActiveSheet()
              ->calculateWorksheetDimension()
          );
          $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(3, 1, 3, sizeof($registrantsArray))
            ->getAlignment()->setWrapText(true);
          $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(1, 1);
          $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
          $writer->save("../data/data.xlsx");
          $response->status(200);
          $res["success"] = true;
          $res["msg"] = "Success";
          $res["link"] = '<a href="/download/data" data-auto-download id="downloadlink" download>Download Link<a>';
          $response->json($res);
          exit();
        }
      }
      $response->status(400);
      $res["success"] = false;
      $res["msg"] = "Bad user request";
      $response->json($res);
      exit();
    } catch (\Throwable $th) {
      $response->status(500);
      $res["success"] = false;
      $res["msg"] = "Internal Server Error";
      $res["error"] = (string) $th;
      $response->json($res);
      exit();
    }
  } else {
    header("Location: /prohibited");
    exit();
  }
});

$klein->respond('POST', '/api/[a:title]', function ($request, $response, $service) {
  try {
    switch ($request->title) {
      case 'topics':
        $res["success"] = true;
        $res["msg"] = "Operation completed successfully";
        $res["topics"] = Server::topics();
        $response->json($res);
        break;

      case 'countries':
        if (isset($request->topic) && isset($request->reserved)) {
          $res["success"] = true;
          $res["msg"] = "Operation completed successfully";
          $res["countries"] = Server::countries($request->topic, $request->reserved);
          $response->json($res);
        } else {
          $response->code(400);
          $res["success"] = false;
          $res["msg"] = "Invalid request";
          $response->json($res);
        }
        break;

      case "register":
        if (!empty($request->param("g-recaptcha-response"))) {
          $validator = Server::validate($request);
          if ($validator->oneResult() == false) {
            $response->code(400);
            $res["success"] = false;
            $res["msg"] = "Some data were not accepted by the server";
            $res["validity"] = $validator->invalidList();
            $response->json($res);
          } else {
            $server = new Server();
            if (!$server->register($request)) {
              $response->code($server->errorCode());
              $res["success"] = false;
              $res["msg"] = $server->error();
              $response->json($res);
            } else {
              $response->code(200);
              $res["success"] = true;
              $res["msg"] = "Success";
              $response->json($res);
            }
          }
        } else {
          $response->code(400);
          $res["success"] = false;
          $res["msg"] = "Verify the request with ReCaptcha";
          $response->json($res);
        }
        break;

      case 'registeradmin':
        if (Server::adminPassCheck($request->adminpassword)) {
          $dbAdmin = new db\db\Admin();
          $dbAdmin->setUsername($request->username)->setAccessLevel($request->level)->setPassword(password_hash($request->password, PASSWORD_DEFAULT))->save();
          return "Registration copmlete! <a href=\"/adminlogin\">Log In</a>";
        }
        break;

      case "registrants":
        if (isset($_SESSION["user"])) {
          if (isset($request->action) && $request->action == 'get') {
            $registrants = Server::registrants($request);
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $res["registrants"] = $registrants;
            $response->json($res);
          } else {
            $response->status(400);
            $res["success"] = false;
            $res["msg"] = "Bad user request";
            $response->json($res);
          }
        } else {
          header("Location: /prohibited");
        }
        break;

      case "editdiscord":
        if (isset($_SESSION["user"])) {
          if (isset($request->discord) && isset($request->id)) {
            Server::editDiscord($request);
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $response->json($res);
          } else {
            $response->status(400);
            $res["success"] = false;
            $res["msg"] = "Bad user request";
            $response->json($res);
          }
        } else {
          header("Location: /prohibited");
        }
        break;

      case "approval":
        if (isset($_SESSION["user"])) {
          if (isset($request->action) && isset($request->id)) {
            Server::approval($request);
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $response->json($res);
          } else {
            $response->status(400);
            $res["success"] = false;
            $res["msg"] = "Bad user request";
            $response->json($res);
          }
        } else {
          header("Location: /prohibited");
        }
        break;

      case "checkin":
        if (isset($_SESSION["user"])) {
          if (isset($request->action) && isset($request->id)) {
            Server::checkin($request);
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $res["registrants"] = date('Y-m-d h:i:s', time());
            $response->json($res);
          } else {
            $response->status(400);
            $res["success"] = false;
            $res["msg"] = "Bad user request";
            $response->json($res);
          }
        } else {
          header("Location: /prohibited");
        }
        break;

      case "login":
        $dbAdminQ = new db\db\AdminQuery();
        $user = $dbAdminQ->findOneByUsername($request->username);
        if (!is_null($user)) {
          $password_hash = $user->getPassword();
          if (password_verify($request->password, $password_hash)) {
            $_SESSION["user"] = $user->getUsername();
            $_SESSION["user_id"] = $user->getPrimaryKey();
            header('Location: /adminpanel');
            exit();
          } else {
            return 'Wrong authentication details. <a href="/adminlogin">Try Again</a>';
          }
        } else {
          return 'Wrong authentication details. <a href="/adminlogin">Try Again</a>';
        }
        break;

      case "logout":

        break;
      default:
        # code...
        break;
    }
    exit();
  } catch (\Throwable $th) {
    $response->status(500);
    $res["success"] = false;
    $res["msg"] = "Internal Server Error";
    $res["error"] = (string) $th;
    $response->json($res);
    exit();
  }
});

$klein->respond('/download/[:action]', function ($request, $response, $service) {
  if (isset($_SESSION["user"])) {
    $response->file("../data/" . $request->action . ".xlsx");
  } else {
    header("Location: /prohibited");
    exit();
  }
});

$klein->onHttpError(function ($code, $router) {
  switch ($code) {
    case 404:
      $router->response()->body(
        'Y U so lost?!'
      );
      break;
    case 405:
      $router->response()->body(
        'You can\'t do that!'
      );
      break;
    default:
      $router->response()->body(
        'Oh no, a bad error happened that caused a ' . $code
      );
  }
});

$klein->dispatch();
