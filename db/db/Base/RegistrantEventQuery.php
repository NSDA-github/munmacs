<?php

namespace db\db\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use db\db\RegistrantEvent as ChildRegistrantEvent;
use db\db\RegistrantEventQuery as ChildRegistrantEventQuery;
use db\db\Map\RegistrantEventTableMap;

/**
 * Base class that represents a query for the 'registrant_event' table.
 *
 *
 *
 * @method     ChildRegistrantEventQuery orderByRegistrantId($order = Criteria::ASC) Order by the registrant_id column
 * @method     ChildRegistrantEventQuery orderByTopicId($order = Criteria::ASC) Order by the topic_id column
 * @method     ChildRegistrantEventQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildRegistrantEventQuery orderByCountryDesired($order = Criteria::ASC) Order by the country_desired column
 * @method     ChildRegistrantEventQuery orderByRegistrationTime($order = Criteria::ASC) Order by the registration_time column
 * @method     ChildRegistrantEventQuery orderByApproved($order = Criteria::ASC) Order by the approved column
 * @method     ChildRegistrantEventQuery orderByApprovedTime($order = Criteria::ASC) Order by the approved_time column
 * @method     ChildRegistrantEventQuery orderByLocal($order = Criteria::ASC) Order by the local column
 * @method     ChildRegistrantEventQuery orderByHasAttended($order = Criteria::ASC) Order by the has_attended column
 *
 * @method     ChildRegistrantEventQuery groupByRegistrantId() Group by the registrant_id column
 * @method     ChildRegistrantEventQuery groupByTopicId() Group by the topic_id column
 * @method     ChildRegistrantEventQuery groupByCountryId() Group by the country_id column
 * @method     ChildRegistrantEventQuery groupByCountryDesired() Group by the country_desired column
 * @method     ChildRegistrantEventQuery groupByRegistrationTime() Group by the registration_time column
 * @method     ChildRegistrantEventQuery groupByApproved() Group by the approved column
 * @method     ChildRegistrantEventQuery groupByApprovedTime() Group by the approved_time column
 * @method     ChildRegistrantEventQuery groupByLocal() Group by the local column
 * @method     ChildRegistrantEventQuery groupByHasAttended() Group by the has_attended column
 *
 * @method     ChildRegistrantEventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistrantEventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistrantEventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistrantEventQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistrantEventQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistrantEventQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistrantEventQuery leftJoinCountryRelatedByCountryId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CountryRelatedByCountryId relation
 * @method     ChildRegistrantEventQuery rightJoinCountryRelatedByCountryId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CountryRelatedByCountryId relation
 * @method     ChildRegistrantEventQuery innerJoinCountryRelatedByCountryId($relationAlias = null) Adds a INNER JOIN clause to the query using the CountryRelatedByCountryId relation
 *
 * @method     ChildRegistrantEventQuery joinWithCountryRelatedByCountryId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CountryRelatedByCountryId relation
 *
 * @method     ChildRegistrantEventQuery leftJoinWithCountryRelatedByCountryId() Adds a LEFT JOIN clause and with to the query using the CountryRelatedByCountryId relation
 * @method     ChildRegistrantEventQuery rightJoinWithCountryRelatedByCountryId() Adds a RIGHT JOIN clause and with to the query using the CountryRelatedByCountryId relation
 * @method     ChildRegistrantEventQuery innerJoinWithCountryRelatedByCountryId() Adds a INNER JOIN clause and with to the query using the CountryRelatedByCountryId relation
 *
 * @method     ChildRegistrantEventQuery leftJoinRegistrant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registrant relation
 * @method     ChildRegistrantEventQuery rightJoinRegistrant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registrant relation
 * @method     ChildRegistrantEventQuery innerJoinRegistrant($relationAlias = null) Adds a INNER JOIN clause to the query using the Registrant relation
 *
 * @method     ChildRegistrantEventQuery joinWithRegistrant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registrant relation
 *
 * @method     ChildRegistrantEventQuery leftJoinWithRegistrant() Adds a LEFT JOIN clause and with to the query using the Registrant relation
 * @method     ChildRegistrantEventQuery rightJoinWithRegistrant() Adds a RIGHT JOIN clause and with to the query using the Registrant relation
 * @method     ChildRegistrantEventQuery innerJoinWithRegistrant() Adds a INNER JOIN clause and with to the query using the Registrant relation
 *
 * @method     ChildRegistrantEventQuery leftJoinTopic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Topic relation
 * @method     ChildRegistrantEventQuery rightJoinTopic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Topic relation
 * @method     ChildRegistrantEventQuery innerJoinTopic($relationAlias = null) Adds a INNER JOIN clause to the query using the Topic relation
 *
 * @method     ChildRegistrantEventQuery joinWithTopic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Topic relation
 *
 * @method     ChildRegistrantEventQuery leftJoinWithTopic() Adds a LEFT JOIN clause and with to the query using the Topic relation
 * @method     ChildRegistrantEventQuery rightJoinWithTopic() Adds a RIGHT JOIN clause and with to the query using the Topic relation
 * @method     ChildRegistrantEventQuery innerJoinWithTopic() Adds a INNER JOIN clause and with to the query using the Topic relation
 *
 * @method     ChildRegistrantEventQuery leftJoinCountryRelatedByCountryDesired($relationAlias = null) Adds a LEFT JOIN clause to the query using the CountryRelatedByCountryDesired relation
 * @method     ChildRegistrantEventQuery rightJoinCountryRelatedByCountryDesired($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CountryRelatedByCountryDesired relation
 * @method     ChildRegistrantEventQuery innerJoinCountryRelatedByCountryDesired($relationAlias = null) Adds a INNER JOIN clause to the query using the CountryRelatedByCountryDesired relation
 *
 * @method     ChildRegistrantEventQuery joinWithCountryRelatedByCountryDesired($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CountryRelatedByCountryDesired relation
 *
 * @method     ChildRegistrantEventQuery leftJoinWithCountryRelatedByCountryDesired() Adds a LEFT JOIN clause and with to the query using the CountryRelatedByCountryDesired relation
 * @method     ChildRegistrantEventQuery rightJoinWithCountryRelatedByCountryDesired() Adds a RIGHT JOIN clause and with to the query using the CountryRelatedByCountryDesired relation
 * @method     ChildRegistrantEventQuery innerJoinWithCountryRelatedByCountryDesired() Adds a INNER JOIN clause and with to the query using the CountryRelatedByCountryDesired relation
 *
 * @method     \db\db\CountryQuery|\db\db\RegistrantQuery|\db\db\TopicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistrantEvent findOne(ConnectionInterface $con = null) Return the first ChildRegistrantEvent matching the query
 * @method     ChildRegistrantEvent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRegistrantEvent matching the query, or a new ChildRegistrantEvent object populated from the query conditions when no match is found
 *
 * @method     ChildRegistrantEvent findOneByRegistrantId(int $registrant_id) Return the first ChildRegistrantEvent filtered by the registrant_id column
 * @method     ChildRegistrantEvent findOneByTopicId(int $topic_id) Return the first ChildRegistrantEvent filtered by the topic_id column
 * @method     ChildRegistrantEvent findOneByCountryId(int $country_id) Return the first ChildRegistrantEvent filtered by the country_id column
 * @method     ChildRegistrantEvent findOneByCountryDesired(int $country_desired) Return the first ChildRegistrantEvent filtered by the country_desired column
 * @method     ChildRegistrantEvent findOneByRegistrationTime(string $registration_time) Return the first ChildRegistrantEvent filtered by the registration_time column
 * @method     ChildRegistrantEvent findOneByApproved(boolean $approved) Return the first ChildRegistrantEvent filtered by the approved column
 * @method     ChildRegistrantEvent findOneByApprovedTime(string $approved_time) Return the first ChildRegistrantEvent filtered by the approved_time column
 * @method     ChildRegistrantEvent findOneByLocal(boolean $local) Return the first ChildRegistrantEvent filtered by the local column
 * @method     ChildRegistrantEvent findOneByHasAttended(boolean $has_attended) Return the first ChildRegistrantEvent filtered by the has_attended column *

 * @method     ChildRegistrantEvent requirePk($key, ConnectionInterface $con = null) Return the ChildRegistrantEvent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOne(ConnectionInterface $con = null) Return the first ChildRegistrantEvent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrantEvent requireOneByRegistrantId(int $registrant_id) Return the first ChildRegistrantEvent filtered by the registrant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByTopicId(int $topic_id) Return the first ChildRegistrantEvent filtered by the topic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByCountryId(int $country_id) Return the first ChildRegistrantEvent filtered by the country_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByCountryDesired(int $country_desired) Return the first ChildRegistrantEvent filtered by the country_desired column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByRegistrationTime(string $registration_time) Return the first ChildRegistrantEvent filtered by the registration_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByApproved(boolean $approved) Return the first ChildRegistrantEvent filtered by the approved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByApprovedTime(string $approved_time) Return the first ChildRegistrantEvent filtered by the approved_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByLocal(boolean $local) Return the first ChildRegistrantEvent filtered by the local column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantEvent requireOneByHasAttended(boolean $has_attended) Return the first ChildRegistrantEvent filtered by the has_attended column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrantEvent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRegistrantEvent objects based on current ModelCriteria
 * @method     ChildRegistrantEvent[]|ObjectCollection findByRegistrantId(int $registrant_id) Return ChildRegistrantEvent objects filtered by the registrant_id column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByTopicId(int $topic_id) Return ChildRegistrantEvent objects filtered by the topic_id column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByCountryId(int $country_id) Return ChildRegistrantEvent objects filtered by the country_id column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByCountryDesired(int $country_desired) Return ChildRegistrantEvent objects filtered by the country_desired column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByRegistrationTime(string $registration_time) Return ChildRegistrantEvent objects filtered by the registration_time column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByApproved(boolean $approved) Return ChildRegistrantEvent objects filtered by the approved column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByApprovedTime(string $approved_time) Return ChildRegistrantEvent objects filtered by the approved_time column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByLocal(boolean $local) Return ChildRegistrantEvent objects filtered by the local column
 * @method     ChildRegistrantEvent[]|ObjectCollection findByHasAttended(boolean $has_attended) Return ChildRegistrantEvent objects filtered by the has_attended column
 * @method     ChildRegistrantEvent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistrantEventQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\RegistrantEventQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\RegistrantEvent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistrantEventQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistrantEventQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRegistrantEventQuery) {
            return $criteria;
        }
        $query = new ChildRegistrantEventQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRegistrantEvent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistrantEventTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantEvent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registrant_id, topic_id, country_id, country_desired, registration_time, approved, approved_time, local, has_attended FROM registrant_event WHERE registrant_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRegistrantEvent $obj */
            $obj = new ChildRegistrantEvent();
            $obj->hydrate($row);
            RegistrantEventTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildRegistrantEvent|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the registrant_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistrantId(1234); // WHERE registrant_id = 1234
     * $query->filterByRegistrantId(array(12, 34)); // WHERE registrant_id IN (12, 34)
     * $query->filterByRegistrantId(array('min' => 12)); // WHERE registrant_id > 12
     * </code>
     *
     * @see       filterByRegistrant()
     *
     * @param     mixed $registrantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByRegistrantId($registrantId = null, $comparison = null)
    {
        if (is_array($registrantId)) {
            $useMinMax = false;
            if (isset($registrantId['min'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $registrantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrantId['max'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $registrantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $registrantId, $comparison);
    }

    /**
     * Filter the query on the topic_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicId(1234); // WHERE topic_id = 1234
     * $query->filterByTopicId(array(12, 34)); // WHERE topic_id IN (12, 34)
     * $query->filterByTopicId(array('min' => 12)); // WHERE topic_id > 12
     * </code>
     *
     * @see       filterByTopic()
     *
     * @param     mixed $topicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByTopicId($topicId = null, $comparison = null)
    {
        if (is_array($topicId)) {
            $useMinMax = false;
            if (isset($topicId['min'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_TOPIC_ID, $topicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($topicId['max'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_TOPIC_ID, $topicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_TOPIC_ID, $topicId, $comparison);
    }

    /**
     * Filter the query on the country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryId(1234); // WHERE country_id = 1234
     * $query->filterByCountryId(array(12, 34)); // WHERE country_id IN (12, 34)
     * $query->filterByCountryId(array('min' => 12)); // WHERE country_id > 12
     * </code>
     *
     * @see       filterByCountryRelatedByCountryId()
     *
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_ID, $countryId, $comparison);
    }

    /**
     * Filter the query on the country_desired column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryDesired(1234); // WHERE country_desired = 1234
     * $query->filterByCountryDesired(array(12, 34)); // WHERE country_desired IN (12, 34)
     * $query->filterByCountryDesired(array('min' => 12)); // WHERE country_desired > 12
     * </code>
     *
     * @see       filterByCountryRelatedByCountryDesired()
     *
     * @param     mixed $countryDesired The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByCountryDesired($countryDesired = null, $comparison = null)
    {
        if (is_array($countryDesired)) {
            $useMinMax = false;
            if (isset($countryDesired['min'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_DESIRED, $countryDesired['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryDesired['max'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_DESIRED, $countryDesired['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_DESIRED, $countryDesired, $comparison);
    }

    /**
     * Filter the query on the registration_time column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistrationTime('2011-03-14'); // WHERE registration_time = '2011-03-14'
     * $query->filterByRegistrationTime('now'); // WHERE registration_time = '2011-03-14'
     * $query->filterByRegistrationTime(array('max' => 'yesterday')); // WHERE registration_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $registrationTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByRegistrationTime($registrationTime = null, $comparison = null)
    {
        if (is_array($registrationTime)) {
            $useMinMax = false;
            if (isset($registrationTime['min'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRATION_TIME, $registrationTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrationTime['max'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRATION_TIME, $registrationTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRATION_TIME, $registrationTime, $comparison);
    }

    /**
     * Filter the query on the approved column
     *
     * Example usage:
     * <code>
     * $query->filterByApproved(true); // WHERE approved = true
     * $query->filterByApproved('yes'); // WHERE approved = true
     * </code>
     *
     * @param     boolean|string $approved The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByApproved($approved = null, $comparison = null)
    {
        if (is_string($approved)) {
            $approved = in_array(strtolower($approved), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_APPROVED, $approved, $comparison);
    }

    /**
     * Filter the query on the approved_time column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedTime('2011-03-14'); // WHERE approved_time = '2011-03-14'
     * $query->filterByApprovedTime('now'); // WHERE approved_time = '2011-03-14'
     * $query->filterByApprovedTime(array('max' => 'yesterday')); // WHERE approved_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $approvedTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByApprovedTime($approvedTime = null, $comparison = null)
    {
        if (is_array($approvedTime)) {
            $useMinMax = false;
            if (isset($approvedTime['min'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_APPROVED_TIME, $approvedTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedTime['max'])) {
                $this->addUsingAlias(RegistrantEventTableMap::COL_APPROVED_TIME, $approvedTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_APPROVED_TIME, $approvedTime, $comparison);
    }

    /**
     * Filter the query on the local column
     *
     * Example usage:
     * <code>
     * $query->filterByLocal(true); // WHERE local = true
     * $query->filterByLocal('yes'); // WHERE local = true
     * </code>
     *
     * @param     boolean|string $local The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByLocal($local = null, $comparison = null)
    {
        if (is_string($local)) {
            $local = in_array(strtolower($local), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_LOCAL, $local, $comparison);
    }

    /**
     * Filter the query on the has_attended column
     *
     * Example usage:
     * <code>
     * $query->filterByHasAttended(true); // WHERE has_attended = true
     * $query->filterByHasAttended('yes'); // WHERE has_attended = true
     * </code>
     *
     * @param     boolean|string $hasAttended The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByHasAttended($hasAttended = null, $comparison = null)
    {
        if (is_string($hasAttended)) {
            $hasAttended = in_array(strtolower($hasAttended), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RegistrantEventTableMap::COL_HAS_ATTENDED, $hasAttended, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Country object
     *
     * @param \db\db\Country|ObjectCollection $country The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByCountryRelatedByCountryId($country, $comparison = null)
    {
        if ($country instanceof \db\db\Country) {
            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_ID, $country->getCountryId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_ID, $country->toKeyValue('PrimaryKey', 'CountryId'), $comparison);
        } else {
            throw new PropelException('filterByCountryRelatedByCountryId() only accepts arguments of type \db\db\Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CountryRelatedByCountryId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function joinCountryRelatedByCountryId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CountryRelatedByCountryId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CountryRelatedByCountryId');
        }

        return $this;
    }

    /**
     * Use the CountryRelatedByCountryId relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryRelatedByCountryIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountryRelatedByCountryId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CountryRelatedByCountryId', '\db\db\CountryQuery');
    }

    /**
     * Filter the query by a related \db\db\Registrant object
     *
     * @param \db\db\Registrant|ObjectCollection $registrant The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByRegistrant($registrant, $comparison = null)
    {
        if ($registrant instanceof \db\db\Registrant) {
            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $registrant->getRegistrantId(), $comparison);
        } elseif ($registrant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $registrant->toKeyValue('PrimaryKey', 'RegistrantId'), $comparison);
        } else {
            throw new PropelException('filterByRegistrant() only accepts arguments of type \db\db\Registrant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Registrant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function joinRegistrant($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Registrant');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Registrant');
        }

        return $this;
    }

    /**
     * Use the Registrant relation Registrant object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Registrant', '\db\db\RegistrantQuery');
    }

    /**
     * Filter the query by a related \db\db\Topic object
     *
     * @param \db\db\Topic|ObjectCollection $topic The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByTopic($topic, $comparison = null)
    {
        if ($topic instanceof \db\db\Topic) {
            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_TOPIC_ID, $topic->getTopicId(), $comparison);
        } elseif ($topic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_TOPIC_ID, $topic->toKeyValue('PrimaryKey', 'TopicId'), $comparison);
        } else {
            throw new PropelException('filterByTopic() only accepts arguments of type \db\db\Topic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Topic relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function joinTopic($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Topic');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Topic');
        }

        return $this;
    }

    /**
     * Use the Topic relation Topic object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\TopicQuery A secondary query class using the current class as primary query
     */
    public function useTopicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTopic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Topic', '\db\db\TopicQuery');
    }

    /**
     * Filter the query by a related \db\db\Country object
     *
     * @param \db\db\Country|ObjectCollection $country The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function filterByCountryRelatedByCountryDesired($country, $comparison = null)
    {
        if ($country instanceof \db\db\Country) {
            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_DESIRED, $country->getCountryId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantEventTableMap::COL_COUNTRY_DESIRED, $country->toKeyValue('PrimaryKey', 'CountryId'), $comparison);
        } else {
            throw new PropelException('filterByCountryRelatedByCountryDesired() only accepts arguments of type \db\db\Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CountryRelatedByCountryDesired relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function joinCountryRelatedByCountryDesired($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CountryRelatedByCountryDesired');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CountryRelatedByCountryDesired');
        }

        return $this;
    }

    /**
     * Use the CountryRelatedByCountryDesired relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryRelatedByCountryDesiredQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCountryRelatedByCountryDesired($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CountryRelatedByCountryDesired', '\db\db\CountryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRegistrantEvent $registrantEvent Object to remove from the list of results
     *
     * @return $this|ChildRegistrantEventQuery The current query, for fluid interface
     */
    public function prune($registrantEvent = null)
    {
        if ($registrantEvent) {
            $this->addUsingAlias(RegistrantEventTableMap::COL_REGISTRANT_ID, $registrantEvent->getRegistrantId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registrant_event table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistrantEventTableMap::clearInstancePool();
            RegistrantEventTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistrantEventTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistrantEventTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistrantEventTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RegistrantEventQuery
