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
use db\db\Registrants as ChildRegistrants;
use db\db\RegistrantsQuery as ChildRegistrantsQuery;
use db\db\Map\RegistrantsTableMap;

/**
 * Base class that represents a query for the 'registrants' table.
 *
 *
 *
 * @method     ChildRegistrantsQuery orderByRegistrantId($order = Criteria::ASC) Order by the registrant_id column
 * @method     ChildRegistrantsQuery orderByInstitution($order = Criteria::ASC) Order by the institution column
 * @method     ChildRegistrantsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildRegistrantsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildRegistrantsQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method     ChildRegistrantsQuery orderByTel($order = Criteria::ASC) Order by the tel column
 * @method     ChildRegistrantsQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildRegistrantsQuery orderByCountryReserved($order = Criteria::ASC) Order by the country_reserved column
 * @method     ChildRegistrantsQuery orderByLastUpdate($order = Criteria::ASC) Order by the last_update column
 *
 * @method     ChildRegistrantsQuery groupByRegistrantId() Group by the registrant_id column
 * @method     ChildRegistrantsQuery groupByInstitution() Group by the institution column
 * @method     ChildRegistrantsQuery groupByEmail() Group by the email column
 * @method     ChildRegistrantsQuery groupByName() Group by the name column
 * @method     ChildRegistrantsQuery groupBySurname() Group by the surname column
 * @method     ChildRegistrantsQuery groupByTel() Group by the tel column
 * @method     ChildRegistrantsQuery groupByCountry() Group by the country column
 * @method     ChildRegistrantsQuery groupByCountryReserved() Group by the country_reserved column
 * @method     ChildRegistrantsQuery groupByLastUpdate() Group by the last_update column
 *
 * @method     ChildRegistrantsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistrantsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistrantsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistrantsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistrantsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistrantsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistrantsQuery leftJoinCountriesRelatedByCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the CountriesRelatedByCountry relation
 * @method     ChildRegistrantsQuery rightJoinCountriesRelatedByCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CountriesRelatedByCountry relation
 * @method     ChildRegistrantsQuery innerJoinCountriesRelatedByCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the CountriesRelatedByCountry relation
 *
 * @method     ChildRegistrantsQuery joinWithCountriesRelatedByCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CountriesRelatedByCountry relation
 *
 * @method     ChildRegistrantsQuery leftJoinWithCountriesRelatedByCountry() Adds a LEFT JOIN clause and with to the query using the CountriesRelatedByCountry relation
 * @method     ChildRegistrantsQuery rightJoinWithCountriesRelatedByCountry() Adds a RIGHT JOIN clause and with to the query using the CountriesRelatedByCountry relation
 * @method     ChildRegistrantsQuery innerJoinWithCountriesRelatedByCountry() Adds a INNER JOIN clause and with to the query using the CountriesRelatedByCountry relation
 *
 * @method     ChildRegistrantsQuery leftJoinCountriesRelatedByCountryReserved($relationAlias = null) Adds a LEFT JOIN clause to the query using the CountriesRelatedByCountryReserved relation
 * @method     ChildRegistrantsQuery rightJoinCountriesRelatedByCountryReserved($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CountriesRelatedByCountryReserved relation
 * @method     ChildRegistrantsQuery innerJoinCountriesRelatedByCountryReserved($relationAlias = null) Adds a INNER JOIN clause to the query using the CountriesRelatedByCountryReserved relation
 *
 * @method     ChildRegistrantsQuery joinWithCountriesRelatedByCountryReserved($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CountriesRelatedByCountryReserved relation
 *
 * @method     ChildRegistrantsQuery leftJoinWithCountriesRelatedByCountryReserved() Adds a LEFT JOIN clause and with to the query using the CountriesRelatedByCountryReserved relation
 * @method     ChildRegistrantsQuery rightJoinWithCountriesRelatedByCountryReserved() Adds a RIGHT JOIN clause and with to the query using the CountriesRelatedByCountryReserved relation
 * @method     ChildRegistrantsQuery innerJoinWithCountriesRelatedByCountryReserved() Adds a INNER JOIN clause and with to the query using the CountriesRelatedByCountryReserved relation
 *
 * @method     ChildRegistrantsQuery leftJoinRegistrantRoles($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantRoles relation
 * @method     ChildRegistrantsQuery rightJoinRegistrantRoles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantRoles relation
 * @method     ChildRegistrantsQuery innerJoinRegistrantRoles($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantRoles relation
 *
 * @method     ChildRegistrantsQuery joinWithRegistrantRoles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantRoles relation
 *
 * @method     ChildRegistrantsQuery leftJoinWithRegistrantRoles() Adds a LEFT JOIN clause and with to the query using the RegistrantRoles relation
 * @method     ChildRegistrantsQuery rightJoinWithRegistrantRoles() Adds a RIGHT JOIN clause and with to the query using the RegistrantRoles relation
 * @method     ChildRegistrantsQuery innerJoinWithRegistrantRoles() Adds a INNER JOIN clause and with to the query using the RegistrantRoles relation
 *
 * @method     ChildRegistrantsQuery leftJoinStudents($relationAlias = null) Adds a LEFT JOIN clause to the query using the Students relation
 * @method     ChildRegistrantsQuery rightJoinStudents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Students relation
 * @method     ChildRegistrantsQuery innerJoinStudents($relationAlias = null) Adds a INNER JOIN clause to the query using the Students relation
 *
 * @method     ChildRegistrantsQuery joinWithStudents($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Students relation
 *
 * @method     ChildRegistrantsQuery leftJoinWithStudents() Adds a LEFT JOIN clause and with to the query using the Students relation
 * @method     ChildRegistrantsQuery rightJoinWithStudents() Adds a RIGHT JOIN clause and with to the query using the Students relation
 * @method     ChildRegistrantsQuery innerJoinWithStudents() Adds a INNER JOIN clause and with to the query using the Students relation
 *
 * @method     ChildRegistrantsQuery leftJoinTeachers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teachers relation
 * @method     ChildRegistrantsQuery rightJoinTeachers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teachers relation
 * @method     ChildRegistrantsQuery innerJoinTeachers($relationAlias = null) Adds a INNER JOIN clause to the query using the Teachers relation
 *
 * @method     ChildRegistrantsQuery joinWithTeachers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teachers relation
 *
 * @method     ChildRegistrantsQuery leftJoinWithTeachers() Adds a LEFT JOIN clause and with to the query using the Teachers relation
 * @method     ChildRegistrantsQuery rightJoinWithTeachers() Adds a RIGHT JOIN clause and with to the query using the Teachers relation
 * @method     ChildRegistrantsQuery innerJoinWithTeachers() Adds a INNER JOIN clause and with to the query using the Teachers relation
 *
 * @method     \db\db\CountriesQuery|\db\db\RegistrantRolesQuery|\db\db\StudentsQuery|\db\db\TeachersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistrants findOne(ConnectionInterface $con = null) Return the first ChildRegistrants matching the query
 * @method     ChildRegistrants findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRegistrants matching the query, or a new ChildRegistrants object populated from the query conditions when no match is found
 *
 * @method     ChildRegistrants findOneByRegistrantId(int $registrant_id) Return the first ChildRegistrants filtered by the registrant_id column
 * @method     ChildRegistrants findOneByInstitution(string $institution) Return the first ChildRegistrants filtered by the institution column
 * @method     ChildRegistrants findOneByEmail(string $email) Return the first ChildRegistrants filtered by the email column
 * @method     ChildRegistrants findOneByName(string $name) Return the first ChildRegistrants filtered by the name column
 * @method     ChildRegistrants findOneBySurname(string $surname) Return the first ChildRegistrants filtered by the surname column
 * @method     ChildRegistrants findOneByTel(string $tel) Return the first ChildRegistrants filtered by the tel column
 * @method     ChildRegistrants findOneByCountry(int $country) Return the first ChildRegistrants filtered by the country column
 * @method     ChildRegistrants findOneByCountryReserved(int $country_reserved) Return the first ChildRegistrants filtered by the country_reserved column
 * @method     ChildRegistrants findOneByLastUpdate(string $last_update) Return the first ChildRegistrants filtered by the last_update column *

 * @method     ChildRegistrants requirePk($key, ConnectionInterface $con = null) Return the ChildRegistrants by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOne(ConnectionInterface $con = null) Return the first ChildRegistrants matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrants requireOneByRegistrantId(int $registrant_id) Return the first ChildRegistrants filtered by the registrant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByInstitution(string $institution) Return the first ChildRegistrants filtered by the institution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByEmail(string $email) Return the first ChildRegistrants filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByName(string $name) Return the first ChildRegistrants filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneBySurname(string $surname) Return the first ChildRegistrants filtered by the surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByTel(string $tel) Return the first ChildRegistrants filtered by the tel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByCountry(int $country) Return the first ChildRegistrants filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByCountryReserved(int $country_reserved) Return the first ChildRegistrants filtered by the country_reserved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrants requireOneByLastUpdate(string $last_update) Return the first ChildRegistrants filtered by the last_update column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrants[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRegistrants objects based on current ModelCriteria
 * @method     ChildRegistrants[]|ObjectCollection findByRegistrantId(int $registrant_id) Return ChildRegistrants objects filtered by the registrant_id column
 * @method     ChildRegistrants[]|ObjectCollection findByInstitution(string $institution) Return ChildRegistrants objects filtered by the institution column
 * @method     ChildRegistrants[]|ObjectCollection findByEmail(string $email) Return ChildRegistrants objects filtered by the email column
 * @method     ChildRegistrants[]|ObjectCollection findByName(string $name) Return ChildRegistrants objects filtered by the name column
 * @method     ChildRegistrants[]|ObjectCollection findBySurname(string $surname) Return ChildRegistrants objects filtered by the surname column
 * @method     ChildRegistrants[]|ObjectCollection findByTel(string $tel) Return ChildRegistrants objects filtered by the tel column
 * @method     ChildRegistrants[]|ObjectCollection findByCountry(int $country) Return ChildRegistrants objects filtered by the country column
 * @method     ChildRegistrants[]|ObjectCollection findByCountryReserved(int $country_reserved) Return ChildRegistrants objects filtered by the country_reserved column
 * @method     ChildRegistrants[]|ObjectCollection findByLastUpdate(string $last_update) Return ChildRegistrants objects filtered by the last_update column
 * @method     ChildRegistrants[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistrantsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\RegistrantsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\Registrants', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistrantsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistrantsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRegistrantsQuery) {
            return $criteria;
        }
        $query = new ChildRegistrantsQuery();
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
     * @return ChildRegistrants|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistrantsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRegistrants A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registrant_id, institution, email, name, surname, tel, country, country_reserved, last_update FROM registrants WHERE registrant_id = :p0';
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
            /** @var ChildRegistrants $obj */
            $obj = new ChildRegistrants();
            $obj->hydrate($row);
            RegistrantsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRegistrants|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByRegistrantId($registrantId = null, $comparison = null)
    {
        if (is_array($registrantId)) {
            $useMinMax = false;
            if (isset($registrantId['min'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $registrantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrantId['max'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $registrantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $registrantId, $comparison);
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
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByInstitution($institution = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($institution)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_INSTITUTION, $institution, $comparison);
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
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterBySurname($surname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_SURNAME, $surname, $comparison);
    }

    /**
     * Filter the query on the tel column
     *
     * Example usage:
     * <code>
     * $query->filterByTel('fooValue');   // WHERE tel = 'fooValue'
     * $query->filterByTel('%fooValue%', Criteria::LIKE); // WHERE tel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByTel($tel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_TEL, $tel, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry(1234); // WHERE country = 1234
     * $query->filterByCountry(array(12, 34)); // WHERE country IN (12, 34)
     * $query->filterByCountry(array('min' => 12)); // WHERE country > 12
     * </code>
     *
     * @see       filterByCountriesRelatedByCountry()
     *
     * @param     mixed $country The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (is_array($country)) {
            $useMinMax = false;
            if (isset($country['min'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_COUNTRY, $country['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($country['max'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_COUNTRY, $country['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the country_reserved column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryReserved(1234); // WHERE country_reserved = 1234
     * $query->filterByCountryReserved(array(12, 34)); // WHERE country_reserved IN (12, 34)
     * $query->filterByCountryReserved(array('min' => 12)); // WHERE country_reserved > 12
     * </code>
     *
     * @see       filterByCountriesRelatedByCountryReserved()
     *
     * @param     mixed $countryReserved The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByCountryReserved($countryReserved = null, $comparison = null)
    {
        if (is_array($countryReserved)) {
            $useMinMax = false;
            if (isset($countryReserved['min'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_COUNTRY_RESERVED, $countryReserved['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryReserved['max'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_COUNTRY_RESERVED, $countryReserved['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_COUNTRY_RESERVED, $countryReserved, $comparison);
    }

    /**
     * Filter the query on the last_update column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUpdate('2011-03-14'); // WHERE last_update = '2011-03-14'
     * $query->filterByLastUpdate('now'); // WHERE last_update = '2011-03-14'
     * $query->filterByLastUpdate(array('max' => 'yesterday')); // WHERE last_update > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastUpdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByLastUpdate($lastUpdate = null, $comparison = null)
    {
        if (is_array($lastUpdate)) {
            $useMinMax = false;
            if (isset($lastUpdate['min'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_LAST_UPDATE, $lastUpdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdate['max'])) {
                $this->addUsingAlias(RegistrantsTableMap::COL_LAST_UPDATE, $lastUpdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantsTableMap::COL_LAST_UPDATE, $lastUpdate, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Countries object
     *
     * @param \db\db\Countries|ObjectCollection $countries The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByCountriesRelatedByCountry($countries, $comparison = null)
    {
        if ($countries instanceof \db\db\Countries) {
            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_COUNTRY, $countries->getCountryId(), $comparison);
        } elseif ($countries instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_COUNTRY, $countries->toKeyValue('PrimaryKey', 'CountryId'), $comparison);
        } else {
            throw new PropelException('filterByCountriesRelatedByCountry() only accepts arguments of type \db\db\Countries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CountriesRelatedByCountry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function joinCountriesRelatedByCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CountriesRelatedByCountry');

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
            $this->addJoinObject($join, 'CountriesRelatedByCountry');
        }

        return $this;
    }

    /**
     * Use the CountriesRelatedByCountry relation Countries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\CountriesQuery A secondary query class using the current class as primary query
     */
    public function useCountriesRelatedByCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountriesRelatedByCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CountriesRelatedByCountry', '\db\db\CountriesQuery');
    }

    /**
     * Filter the query by a related \db\db\Countries object
     *
     * @param \db\db\Countries|ObjectCollection $countries The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByCountriesRelatedByCountryReserved($countries, $comparison = null)
    {
        if ($countries instanceof \db\db\Countries) {
            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_COUNTRY_RESERVED, $countries->getCountryId(), $comparison);
        } elseif ($countries instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_COUNTRY_RESERVED, $countries->toKeyValue('PrimaryKey', 'CountryId'), $comparison);
        } else {
            throw new PropelException('filterByCountriesRelatedByCountryReserved() only accepts arguments of type \db\db\Countries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CountriesRelatedByCountryReserved relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function joinCountriesRelatedByCountryReserved($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CountriesRelatedByCountryReserved');

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
            $this->addJoinObject($join, 'CountriesRelatedByCountryReserved');
        }

        return $this;
    }

    /**
     * Use the CountriesRelatedByCountryReserved relation Countries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\CountriesQuery A secondary query class using the current class as primary query
     */
    public function useCountriesRelatedByCountryReservedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCountriesRelatedByCountryReserved($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CountriesRelatedByCountryReserved', '\db\db\CountriesQuery');
    }

    /**
     * Filter the query by a related \db\db\RegistrantRoles object
     *
     * @param \db\db\RegistrantRoles|ObjectCollection $registrantRoles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByRegistrantRoles($registrantRoles, $comparison = null)
    {
        if ($registrantRoles instanceof \db\db\RegistrantRoles) {
            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $registrantRoles->getRegistrantId(), $comparison);
        } elseif ($registrantRoles instanceof ObjectCollection) {
            return $this
                ->useRegistrantRolesQuery()
                ->filterByPrimaryKeys($registrantRoles->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantRoles() only accepts arguments of type \db\db\RegistrantRoles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantRoles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function joinRegistrantRoles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantRoles');

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
            $this->addJoinObject($join, 'RegistrantRoles');
        }

        return $this;
    }

    /**
     * Use the RegistrantRoles relation RegistrantRoles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantRolesQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantRolesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantRoles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantRoles', '\db\db\RegistrantRolesQuery');
    }

    /**
     * Filter the query by a related \db\db\Students object
     *
     * @param \db\db\Students|ObjectCollection $students the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByStudents($students, $comparison = null)
    {
        if ($students instanceof \db\db\Students) {
            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $students->getRegistrantId(), $comparison);
        } elseif ($students instanceof ObjectCollection) {
            return $this
                ->useStudentsQuery()
                ->filterByPrimaryKeys($students->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStudents() only accepts arguments of type \db\db\Students or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Students relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function joinStudents($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Students');

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
            $this->addJoinObject($join, 'Students');
        }

        return $this;
    }

    /**
     * Use the Students relation Students object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\StudentsQuery A secondary query class using the current class as primary query
     */
    public function useStudentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStudents($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Students', '\db\db\StudentsQuery');
    }

    /**
     * Filter the query by a related \db\db\Teachers object
     *
     * @param \db\db\Teachers|ObjectCollection $teachers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegistrantsQuery The current query, for fluid interface
     */
    public function filterByTeachers($teachers, $comparison = null)
    {
        if ($teachers instanceof \db\db\Teachers) {
            return $this
                ->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $teachers->getRegistrantId(), $comparison);
        } elseif ($teachers instanceof ObjectCollection) {
            return $this
                ->useTeachersQuery()
                ->filterByPrimaryKeys($teachers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeachers() only accepts arguments of type \db\db\Teachers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teachers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function joinTeachers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teachers');

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
            $this->addJoinObject($join, 'Teachers');
        }

        return $this;
    }

    /**
     * Use the Teachers relation Teachers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\TeachersQuery A secondary query class using the current class as primary query
     */
    public function useTeachersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeachers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teachers', '\db\db\TeachersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRegistrants $registrants Object to remove from the list of results
     *
     * @return $this|ChildRegistrantsQuery The current query, for fluid interface
     */
    public function prune($registrants = null)
    {
        if ($registrants) {
            $this->addUsingAlias(RegistrantsTableMap::COL_REGISTRANT_ID, $registrants->getRegistrantId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registrants table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistrantsTableMap::clearInstancePool();
            RegistrantsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistrantsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistrantsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistrantsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RegistrantsQuery
