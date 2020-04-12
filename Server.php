<?php

use Propel\Runtime\Propel;
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/website/app.php';
require_once __DIR__ . '/adminpanel/app.php';
require_once __DIR__ . '/generated-conf/config.php';

class Server{
    protected $error;
    protected $errorCode;

    public function error(){
        return $this->error;
    }

    public function errorCode(){
        return $this->errorCode;
    }

    public static function adminPassCheck($pass){
        if ($pass == "AdminPass3000"){
            return true;
        } else {
            return false;
        }
    }

    public static function resetDatabase(){
        $con = Propel::getWriteConnection(db\db\Map\CountryTableMap::DATABASE_NAME);
        $sql = '
        SET FOREIGN_KEY_CHECKS=0;
        TRUNCATE TABLE topic_country;
        TRUNCATE TABLE registrant_event;
        TRUNCATE TABLE country;
        TRUNCATE TABLE registrant_teacher;
        TRUNCATE TABLE registrant_student;
        TRUNCATE TABLE registrant_school_student;
        TRUNCATE TABLE registrant_occupation;
        TRUNCATE TABLE registrant;
        SET FOREIGN_KEY_CHECKS=1;';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $con = null;
        $stmt = null;
        $countries = Countries::getCountries();
        foreach($countries as $country){
            $dbcountries = new db\db\Country();
            $dbcountries->setCountryName($country)->save();
        } 
        $countries = db\db\CountryQuery::create()->find();
        $topics = db\db\TopicQuery::create()->find();
        foreach($countries as $country){
            $id = $country->getCountryId();
            foreach($topics as $topic){
                $topicid = $topic->getTopicId();
                $dbtopiccountry = new db\db\TopicCountry();
                $dbtopiccountry->setCountryId($id)->setTopicId($topicid)->save();
            }
            
        }
    }

    public static function topics()
    {
        $topics = array();
        $dbtopics = db\db\TopicQuery::create();
        $dbtopics->find();
        foreach($dbtopics as $dbtopic){
            array_push($topics, [$dbtopic->getTopicId(), $dbtopic->getTopicName()]);
        }
        return $topics;
    }

    public static function countries($topic)
    {
        $countries = array();
        $dbcountries = db\db\CountryQuery::create();
        $dbtopiccountries = db\db\TopicCountryQuery::create()->find();
        $con = Propel::getWriteConnection(db\db\Map\TopicCountryTableMap::DATABASE_NAME);
        $sql = "SELECT topic_country.country_id, (SELECT country_name FROM country WHERE country_id = topic_country.country_id) FROM topic_country WHERE topic_id = ? AND available=1;";
        $stmt = $con->prepare($sql);
        $stmt->execute(array($topic));
        $dbtopiccountries = $stmt->fetchAll();
        foreach($dbtopiccountries as $dbtopiccountry){
            array_push($countries, [$dbtopiccountry[0], $dbtopiccountry[1]]);
        }
        return $countries;
    }

    public static function validate($request){
        $validator = new Validator();
        $validator->validate("name", $request->name)->regex("/^((['`\-\p{L}])+[ ]?)*$/")->len(2,50);
        $validator->validate("surname", $request->surname)->regex("/^((['`\-\p{L}])+[ ]?)*$/")->len(2,50);
        $validator->validate("email", $request->email)->email()->len(5,255);
        $validator->validate("institution", $request->institution)->regex("/^((['`.,№#\"\-\p{L}0-9])+[ ]?)*$/")->len(2,255);
        $validator->validate("role", $request->role)->regex("/^[a-z]*$/")->len(1,15);
        $validator->validate("grade", $request->grade)->regex("/^[0-9]*$/")->len(0,2);
        $validator->validate("gradeletter", $request->gradeletter)->regex("/^[\p{Lu}]*$/")->len(0,1);
        $validator->validate("subject", $request->subject)->regex("/^(([,.'`\"\-\p{L}])+[ ]?)*$/")->len(0,40);
        $validator->validate("major", $request->subject)->regex("/^(([,.'`\"\-\p{L}])+[ ]?)*$/")->len(0,40);
        $validator->validate("topic", $request->topic)->regex("/^[0-9]*$/")->len(1,3);
        $validator->validate("country", $request->country)->regex("/^[0-9]*$/")->len(1,3);
        $validator->validate("phone", $request->phone)->regex("/^([\+][0-9]{11})$/");
        return $validator;
    }

