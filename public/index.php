<?php
session_start();
use Propel\Runtime\Propel;
require_once __DIR__ . "/../Server.php";
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('UTC');

$klein = new \Klein\Klein();

$klein->respond('GET', '/', function () {
    Home::show();
});

$klein->respond('GET', '/register', function () {
    Register::show();
});

$klein->respond('GET', '/about', function () {
    About::show();
});

$klein->respond('GET', '/adminlogin', function($request, $response, $service){
    AdminLogin::show();
});

$klein->respond('GET', '/logout', function(){
    header("Location: /api/logout");
    exit();
});

$klein->respond('GET', '/adminregister', function($request, $response, $service){
    AdminRegister::show();
});

$klein->respond('GET', '/adminpanel[/]?', function($request, $response, $service){
    if(isset($_SESSION["user"])){
        header("Location: /adminpanel/registrants");
    } else {
        header("Location: /adminlogin");
    }
    exit();
});

$klein->respond('GET', '/adminpanel/[*:action]', function($request, $response, $service){
    if(isset($_SESSION["user"])){
        switch ($request->action) {
            case 'registrants':
                Registrants::show();
                break;
            case 'settings':
                Settings::show();
                break;
            case 'approved':
                Approved::show();
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

$klein->respond('GET', '/prohibited', function($request, $response, $service){
    echo "Access Prohibited!";
});

$klein->respond('GET', '/api/test', function($request, $response, $service){
    try {
        if (isset($request->action))
        if ($request->action == 'get' && isset($request->approved)){
            $registrants = Server::registrants($request);
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $res["registrants"] = $registrants;
            $response->json($res);
            exit();
        }
        $response->status(400);
        $res["success"] = false;
        $res["msg"] = "Bad user request";
        $response->json($res);
        exit();
    } catch (\Throwable $th) {
        $response->status(200);
        $res["success"] = true;
        $res["msg"] = "Internal Server Error";
        $res["error"] = (string)$th;
        $response->json($res);
        exit();
    }
});

$klein->respond('POST', '/api/topics', function($request, $response, $service){
    if ($request->action == 'get'){
        try {
            $res["success"] = true;
            $res["msg"] = "Operation completed successfully";
            $res["topics"] = Server::topics();
            $response->json($res);
        } catch (\Throwable $th) {
            $response->code(500);
            $res["success"] = false;
            $res["msg"] = "Internal Server Error";
            $res["error"] = (string)$th;
            $response->json($res);
        }
    }
});

$klein->respond('POST', '/api/countries', function($request, $response, $service){
    //if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') die('Invalid request');
    if ($request->action == 'reset'){
        if (Server::adminPassCheck($request->password)){
            try {
                if(!!(db\db\RegistrantEventQuery::create()->findOne()) && !!(db\db\TopicCountryQuery::create()->findOne())){
                    $response->code(400);
                    $res["success"] = false;
                    $res["msg"] = "Countries data is in use!";
                    $response->json($res);
                } else {
                    Server::resetDatabase();
                    $res["success"] = true;
                    $res["msg"] = "Operation completed successfully";
                    $response->json($res);
                }
            } catch (\Throwable $th) {
                $response->code(500);
                $res["success"] = false;
                $res["msg"] = "Internal Server Error";
                $res["error"] = (string)$th;
                $response->json($res);
            }
        }
        else {
            $response->code(400);
            $res["success"] = false;
            $res["msg"] = "Wrong Admin Password";
            $response->json($res);
        }
    } else if ($request->action == 'get' && !!($request->topic)){
        try {
            $res["success"] = true;
            $res["msg"] = "Operation completed successfully";
            $res["countries"] = Server::countries($request->topic);
            $response->json($res);
        } catch (\Throwable $th) {
            $response->code(500);
            $res["success"] = false;
            $res["msg"] = "Internal Server Error";
            $res["error"] = (string)$th;
            $response->json($res);
        } 
    }
    else {
        $response->code(400);
        $res["success"] = false;
        $res["msg"] = "Invalid request";
        $response->json($res);
    }
});

$klein->respond('POST', '/api/register', function($request, $response, $service){
    $validator = Server::validate($request);
    if ($validator->oneResult() == false){
        $response->code(400);
        $res["success"] = false;
        $res["msg"] = "Some data were not accepted by the server";
        $res["validity"] = $validator->invalidList();
        $response->json($res);
    } else {
        try {
            $server = new Server();
            if (!$server->register($request)){
                $response->code($server->errorCode());
                $res["success"] = false;
                $res["msg"] = $server->error();
                $response->json($res);
                die;
            }

            $response->code(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $response->json($res);
        } catch (\Throwable $th) {
            $response->code(500);
            $res["success"] = false;
            $res["msg"] = "Internal Server Error";
            $res["error"] = (string)$th;
            $response->json($res);
        }
    }
});

$klein->respond('POST', '/api/register/admin', function($request, $response, $service){
    if(Server::adminPassCheck($request->adminpassword)){
        try {
            $dbAdmin = new db\db\Admin();
            $dbAdmin->setUsername($request->username)->setAccessLevel($request->level)->setPassword(password_hash($request->password,PASSWORD_DEFAULT))->save();
            return "Registration copmlete! <a href=\"/adminlogin\">Log In</a>";
        } catch (\Throwable $th) {
            $response->status(500);
            $res["success"] = false;
            $res["msg"] = "Internal Server Error";
            $res["error"] = (string)$th;
            $response->json($res);
        }
        
    }
});

$klein->respond('POST', '/api/registrants', function($request, $response, $service){
    if(isset($_SESSION["user"]))
    try {
        if (isset($request->action))
        if ($request->action == 'get' && isset($request->approved)){
            $registrants = Server::registrants($request);
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $res["registrants"] = $registrants;
            $response->json($res);
            exit();
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
        $res["error"] = (string)$th;
        $response->json($res);
        exit();
    }
    else {
        header("Location: /prohibited");
        exit();
    }
});

$klein->respond('POST', '/api/approval', function($request, $response, $service){
    if(isset($_SESSION["user"]))
    try {
        if (isset($request->action) && isset($request->id)){
            $dbRegistantEventQ = new db\db\RegistrantEventQuery();
            $dbRegistantEvent = $dbRegistantEventQ->findPK($request->id);
            switch ($request->action) {
                case 'local':
                    $dbRegistantEvent->setLocal(true)->setApproved(true)->setApprovedTime(date('Y-m-d h:i:s', time()))->save();
                    break;
                case 'foreign':
                    $dbRegistantEvent->setLocal(false)->setApproved(true)->setApprovedTime(date('Y-m-d h:i:s', time()))->save();
                    break;
                case 'deny':
                    $dbTopicCountryQ = new db\db\TopicCountryQuery();
                    $dbRegistant = $dbRegistantEvent->getRegistrant();
                    $dbRegistantOccupation = $dbRegistant->getRegistrantOccupation();
                    switch ($dbRegistantOccupation->getOccupation()->getOccupationName()) {
                        case 'teacher':
                            $dbRegistant->getRegistrantTeacher()->delete();
                            break;
                        case 'student':
                            $dbRegistant->getRegistrantStudent()->delete();
                            break;
                        case 'schoolstudent':
                            $dbRegistant->getRegistrantSchoolStudent()->delete();
                            break;
                        default:
                            # code...
                            break;
                    }
                    $dbRegistantOccupation->delete();
                    $dbRegistantEvent->delete();
                    $dbRegistant->delete();
                    $dbTopicCountry = $dbTopicCountryQ->filterByTopicId($dbRegistantEvent->getTopicId())->filterByCountryId($dbRegistantEvent->getCountryId())->findOne();
                    $dbTopicCountry->setAvailable(true)->save();
                    break;
                
                default:
                    throw new Exception("Error Processing Request", 1);                  
                    break;
            }
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $response->json($res);
            exit();
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
        $res["error"] = (string)$th;
        $response->json($res);
        exit();
    } else {
        header("Location: /prohibited");
        exit();
    }
});

$klein->respond('POST', '/api/checkin', function($request, $response, $service){
    if(isset($_SESSION["user"]))
    try {
        if (isset($request->action) && isset($request->id)){
            $dbRegistantEventQ = new db\db\RegistrantEventQuery();
            $dbRegistantEvent = $dbRegistantEventQ->findPK($request->id);
            switch ($request->action) {
                case 'absent':
                    $dbRegistantEvent->setHasAttended(false)->save();
                    break;
                case 'attended':
                    $dbRegistantEvent->setHasAttended(true)->save();
                    break;
                default:
                    throw new Exception("Error Processing Request", 1);                  
                    break;
            }
            $response->status(200);
            $res["success"] = true;
            $res["msg"] = "Success";
            $res["registrants"] = date('Y-m-d h:i:s', time());
            $response->json($res);
            exit();
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
        $res["error"] = (string)$th;
        $response->json($res);
        exit();
    } else {
        header("Location: /prohibited");
        exit();
    }
});

$klein->respond('POST', '/api/login', function($request, $response, $service){
    $dbAdminQ = new db\db\AdminQuery();
    $user = $dbAdminQ->findOneByUsername($request->username);
    $password_hash = $user->getPassword();
    if(password_verify($request->password, $password_hash)){
        $_SESSION["user"]=$user->getUsername();
        $_SESSION["user_id"]=$user->getPrimaryKey();
        header('Location: /adminpanel');   
        exit();
    } else {
        return "Your stinky brain does not work";
    }
});

$klein->respond('GET', '/api/logout', function($request, $response, $service){
    $_SESSION = array();

    // Delete all cookies
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header("Location: /");
    die();
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
                'Oh no, a bad error happened that caused a '. $code
            );
    }
});



$klein->dispatch();
