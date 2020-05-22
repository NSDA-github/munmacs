<?php

use Propel\Runtime\Propel;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/website/app.php';
require_once __DIR__ . '/adminpanel/app.php';
require_once __DIR__ . '/generated-conf/config.php';
require_once __DIR__ . '/config.php';

class Server
{
  protected $error;
  protected $errorCode;

  public function error()
  {
    return $this->error;
  }

  public function errorCode()
  {
    return $this->errorCode;
  }

  public static function adminPassCheck($pass)
  {
    if ($pass == config::$adminpass) {
      return true;
    } else {
      return false;
    }
  }

  public static function resetDatabase()
  {
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
    foreach ($countries as $country) {
      $dbcountries = new db\db\Country();
      $dbcountries->setCountryName($country)->save();
    }
    $countries = db\db\CountryQuery::create()->find();
    $topics = db\db\TopicQuery::create()->find();
    foreach ($countries as $country) {
      $id = $country->getCountryId();
      foreach ($topics as $topic) {
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
    foreach ($dbtopics as $dbtopic) {
      array_push($topics, [$dbtopic->getTopicId(), $dbtopic->getTopicName()]);
    }
    return $topics;
  }

  public static function countries($topic, $reserved)
  {
    $countries = array();
    $dbcountries = db\db\CountryQuery::create();
    $dbtopiccountries = db\db\TopicCountryQuery::create()->find();
    $con = Propel::getWriteConnection(db\db\Map\TopicCountryTableMap::DATABASE_NAME);
    if ($reserved == 0)
      $sql = "SELECT topic_country.country_id, (SELECT country_name FROM country WHERE country_id = topic_country.country_id) FROM topic_country WHERE topic_id = ? AND available = 1 AND reserved = 0;";
    else
      $sql = "SELECT topic_country.country_id, (SELECT country_name FROM country WHERE country_id = topic_country.country_id), topic_country.reserved FROM topic_country WHERE topic_id = ? AND available = 1 AND reserved > 0 AND reserved < 4;";
    $stmt = $con->prepare($sql);
    $stmt->execute(array($topic));
    $dbtopiccountries = $stmt->fetchAll();
    foreach ($dbtopiccountries as $dbtopiccountry) {
      array_push($countries, [$dbtopiccountry[0], $reserved == 0 ? $dbtopiccountry[1] : $dbtopiccountry[1] . " (" .  pow(0.4, $dbtopiccountry[2]) * 100 . "% chance)"]);
    }
    return $countries;
  }

  public static function validate($request)
  {
    $validator = new Validator();
    $validator->validate("name", $request->name)->regex("/^((['`\-\p{L}])+[ ]?)*$/")->len(2, 50);
    $validator->validate("surname", $request->surname)->regex("/^((['`\-\p{L}])+[ ]?)*$/")->len(2, 50);
    $validator->validate("email", $request->email)->email()->len(5, 255);
    $validator->validate("institution", $request->institution)->regex("/^((['`.,№#\"\-\p{L}0-9])+[ ]?)*$/")->len(2, 255);
    $validator->validate("occupation", $request->occupation)->regex("/^[a-z]*$/")->len(1, 15);
    $validator->validate("grade", $request->grade)->regex("/^[0-9]*$/")->len(0, 2);
    $validator->validate("gradeletter", $request->gradeletter)->regex("/^[\p{Lu}]*$/")->len(0, 1);
    $validator->validate("subject", $request->subject)->regex("/^(([,.'`\"\-\p{L}])+[ ]?)*$/")->len(0, 40);
    $validator->validate("major", $request->subject)->regex("/^(([,.'`\"\-\p{L}])+[ ]?)*$/")->len(0, 40);
    $validator->validate("topic", $request->topic)->regex("/^[0-9]*$/")->len(1, 3);
    $validator->validate("country", $request->country)->regex("/^[0-9]*$/")->len(1, 3);
    $validator->validate("desiredcountry", $request->desiredcountry)->regex("/^[0-9]*$/")->len(0, 3);
    $validator->validate("residence", $request->residence)->regex("/^[0-9]*$/")->len(0, 3);
    $validator->validate("interesttext", $request->interesttext)->len(0, 401);
    $validator->validate("phone", $request->phone)->regex("/^[\+][0-9]{11,13}$|$/");
    $validator->validate("discord", $request->discord)->regex("/^[\s\S]*#[0-9]{4}$|$/");
    return $validator;
  }

  public function register($request)
  {
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
    if ($request->phone != "")
      $dbRegistrants->setPhone($request->phone);
    $dbRegistrants->setInstitution($request->institution);
    if ($request->discord != "")
      $dbRegistrants->setDiscord($request->discord);
    $dbRegistrants->setResidence($request->residence);

    $dbTopicCountry = $dbTopicCountryQ->filterByTopicId($request->topic)->filterByCountryId($request->country)->filterByAvailable(1)->filterByReserved(0)->findOne();
    if (!!$dbTopicCountry) {
      $dbTopicCountry->setReserved(1);
    } else {
      $this->error = "Selected safe country is no longer availbale";
      $this->errorCode = 400;
      return false;
    }
    if ($request->desiredcountry != "") {
      $dbTopicCountryDesired = $dbTopicCountryQ->create()->filterByTopicId($request->topic)->filterByCountryId($request->desiredcountry)->filterByAvailable(1)->findOne();
      if (!!$dbTopicCountryDesired) {
        $dbTopicCountryDesired->setReserved($dbTopicCountryDesired->getReserved() + 1);
      } else {
        $this->error = "Selected desired country is no longer availbale";
        $this->errorCode = 400;
        return false;
      }
      $dbRegistrantEvent->setCountryDesired($request->desiredcountry);
    }

    $dbRegistrantEvent->setRegistrant($dbRegistrants)->setTopicId($request->topic)->setCountryId($request->country)->setInterestText($request->interesttext);

    $dbOccupation = $dbOccupationQ->filterByOccupationName($request->occupation)->findOne();
    if ($dbOccupationQ->filterByOccupationName($request->occupation)->count() == 0) {
      throw new Exception("Error Processing Request", 1);
    } else {
      $dbRegistrantOccupation->setRegistrant($dbRegistrants)->setOccupation($dbOccupation);
    }

    if ($request->occupation == "teacher") {
      $dbRegistrantTeacher->setRegistrant($dbRegistrants);
      if ($request->subject)  $dbRegistrantTeacher->setSubject($request->subject);
    } else if ($request->occupation == "student") {
      $dbRegistrantStudent->setRegistrant($dbRegistrants);
      if ($request->major)  $dbRegistrantStudent->setMajorName($request->major);
    } else if ($request->occupation == "schoolstudent") {
      $dbRegistrantSchoolStudent->setRegistrant($dbRegistrants);
      if ($request->gradeletter)  $dbRegistrantSchoolStudent->setGradeLetter($request->gradeletter);
      if ($request->grade)  $dbRegistrantSchoolStudent->setGrade($request->grade);
    } else {
      throw new Exception("Error Processing Request", 1);
    }

    $dbRegistrants->save();
    $dbTopicCountry->save();
    if ($dbTopicCountryDesired)
      $dbTopicCountryDesired->save();
    $dbRegistrantEvent->save();
    $dbRegistrantOccupation->save();

    if ($request->occupation == "teacher") {
      $dbRegistrantTeacher->save();
    } else if ($request->occupation == "student") {
      $dbRegistrantStudent->save();
    } else if ($request->occupation == "schoolstudent") {
      $dbRegistrantSchoolStudent->save();
    }
    return true;
  }

  public static function registrants($request)
  {
    $dbRegistrantEventQ = new db\db\RegistrantEventQuery();
    $dbTopicCountryQ = new db\db\TopicCountryQuery();

    if (isset($request->nodesired) && $request->nodesired == 1)
      $dbRegistrantEvents = $dbRegistrantEventQ->filterByCountryDesired();
    if (isset($request->topic))
      $dbRegistrantEvents = $dbRegistrantEventQ->filterByTopicId($request->topic)->find();
    if (isset($request->local))
      $dbRegistrantEvents = $dbRegistrantEventQ->filterByLocal($request->local)->find();
    if (isset($request->attended))
      if ($request->attended != -1)
        $dbRegistrantEvents = $dbRegistrantEventQ->filterByHasAttended($request->attended)->find();
      else
        $dbRegistrantEvents = $dbRegistrantEventQ->filterByHasAttended(null)->find();
    if (isset($request->approved))
      $dbRegistrantEvents = $dbRegistrantEventQ->filterByApproved($request->approved)->find();
    if (isset($request->orderby)) {
      switch ($request->orderby) {
        case 'surname':
          $dbRegistrantEvents = $dbRegistrantEventQ->useRegistrantQuery()->orderBySurname()->endUse()->find();
          break;
        case 'name':
          $dbRegistrantEvents = $dbRegistrantEventQ->useRegistrantQuery()->orderByName()->endUse()->find();
          break;
        case 'country':
          $dbRegistrantEvents = $dbRegistrantEventQ->useCountryRelatedByCountryIdQuery()->orderByCountryName()->endUse()->find();
          break;
        case 'time':
          $dbRegistrantEvents = $dbRegistrantEventQ->orderByRegistrationTime()->find();
          break;
        case 'approvedtime':
          $dbRegistrantEvents = $dbRegistrantEventQ->orderByApprovedTime()->find();
          break;
        default:
          throw new Exception("Error Processing Request", 1);
          break;
      }
    } else {
      $dbRegistrantEvents = $dbRegistrantEventQ->useRegistrantQuery()->orderBySurname()->endUse()->find();
    }
    if (isset($request->search))
      switch ($request->searchmode) {
        case 'surname':
          $dbRegistrantEvents = $dbRegistrantEventQ->useRegistrantQuery()->where('registrant.surname LIKE ?', $request->search . "%")->endUse()->find();
          break;
        case 'discord':
          $dbRegistrantEvents = $dbRegistrantEventQ->useRegistrantQuery()->where('registrant.discord LIKE ?', $request->search . "%")->endUse()->find();
          break;
        default:
          throw new Exception("Error Processing Request: Search by " . $request->searchmode, 1);
          break;
      }
    $registrants = array();
    foreach ($dbRegistrantEvents as $dbRegistrantEvent) {
      $registrant = array();
      $dbCountry = $dbRegistrantEvent->getCountryRelatedByCountryId();
      $dbRegistrant = $dbRegistrantEvent->getRegistrant();
      $dbTopic = $dbRegistrantEvent->getTopic();
      $registrant['registrant_id'] = $dbRegistrant->getPrimaryKey();
      $registrant['time'] = $dbRegistrantEvent->getRegistrationTime();
      $registrant['local'] = $dbRegistrantEvent->getLocal();
      $registrant['approved'] = $dbRegistrantEvent->getApproved();
      $registrant['attended'] = $dbRegistrantEvent->getHasAttended();
      $registrant['name'] = $dbRegistrant->getName();
      $registrant['surname'] = $dbRegistrant->getSurname();
      $registrant['topic'] = $dbTopic->getTopicName();
      $registrant['country'] = $dbCountry->getCountryName();
      $registrant['interesttext'] = $dbRegistrantEvent->getInterestText();
      $registrant['institution'] = $dbRegistrant->getInstitution();
      $registrant['email'] = $dbRegistrant->getEmail();
      $registrant['phone'] = $dbRegistrant->getPhone();
      $registrant['relevancy'] = $dbTopicCountryQ->create()->filterByCountryId($dbRegistrantEvent->getCountryId())->filterByTopicId($dbRegistrantEvent->getTopicId())->findOne()->getReserved();
      $registrant['discord'] = $dbRegistrant->getDiscord();
      $registrant['occupation'] = $dbRegistrant->getRegistrantOccupation()->getOccupation()->getOccupationName();

      switch ($registrant['occupation']) {
        case 'schoolstudent':
          $registrant['grade'] = $dbRegistrant->getRegistrantSchoolStudent()->getGrade();
          $registrant['gradeletter'] = $dbRegistrant->getRegistrantSchoolStudent()->getGradeLetter();
          break;
        case 'student':
          $registrant['major'] = $dbRegistrant->getRegistrantStudent()->getMajorName();
          break;
        case 'teacher':
          $registrant['subject'] = $dbRegistrant->getRegistrantTeacher()->getSubject();
          break;
        default:
          throw new Exception("Roles do not match the occupation in a databse", 1);
          break;
      }
      array_push($registrants, $registrant);
    }
    $registrantsData = array();
    $registrantsInfo = array();
    $dbRegistrantEventQ = new db\db\RegistrantEventQuery();
    $dbTopicQ = new db\db\TopicQuery();
    $topics = $dbTopicQ->create()->find();
    $registrantsInfo['totalnumberbytopic'] = array();
    $registrantsInfo['totalapprovedbytopic'] = array();
    $registrantsInfo['topicid'] = array();
    foreach ($topics as $topic) {
      array_push($registrantsInfo['topicid'], $topic->getTopicId());
      array_push($registrantsInfo['totalnumberbytopic'], $dbRegistrantEventQ->create()->filterByTopicId($topic->getTopicId())->find()->count());
      array_push($registrantsInfo['totalapprovedbytopic'], $dbRegistrantEventQ->create()->filterByTopicId($topic->getTopicId())->filterByApproved(1)->find()->count());
    }
    $registrantsInfo['totalnumber'] = $dbRegistrantEventQ->create()->find()->count();
    $registrantsInfo['totalapproved'] = $dbRegistrantEventQ->filterByApproved(1)->find()->count();
    $registrantsData["info"] = $registrantsInfo;
    $registrantsData["registrants"] = $registrants;
    return $registrantsData;
  }

  public static function approval($request)
  {
    $dbRegistrantEventQ = new db\db\RegistrantEventQuery();
    $dbRegistrantEvent = $dbRegistrantEventQ->findPK($request->id);
    switch ($request->action) {
      case 'local':
        $dbRegistrantEvent->setLocal(true)->setApproved(true)->setApprovedTime(date('Y-m-d h:i:s', time()))->save();
        break;
      case 'foreign':
        $dbRegistrantEvent->setLocal(false)->setApproved(true)->setApprovedTime(date('Y-m-d h:i:s', time()))->save();
        break;
      case 'deny':
        $dbTopicCountryQ = new db\db\TopicCountryQuery();
        $dbRegistant = $dbRegistrantEvent->getRegistrant();
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
        $dbRegistrantEvent->delete();
        $dbRegistant->delete();
        $dbTopicCountry = $dbTopicCountryQ->filterByTopicId($dbRegistrantEvent->getTopicId())->filterByCountryId($dbRegistrantEvent->getCountryId())->findOne();
        $dbTopicCountry->setAvailable(true)->save();
        break;

      default:
        throw new Exception("Error Processing Request", 1);
        break;
    }
  }

  public static function editDiscord($request)
  {
    $dbRegistrantQ = new db\db\RegistrantQuery();
    $dbRegistrant = $dbRegistrantQ->filterByRegistrantId($request->id)->findOne();
    $dbRegistrant->setDiscord($request->discord)->save();
  }

  public static function checkin($request)
  {
    $dbRegistrantEventQ = new db\db\RegistrantEventQuery();
    $dbRegistrantEvent = $dbRegistrantEventQ->findPK($request->id);
    switch ($request->action) {
      case 'absent':
        $dbRegistrantEvent->setHasAttended(false)->save();
        break;
      case 'attended':
        $dbRegistrantEvent->setHasAttended(true)->save();
        break;
      default:
        throw new Exception("Error Processing Request", 1);
        break;
    }
  }
}