    public function register($request){
        $dbRegistrants = new db\db\Registrant();
        $dbTopicCountryQ = new db\db\TopicCountryQuery();
        $dbRegistrantEvent = new db\db\RegistrantEvent();
        $dbOccupationQ = new db\db\OccupationQuery();
        $dbRegistrantOccupation = new db\db\RegistrantOccupation();
        $dbRegistrantTeacher = new db\db\RegistrantTeacher();
        $dbRegistrantStudent = new db\db\RegistrantStudent();
        $dbRegistrantSchoolStudent = new db\db\RegistrantSchoolStudent();

        $dbRegistrants->setName($request->name);
        $dbRegistrants->setSurname($request->surname);
        $dbRegistrants->setEmail($request->email);
        $dbRegistrants->setPhone($request->phone);
        $dbRegistrants->setInstitution($request->institution);

        $dbTopicCountry = $dbTopicCountryQ->filterByTopicId($request->topic)->filterByCountryId($request->country)->filterByAvailable(1)->findOne();
        if (!!$dbTopicCountry){
            $dbTopicCountry->setAvailable(0);
        }
        else {
            $this->error = "Selected country is no longer availbale";
            $this->errorCode = 400;
            return false;
        }

        $dbRegistrantEvent->setRegistrant($dbRegistrants)->setTopicId($request->topic)->setCountryId($request->country);
        
        $dbOccupation = $dbOccupationQ->filterByOccupationName($request->role)->findOne();
        if ($dbOccupationQ->filterByOccupationName($request->role)->count() == 0){
            throw new Exception("Error Processing Request", 1);
        } else {
            $dbRegistrantOccupation->setRegistrant($dbRegistrants)->setOccupation($dbOccupation);
        }

        if($request->role == "teacher"){
            $dbRegistrantTeacher->setRegistrant($dbRegistrants);
            if ($request->subject)  $dbRegistrantTeacher->setSubject($request->subject);
        } else if ($request->role == "student"){
            $dbRegistrantStudent->setRegistrant($dbRegistrants);
            if ($request->major)  $dbRegistrantStudent->setMajorName($request->major);
        } else if ($request->role == "schoolstudent") {
            $dbRegistrantSchoolStudent->setRegistrant($dbRegistrants);
            if ($request->gradeletter)  $dbRegistrantSchoolStudent->setGradeLetter($request->gradeletter);
            if ($request->grade)  $dbRegistrantSchoolStudent->setGrade($request->grade);
        } else {
            throw new Exception("Error Processing Request", 1);
        }

        $dbRegistrants->save();
        $dbTopicCountry->save();
        $dbRegistrantEvent->save();
        $dbRegistrantOccupation->save();

        if($request->role == "teacher"){
            $dbRegistrantTeacher->save();
        } else if ($request->role == "student"){
            $dbRegistrantStudent->save();
        } else if ($request->role == "schoolstudent") {
            $dbRegistrantSchoolStudent->save();
        }
        return true;
    }

    public static function registrants($request){
        $dbRegistantEventQ = new db\db\RegistrantEventQuery();
        $dbRegistantEventQ->filterByHasAttended(null)->find();
        if (isset($request->orderby)){
            switch ($request->orderby) {
                case 'surname':
                    $dbRegistantEvents = $dbRegistantEventQ->filterByApproved($request->approved)->useRegistrantQuery()->orderBySurname()->endUse()->find();
                    break;
                case 'name':
                    $dbRegistantEvents = $dbRegistantEventQ->filterByApproved($request->approved)->useRegistrantQuery()->orderByName()->endUse()->find();
                    break;
                case 'country':
                    $dbRegistantEvents = $dbRegistantEventQ->filterByApproved($request->approved)->useCountryQuery()->orderByCountryName()->endUse()->find();
                    break;
                case 'time':
                    $dbRegistantEvents = $dbRegistantEventQ->filterByApproved($request->approved)->orderByRegistrationTime()->find();
                    break;
                case 'approvedtime':
                    $dbRegistantEvents = $dbRegistantEventQ->filterByApproved($request->approved)->orderByApprovedTime()->find();
                    break;
                default:
                    throw new Exception("Error Processing Request", 1);
                    break;
            }
        } else {
            $dbRegistantEvents = $dbRegistantEventQ->filterByApproved($request->approved)->useRegistrantQuery()->orderBySurname()->endUse()->find();
        }
        if(isset($request->topic))
            if($request->topic!=0)
                $dbRegistantEvents = $dbRegistantEventQ->filterByTopicId($request->topic)->find();
        if(isset($request->local))
            if($request->local!=-1)
                $dbRegistantEvents = $dbRegistantEventQ->filterByLocal($request->local)->find();
        if(isset($request->search))
            if($request->search!="")
                $dbRegistantEvents = $dbRegistantEventQ->useRegistrantQuery()->where('registrant.surname LIKE ?', $request->search."%")->endUse()->find();
        $registrants=array();
        foreach ($dbRegistantEvents as $dbRegistantEvent) {
            $registrant = array();
            $dbCountry = $dbRegistantEvent->getCountry();
            $dbRegistrant = $dbRegistantEvent->getRegistrant();
            $dbTopic = $dbRegistantEvent->getTopic();
            $registrant['registrant_id']=$dbRegistrant->getPrimaryKey();
            $registrant['time']=$dbRegistantEvent->getRegistrationTime();
            $registrant['local']=$dbRegistantEvent->getLocal();
            $registrant['name']=$dbRegistrant->getName();
            $registrant['surname']=$dbRegistrant->getSurname();
            $registrant['topic']=$dbTopic->getTopicName();
            $registrant['country']=$dbCountry->getCountryName();
            $registrant['institution']=$dbRegistrant->getInstitution();
            $registrant['email']=$dbRegistrant->getEmail();
            $registrant['phone']=$dbRegistrant->getPhone();
            $registrant['role']=$dbRegistrant->getRegistrantOccupation()->getOccupation()->getOccupationName();
            switch ($registrant['role']) {
                case 'schoolstudent':
                    $registrant['grade']=$dbRegistrant->getRegistrantSchoolStudent()->getGrade();
                    $registrant['gradeletter']=$dbRegistrant->getRegistrantSchoolStudent()->getGradeLetter();
                    break;
                case 'student':
                    $registrant['major']=$dbRegistrant->getRegistrantStudent()->getMajorName();
                    break;
                case 'teacher':
                    $registrant['subject']=$dbRegistrant->getRegistrantTeacher()->getSubject();
                    break;
                default:
                    throw new Exception("Roles do not match the occupation in a databse", 1);  
                    break;
            }
            array_push($registrants, $registrant); 
        }
        return $registrants;
    }
}