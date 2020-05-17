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
use db\db\Registrant as ChildRegistrant;
use db\db\RegistrantQuery as ChildRegistrantQuery;
use db\db\Map\RegistrantTableMap;

/**
 * Base class that represents a query for the 'registrant' table.
 *
 *
 *
 * @method     ChildRegistrantQuery orderByRegistrantId($order = Criteria::ASC) Order by the registrant_id column
 * @method     ChildRegistrantQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildRegistrantQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method     ChildRegistrantQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildRegistrantQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildRegistrantQuery orderByDiscord($order = Criteria::ASC) Order by the discord column
 * @method     ChildRegistrantQuery orderByInstitution($order = Criteria::ASC) Order by the institution column
 *
 * @method     ChildRegistrantQuery groupByRegistrantId() Group by the registrant_id column
 * @method     ChildRegistrantQuery groupByName() Group by the name column
 * @method     ChildRegistrantQuery groupBySurname() Group by the surname column
 * @method     ChildRegistrantQuery groupByEmail() Group by the email column
 * @method     ChildRegistrantQuery groupByPhone() Group by the phone column
 * @method     ChildRegistrantQuery groupByDiscord() Group by the discord column
 * @method     ChildRegistrantQuery groupByInstitution() Group by the institution column
 *
 * @method     ChildRegistrantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistrantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistrantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistrantQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistrantQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistrantQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistrantQuery leftJoinRegistrantEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantEvent relation
 * @method     ChildRegistrantQuery rightJoinRegistrantEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantEvent relation
 * @method     ChildRegistrantQuery innerJoinRegistrantEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantEvent relation
 *
 * @method     ChildRegistrantQuery joinWithRegistrantEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantEvent relation
 *
 * @method     ChildRegistrantQuery leftJoinWithRegistrantEvent() Adds a LEFT JOIN clause and with to the query using the RegistrantEvent relation
 * @method     ChildRegistrantQuery rightJoinWithRegistrantEvent() Adds a RIGHT JOIN clause and with to the query using the RegistrantEvent relation
 * @method     ChildRegistrantQuery innerJoinWithRegistrantEvent() Adds a INNER JOIN clause and with to the query using the RegistrantEvent relation
 *
 * @method     ChildRegistrantQuery leftJoinRegistrantOccupation($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantOccupation relation
 * @method     ChildRegistrantQuery rightJoinRegistrantOccupation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantOccupation relation
 * @method     ChildRegistrantQuery innerJoinRegistrantOccupation($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantOccupation relation
 *
 * @method     ChildRegistrantQuery joinWithRegistrantOccupation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantOccupation relation
 *
 * @method     ChildRegistrantQuery leftJoinWithRegistrantOccupation() Adds a LEFT JOIN clause and with to the query using the RegistrantOccupation relation
 * @method     ChildRegistrantQuery rightJoinWithRegistrantOccupation() Adds a RIGHT JOIN clause and with to the query using the RegistrantOccupation relation
 * @method     ChildRegistrantQuery innerJoinWithRegistrantOccupation() Adds a INNER JOIN clause and with to the query using the RegistrantOccupation relation
 *
 * @method     ChildRegistrantQuery leftJoinRegistrantSchoolStudent($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantSchoolStudent relation
 * @method     ChildRegistrantQuery rightJoinRegistrantSchoolStudent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantSchoolStudent relation
 * @method     ChildRegistrantQuery innerJoinRegistrantSchoolStudent($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantSchoolStudent relation
 *
 * @method     ChildRegistrantQuery joinWithRegistrantSchoolStudent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantSchoolStudent relation
 *
 * @method     ChildRegistrantQuery leftJoinWithRegistrantSchoolStudent() Adds a LEFT JOIN clause and with to the query using the RegistrantSchoolStudent relation
 * @method     ChildRegistrantQuery rightJoinWithRegistrantSchoolStudent() Adds a RIGHT JOIN clause and with to the query using the RegistrantSchoolStudent relation
 * @method     ChildRegistrantQuery innerJoinWithRegistrantSchoolStudent() Adds a INNER JOIN clause and with to the query using the RegistrantSchoolStudent relation
 *
 * @method     ChildRegistrantQuery leftJoinRegistrantStudent($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantStudent relation
 * @method     ChildRegistrantQuery rightJoinRegistrantStudent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantStudent relation
 * @method     ChildRegistrantQuery innerJoinRegistrantStudent($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantStudent relation
 *
 * @method     ChildRegistrantQuery joinWithRegistrantStudent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantStudent relation
 *
 * @method     ChildRegistrantQuery leftJoinWithRegistrantStudent() Adds a LEFT JOIN clause and with to the query using the RegistrantStudent relation
 * @method     ChildRegistrantQuery rightJoinWithRegistrantStudent() Adds a RIGHT JOIN clause and with to the query using the RegistrantStudent relation
 * @method     ChildRegistrantQuery innerJoinWithRegistrantStudent() Adds a INNER JOIN clause and with to the query using the RegistrantStudent relation
 *
 * @method     ChildRegistrantQuery leftJoinRegistrantTeacher($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantTeacher relation
 * @method     ChildRegistrantQuery rightJoinRegistrantTeacher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantTeacher relation
 * @method     ChildRegistrantQuery innerJoinRegistrantTeacher($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantTeacher relation
 *
 * @method     ChildRegistrantQuery joinWithRegistrantTeacher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantTeacher relation
 *
 * @method     ChildRegistrantQuery leftJoinWithRegistrantTeacher() Adds a LEFT JOIN clause and with to the query using the RegistrantTeacher relation
 * @method     ChildRegistrantQuery rightJoinWithRegistrantTeacher() Adds a RIGHT JOIN clause and with to the query using the RegistrantTeacher relation
 * @method     ChildRegistrantQuery innerJoinWithRegistrantTeacher() Adds a INNER JOIN clause and with to the query using the RegistrantTeacher relation
 *
 * @method     \db\db\RegistrantEventQuery|\db\db\RegistrantOccupationQuery|\db\db\RegistrantSchoolStudentQuery|\db\db\RegistrantStudentQuery|\db\db\RegistrantTeacherQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistrant findOne(ConnectionInterface $con = null) Return the first ChildRegistrant matching the query
 * @method     ChildRegistrant findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRegistrant matching the query, or a new ChildRegistrant object populated from the query conditions when no match is found
 *
 * @method     ChildRegistrant findOneByRegistrantId(int $registrant_id) Return the first ChildRegistrant filtered by the registrant_id column
 * @method     ChildRegistrant findOneByName(string $name) Return the first ChildRegistrant filtered by the name column
 * @method     ChildRegistrant findOneBySurname(string $surname) Return the first ChildRegistrant filtered by the surname column
 * @method     ChildRegistrant findOneByEmail(string $email) Return the first ChildRegistrant filtered by the email column
 * @method     ChildRegistrant findOneByPhone(string $phone) Return the first ChildRegistrant filtered by the phone column
 * @method     ChildRegistrant findOneByDiscord(string $discord) Return the first ChildRegistrant filtered by the discord column
 * @method     ChildRegistrant findOneByInstitution(string $institution) Return the first ChildRegistrant filtered by the institution column *

 * @method     ChildRegistrant requirePk($key, ConnectionInterface $con = null) Return the ChildRegistrant by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOne(ConnectionInterface $con = null) Return the first ChildRegistrant matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrant requireOneByRegistrantId(int $registrant_id) Return the first ChildRegistrant filtered by the registrant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOneByName(string $name) Return the first ChildRegistrant filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOneBySurname(string $surname) Return the first ChildRegistrant filtered by the surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOneByEmail(string $email) Return the first ChildRegistrant filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOneByPhone(string $phone) Return the first ChildRegistrant filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOneByDiscord(string $discord) Return the first ChildRegistrant filtered by the discord column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrant requireOneByInstitution(string $institution) Return the first ChildRegistrant filtered by the institution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrant[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRegistrant objects based on current ModelCriteria
 * @method     ChildRegistrant[]|ObjectCollection findByRegistrantId(int $registrant_id) Return ChildRegistrant objects filtered by the registrant_id column
 * @method     ChildRegistrant[]|ObjectCollection findByName(string $name) Return ChildRegistrant objects filtered by the name column
 * @method     ChildRegistrant[]|ObjectCollection findBySurname(string $surname) Return ChildRegistrant objects filtered by the surname column
 * @method     ChildRegistrant[]|ObjectCollection findByEmail(string $email) Return ChildRegistrant objects filtered by the email column
 * @method     ChildRegistrant[]|ObjectCollection findByPhone(string $phone) Return ChildRegistrant objects filtered by the phone column
 * @method     ChildRegistrant[]|ObjectCollection findByDiscord(string $discord) Return ChildRegistrant objects filtered by the discord column
 * @method     ChildRegistrant[]|ObjectCollection findByInstitution(string $institution) Return ChildRegistrant objects filtered by the institution column
 * @method     ChildRegistrant[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistrantQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\RegistrantQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\Registrant', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistrantQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistrantQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRegistrantQuery) {
            return $criteria;
        }
        $query = new ChildRegistrantQuery();
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
     * @return ChildRegistrant|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistrantTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRegistrant A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registrant_id, name, surname, email, phone, discord, institution FROM registrant WHERE registrant_id = :p0';
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
            /** @var ChildRegistrant $obj */
            $obj = new ChildRegistrant();
            $obj->hydrate($row);
            RegistrantTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRegistrant|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $keys, Criteria::IN);
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
     * @param     mixed $registrantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByRegistrantId($registrantId = null, $comparison = null)
    {
        if (is_array($registrantId)) {
            $useMinMax = false;
            if (isset($registrantId['min'])) {
                $this->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrantId['max'])) {
                $this->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the surname column
     *
     * Example usage:
     * <code>
     * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
     * $query->filterBySurname('%fooValue%', Criteria::LIKE); // WHERE surname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $surname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterBySurname($surname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_SURNAME, $surname, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the discord column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscord('fooValue');   // WHERE discord = 'fooValue'
     * $query->filterByDiscord('%fooValue%', Criteria::LIKE); // WHERE discord LIKE '%fooValue%'
     * </code>
     *
     * @param     string $discord The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByDiscord($discord = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($discord)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_DISCORD, $discord, $comparison);
    }

    /**
     * Filter the query on the institution column
     *
     * Example usage:
     * <code>
     * $query->filterByInstitution('fooValue');   // WHERE institution = 'fooValue'
     * $query->filterByInstitution('%fooValue%', Criteria::LIKE); // WHERE institution LIKE '%fooValue%'
     * </code>
     *
     * @param     string $institution The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByInstitution($institution = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($institution)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantTableMap::COL_INSTITUTION, $institution, $comparison);
    }

    /**
     * Filter the query by a related \db\db\RegistrantEvent object
     *
     * @param \db\db\RegistrantEvent|ObjectCollection $registrantEvent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByRegistrantEvent($registrantEvent, $comparison = null)
    {
        if ($registrantEvent instanceof \db\db\RegistrantEvent) {
            return $this
                ->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantEvent->getRegistrantId(), $comparison);
        } elseif ($registrantEvent instanceof ObjectCollection) {
            return $this
                ->useRegistrantEventQuery()
                ->filterByPrimaryKeys($registrantEvent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantEvent() only accepts arguments of type \db\db\RegistrantEvent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantEvent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function joinRegistrantEvent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantEvent');

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
            $this->addJoinObject($join, 'RegistrantEvent');
        }

        return $this;
    }

    /**
     * Use the RegistrantEvent relation RegistrantEvent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantEventQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantEvent', '\db\db\RegistrantEventQuery');
    }

    /**
     * Filter the query by a related \db\db\RegistrantOccupation object
     *
     * @param \db\db\RegistrantOccupation|ObjectCollection $registrantOccupation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByRegistrantOccupation($registrantOccupation, $comparison = null)
    {
        if ($registrantOccupation instanceof \db\db\RegistrantOccupation) {
            return $this
                ->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantOccupation->getRegistrantId(), $comparison);
        } elseif ($registrantOccupation instanceof ObjectCollection) {
            return $this
                ->useRegistrantOccupationQuery()
                ->filterByPrimaryKeys($registrantOccupation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantOccupation() only accepts arguments of type \db\db\RegistrantOccupation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantOccupation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function joinRegistrantOccupation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantOccupation');

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
            $this->addJoinObject($join, 'RegistrantOccupation');
        }

        return $this;
    }

    /**
     * Use the RegistrantOccupation relation RegistrantOccupation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantOccupationQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantOccupationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantOccupation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantOccupation', '\db\db\RegistrantOccupationQuery');
    }

    /**
     * Filter the query by a related \db\db\RegistrantSchoolStudent object
     *
     * @param \db\db\RegistrantSchoolStudent|ObjectCollection $registrantSchoolStudent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByRegistrantSchoolStudent($registrantSchoolStudent, $comparison = null)
    {
        if ($registrantSchoolStudent instanceof \db\db\RegistrantSchoolStudent) {
            return $this
                ->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantSchoolStudent->getRegistrantId(), $comparison);
        } elseif ($registrantSchoolStudent instanceof ObjectCollection) {
            return $this
                ->useRegistrantSchoolStudentQuery()
                ->filterByPrimaryKeys($registrantSchoolStudent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantSchoolStudent() only accepts arguments of type \db\db\RegistrantSchoolStudent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantSchoolStudent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function joinRegistrantSchoolStudent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantSchoolStudent');

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
            $this->addJoinObject($join, 'RegistrantSchoolStudent');
        }

        return $this;
    }

    /**
     * Use the RegistrantSchoolStudent relation RegistrantSchoolStudent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantSchoolStudentQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantSchoolStudentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantSchoolStudent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantSchoolStudent', '\db\db\RegistrantSchoolStudentQuery');
    }

    /**
     * Filter the query by a related \db\db\RegistrantStudent object
     *
     * @param \db\db\RegistrantStudent|ObjectCollection $registrantStudent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByRegistrantStudent($registrantStudent, $comparison = null)
    {
        if ($registrantStudent instanceof \db\db\RegistrantStudent) {
            return $this
                ->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantStudent->getRegistrantId(), $comparison);
        } elseif ($registrantStudent instanceof ObjectCollection) {
            return $this
                ->useRegistrantStudentQuery()
                ->filterByPrimaryKeys($registrantStudent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantStudent() only accepts arguments of type \db\db\RegistrantStudent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantStudent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function joinRegistrantStudent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantStudent');

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
            $this->addJoinObject($join, 'RegistrantStudent');
        }

        return $this;
    }

    /**
     * Use the RegistrantStudent relation RegistrantStudent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantStudentQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantStudentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantStudent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantStudent', '\db\db\RegistrantStudentQuery');
    }

    /**
     * Filter the query by a related \db\db\RegistrantTeacher object
     *
     * @param \db\db\RegistrantTeacher|ObjectCollection $registrantTeacher the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantQuery The current query, for fluid interface
     */
    public function filterByRegistrantTeacher($registrantTeacher, $comparison = null)
    {
        if ($registrantTeacher instanceof \db\db\RegistrantTeacher) {
            return $this
                ->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrantTeacher->getRegistrantId(), $comparison);
        } elseif ($registrantTeacher instanceof ObjectCollection) {
            return $this
                ->useRegistrantTeacherQuery()
                ->filterByPrimaryKeys($registrantTeacher->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantTeacher() only accepts arguments of type \db\db\RegistrantTeacher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantTeacher relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function joinRegistrantTeacher($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantTeacher');

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
            $this->addJoinObject($join, 'RegistrantTeacher');
        }

        return $this;
    }

    /**
     * Use the RegistrantTeacher relation RegistrantTeacher object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantTeacherQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantTeacherQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantTeacher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantTeacher', '\db\db\RegistrantTeacherQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRegistrant $registrant Object to remove from the list of results
     *
     * @return $this|ChildRegistrantQuery The current query, for fluid interface
     */
    public function prune($registrant = null)
    {
        if ($registrant) {
            $this->addUsingAlias(RegistrantTableMap::COL_REGISTRANT_ID, $registrant->getRegistrantId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registrant table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistrantTableMap::clearInstancePool();
            RegistrantTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistrantTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistrantTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistrantTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RegistrantQuery
