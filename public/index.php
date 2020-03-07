<?php

require_once __DIR__ . "/../Server.php";
header('Content-Type: text/html; charset=utf-8');

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

$klein->respond('GET', '/sysadminpanel', function($request, $response, $service){
    SysAdminPanel::show();
});

$klein->respond('POST', '/api/countries', function($request, $response, $service){
    //if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') die('Invalid request');
    if ($request->action === 'reset'){
        if ($request->password === 'AdminPass300'){
            try {
                $dbcountriesquery = db\db\CountriesQuery::create()->find();
                $dbcountriesquery->delete();
                $countries = Countries::getCountries();
                foreach($countries as $country){
                    $dbcountries = new db\db\Countries();
                    $dbcountries->setCountryName($country)->save();
                }    
                $res["success"] = true;
                $res["msg"] = "Operation completed successfully";
                $response->json($res);
            } catch (\Throwable $th) {
                $response->code(500);
                $res["success"] = false;
                $res["msg"] = $th;
                $response->json($res);
            } 
        }
        else {
            $response->code(400);
            $res["success"] = false;
            $res["msg"] = "Wrong Admin Password";
            $response->json($res);
        }
    } else if ($request->action === 'get' && ($request->available || $request->reserved)){
        try {
            $countries = array();
            $dbcountries = ($request->available === '1') ? 
                db\db\CountriesQuery::create()->filterByReserved(0)->filterByAvailable(1): 
                (($request->reserved === '1') ?
                db\db\CountriesQuery::create()->filterByReserved(1)->filterByAvailable(1):NULL);
            if ($dbcountries==NULL) throw new Exception("Error Processing Request", 1);
            $dbcountries->find();
            foreach($dbcountries as $dbcountry){
                $countrystr = $dbcountry->getCountryName();
                if ($request->reserved === '1') {
                    $reservednum = count(db\db\RegistrantsQuery::create()->filterByCountry($dbcountry->getCountryId())->find()) + count(db\db\RegistrantsQuery::create()->filterByCountryReserved($dbcountry->getCountryId())->find());
                    $countrystr = $countrystr." (".$reservednum." reserved)";
                }
                array_push($countries, [$dbcountry->getCountryId(), $countrystr]);
            }
            $res["success"] = true;
            $res["msg"] = "Operation completed successfully";
            $res["countries"] = $countries;
            $response->json($res);
        } catch (\Throwable $th) {
            $response->code(500);
            $res["success"] = false;
            $res["msg"] = "Internal Server Error";
            $res["exception"] = $th;
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
    $validator = new Validator();
    $validator->validate("name", $request->name)->regex("/^((['`\-\p{L}])+[ ]?)*$/")->len(2,30);
    $validator->validate("surname", $request->surname)->regex("/^((['`\-\p{L}])+[ ]?)*$/")->len(2,30);
    $validator->validate("institution", $request->institution)->regex("/^(([#'`.,№\"\-\p{L}0-9])+[ ]?)*$/")->len(5,40);
    $validator->validate("role", $request->role)->regex("/^[a-z]*$/")->len(5,10);
    $validator->validate("grade", $request->grade)->regex("/^[0-9]*$/")->len(0,2);
    $validator->validate("gradeletter", $request->gradeletter)->regex("/^[\p{Lu}]*$/")->len(0,3);
    $validator->validate("subject", $request->subject)->regex("/^((['`\-.,\p{L}])+[ ]?)*$/")->len(0,40);
    $validator->validate("topic", $request->topic)->regex("/^[a-z]*$/")->len(0,20);
    $validator->validate("country", $request->country)->regex("/^[0-9]*$/");
    $validator->validate("reservedcountry", $request->reservedcountry)->regex("/^[0-9]*$/");
    $validator->validate("phone", $request->phone)->regex("/^(([\+][0-9]{11})|([\+][0-9][\-][0-9]{3}[\-][0-9]{3}[\-][0-9]{4})|([\+][0-9][(][0-9]{3}[)][0-9]{3}[\-][0-9]{4})|([\+][0-9][(][0-9]{4}[)][0-9]{3}[\-][0-9]{3}))$/");
    if ($validator->oneResult() == false){
        $response->code(400);
        $res["success"] = false;
        $res["msg"] = "Some data were not accepted by the server";
        $res["validity"] = $validator->invalidList();
        $response->json($res);
    } else {
        try {
            $registrant = new db\db\Registrants();
            $registrantq = new db\db\RegistrantsQuery();  
            $countriesq = new db\db\CountriesQuery();
            $student = new db\db\Students();
            $teacher = new db\db\Teachers();
            $role = new db\db\RegistrantRoles();

            if (!is_null($registrantq->filterByCountry($request->country)->findOne())){
                $validator->setInvalid("country");
                $response->code(400);
                $res["success"] = false;
                $res["msg"] = "Selected Country No Longer Available";
                $res["validity"] = $validator->invalidList();
                $response->json($res);
            } else {
                $registrant->setName($request->name);
                $registrant->setSurname($request->surname);
                $registrant->setEmail($request->email);
                $registrant->setInstitution($request->institution);
                $registrant->setCountry($request->country);
                $countriesq->findPk($request->country)->setReserved(1)->save();
                if($request->reservedcountry != ""){
                    $country = $countriesq->findPk($request->reservedcountry);
                    if ($country->getAvailable() == "1")
                        $registrant->setCountryReserved($request->reservedcountry);
                    $countriesq->findPk($request->reservedcountry)->setReserved(1)->save();
                }
                $registrant->setTel($request->phone);
                $registrant->save();
        
                if($request->role === "student"){
                    $role->setRoleId(2);
                    $role->setRegistrantId($registrant->getRegistrantId());
                    $role->save();
                    $student->setRegistrantId($registrant->getRegistrantId());
                    $student->setGrade($request->grade);
                    $student->setGradeletter($request->gradeletter);
                    $student->save();
                } else if ($request->role === "teacher"){
                    $role->setRoleId(1);
                    $role->setRegistrantId($registrant->getRegistrantId());
                    $role->save();
                    $teacher->setRegistrantId($registrant->getRegistrantId());
                    $teacher->setSubject($request->subject);
                    $teacher->save();
                }
                $response->code(200);
                $res["success"] = true;
                $res["msg"] = "Success";
                $response->json($res);
        }
        } catch (\Throwable $th) {
            $response->code(500);
            $res["success"] = false;
            $res["msg"] = "Internal Server Error";
            $res["exception"] = $th;
            $response->json($res);
        }
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
                'Oh no, a bad error happened that caused a '. $code
            );
    }
});



$klein->dispatch();
