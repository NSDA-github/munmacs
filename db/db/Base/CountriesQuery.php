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
use db\db\Countries as ChildCountries;
use db\db\CountriesQuery as ChildCountriesQuery;
use db\db\Map\CountriesTableMap;

/**
 * Base class that represents a query for the 'countries' table.
 *
 *
 *
 * @method     ChildCountriesQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildCountriesQuery orderByCountryName($order = Criteria::ASC) Order by the country_name column
 * @method     ChildCountriesQuery orderByAvailable($order = Criteria::ASC) Order by the available column
 * @method     ChildCountriesQuery orderByReserved($order = Criteria::ASC) Order by the reserved column
 *
 * @method     ChildCountriesQuery groupByCountryId() Group by the country_id column
 * @method     ChildCountriesQuery groupByCountryName() Group by the country_name column
 * @method     ChildCountriesQuery groupByAvailable() Group by the available column
 * @method     ChildCountriesQuery groupByReserved() Group by the reserved column
 *
 * @method     ChildCountriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCountriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCountriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCountriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCountriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCountriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCountriesQuery leftJoinRegistrantsRelatedByCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantsRelatedByCountry relation
 * @method     ChildCountriesQuery rightJoinRegistrantsRelatedByCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantsRelatedByCountry relation
 * @method     ChildCountriesQuery innerJoinRegistrantsRelatedByCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantsRelatedByCountry relation
 *
 * @method     ChildCountriesQuery joinWithRegistrantsRelatedByCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantsRelatedByCountry relation
 *
 * @method     ChildCountriesQuery leftJoinWithRegistrantsRelatedByCountry() Adds a LEFT JOIN clause and with to the query using the RegistrantsRelatedByCountry relation
 * @method     ChildCountriesQuery rightJoinWithRegistrantsRelatedByCountry() Adds a RIGHT JOIN clause and with to the query using the RegistrantsRelatedByCountry relation
 * @method     ChildCountriesQuery innerJoinWithRegistrantsRelatedByCountry() Adds a INNER JOIN clause and with to the query using the RegistrantsRelatedByCountry relation
 *
 * @method     ChildCountriesQuery leftJoinRegistrantsRelatedByCountryReserved($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantsRelatedByCountryReserved relation
 * @method     ChildCountriesQuery rightJoinRegistrantsRelatedByCountryReserved($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantsRelatedByCountryReserved relation
 * @method     ChildCountriesQuery innerJoinRegistrantsRelatedByCountryReserved($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantsRelatedByCountryReserved relation
 *
 * @method     ChildCountriesQuery joinWithRegistrantsRelatedByCountryReserved($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantsRelatedByCountryReserved relation
 *
 * @method     ChildCountriesQuery leftJoinWithRegistrantsRelatedByCountryReserved() Adds a LEFT JOIN clause and with to the query using the RegistrantsRelatedByCountryReserved relation
 * @method     ChildCountriesQuery rightJoinWithRegistrantsRelatedByCountryReserved() Adds a RIGHT JOIN clause and with to the query using the RegistrantsRelatedByCountryReserved relation
 * @method     ChildCountriesQuery innerJoinWithRegistrantsRelatedByCountryReserved() Adds a INNER JOIN clause and with to the query using the RegistrantsRelatedByCountryReserved relation
 *
 * @method     \db\db\RegistrantsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCountries findOne(ConnectionInterface $con = null) Return the first ChildCountries matching the query
 * @method     ChildCountries findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCountries matching the query, or a new ChildCountries object populated from the query conditions when no match is found
 *
 * @method     ChildCountries findOneByCountryId(int $country_id) Return the first ChildCountries filtered by the country_id column
 * @method     ChildCountries findOneByCountryName(string $country_name) Return the first ChildCountries filtered by the country_name column
 * @method     ChildCountries findOneByAvailable(boolean $available) Return the first ChildCountries filtered by the available column
 * @method     ChildCountries findOneByReserved(boolean $reserved) Return the first ChildCountries filtered by the reserved column *

 * @method     ChildCountries requirePk($key, ConnectionInterface $con = null) Return the ChildCountries by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOne(ConnectionInterface $con = null) Return the first ChildCountries matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountries requireOneByCountryId(int $country_id) Return the first ChildCountries filtered by the country_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByCountryName(string $country_name) Return the first ChildCountries filtered by the country_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByAvailable(boolean $available) Return the first ChildCountries filtered by the available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByReserved(boolean $reserved) Return the first ChildCountries filtered by the reserved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountries[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCountries objects based on current ModelCriteria
 * @method     ChildCountries[]|ObjectCollection findByCountryId(int $country_id) Return ChildCountries objects filtered by the country_id column
 * @method     ChildCountries[]|ObjectCollection findByCountryName(string $country_name) Return ChildCountries objects filtered by the country_name column
 * @method     ChildCountries[]|ObjectCollection findByAvailable(boolean $available) Return ChildCountries objects filtered by the available column
 * @method     ChildCountries[]|ObjectCollection findByReserved(boolean $reserved) Return ChildCountries objects filtered by the reserved column
 * @method     ChildCountries[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CountriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\CountriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\Countries', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCountriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCountriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCountriesQuery) {
            return $criteria;
        }
        $query = new ChildCountriesQuery();
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
     * @return ChildCountries|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CountriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CountriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCountries A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT country_id, country_name, available, reserved FROM countries WHERE country_id = :p0';
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
            /** @var ChildCountries $obj */
            $obj = new ChildCountries();
            $obj->hydrate($row);
            CountriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCountries|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $keys, Criteria::IN);
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
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $countryId, $comparison);
    }

    /**
     * Filter the query on the country_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryName('fooValue');   // WHERE country_name = 'fooValue'
     * $query->filterByCountryName('%fooValue%', Criteria::LIKE); // WHERE country_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $countryName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByCountryName($countryName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countryName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_NAME, $countryName, $comparison);
    }

    /**
     * Filter the query on the available column
     *
     * Example usage:
     * <code>
     * $query->filterByAvailable(true); // WHERE available = true
     * $query->filterByAvailable('yes'); // WHERE available = true
     * </code>
     *
     * @param     boolean|string $available The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByAvailable($available = null, $comparison = null)
    {
        if (is_string($available)) {
            $available = in_array(strtolower($available), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CountriesTableMap::COL_AVAILABLE, $available, $comparison);
    }

    /**
     * Filter the query on the reserved column
     *
     * Example usage:
     * <code>
     * $query->filterByReserved(true); // WHERE reserved = true
     * $query->filterByReserved('yes'); // WHERE reserved = true
     * </code>
     *
     * @param     boolean|string $reserved The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByReserved($reserved = null, $comparison = null)
    {
        if (is_string($reserved)) {
            $reserved = in_array(strtolower($reserved), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CountriesTableMap::COL_RESERVED, $reserved, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Registrants object
     *
     * @param \db\db\Registrants|ObjectCollection $registrants the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByRegistrantsRelatedByCountry($registrants, $comparison = null)
    {
        if ($registrants instanceof \db\db\Registrants) {
            return $this
                ->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $registrants->getCountry(), $comparison);
        } elseif ($registrants instanceof ObjectCollection) {
            return $this
                ->useRegistrantsRelatedByCountryQuery()
                ->filterByPrimaryKeys($registrants->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantsRelatedByCountry() only accepts arguments of type \db\db\Registrants or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantsRelatedByCountry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function joinRegistrantsRelatedByCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantsRelatedByCountry');

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
            $this->addJoinObject($join, 'RegistrantsRelatedByCountry');
        }

        return $this;
    }

    /**
     * Use the RegistrantsRelatedByCountry relation Registrants object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantsQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantsRelatedByCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrantsRelatedByCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantsRelatedByCountry', '\db\db\RegistrantsQuery');
    }

    /**
     * Filter the query by a related \db\db\Registrants object
     *
     * @param \db\db\Registrants|ObjectCollection $registrants the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByRegistrantsRelatedByCountryReserved($registrants, $comparison = null)
    {
        if ($registrants instanceof \db\db\Registrants) {
            return $this
                ->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $registrants->getCountryReserved(), $comparison);
        } elseif ($registrants instanceof ObjectCollection) {
            return $this
                ->useRegistrantsRelatedByCountryReservedQuery()
                ->filterByPrimaryKeys($registrants->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegistrantsRelatedByCountryReserved() only accepts arguments of type \db\db\Registrants or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegistrantsRelatedByCountryReserved relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function joinRegistrantsRelatedByCountryReserved($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegistrantsRelatedByCountryReserved');

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
            $this->addJoinObject($join, 'RegistrantsRelatedByCountryReserved');
        }

        return $this;
    }

    /**
     * Use the RegistrantsRelatedByCountryReserved relation Registrants object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantsQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantsRelatedByCountryReservedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegistrantsRelatedByCountryReserved($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegistrantsRelatedByCountryReserved', '\db\db\RegistrantsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCountries $countries Object to remove from the list of results
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function prune($countries = null)
    {
        if ($countries) {
            $this->addUsingAlias(CountriesTableMap::COL_COUNTRY_ID, $countries->getCountryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the countries table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CountriesTableMap::clearInstancePool();
            CountriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CountriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CountriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CountriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CountriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CountriesQuery
