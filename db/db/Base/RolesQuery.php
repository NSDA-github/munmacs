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
use db\db\Roles as ChildRoles;
use db\db\RolesQuery as ChildRolesQuery;
use db\db\Map\RolesTableMap;

/**
 * Base class that represents a query for the 'roles' table.
 *
 *
 *
 * @method     ChildRolesQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildRolesQuery orderByRoleName($order = Criteria::ASC) Order by the role_name column
 *
 * @method     ChildRolesQuery groupByRoleId() Group by the role_id column
 * @method     ChildRolesQuery groupByRoleName() Group by the role_name column
 *
 * @method     ChildRolesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRolesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRolesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRolesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRolesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRolesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRolesQuery leftJoinRegistrantRoles($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantRoles relation
 * @method     ChildRolesQuery rightJoinRegistrantRoles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantRoles relation
 * @method     ChildRolesQuery innerJoinRegistrantRoles($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantRoles relation
 *
 * @method     ChildRolesQuery joinWithRegistrantRoles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantRoles relation
 *
 * @method     ChildRolesQuery leftJoinWithRegistrantRoles() Adds a LEFT JOIN clause and with to the query using the RegistrantRoles relation
 * @method     ChildRolesQuery rightJoinWithRegistrantRoles() Adds a RIGHT JOIN clause and with to the query using the RegistrantRoles relation
 * @method     ChildRolesQuery innerJoinWithRegistrantRoles() Adds a INNER JOIN clause and with to the query using the RegistrantRoles relation
 *
 * @method     \db\db\RegistrantRolesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRoles findOne(ConnectionInterface $con = null) Return the first ChildRoles matching the query
 * @method     ChildRoles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRoles matching the query, or a new ChildRoles object populated from the query conditions when no match is found
 *
 * @method     ChildRoles findOneByRoleId(int $role_id) Return the first ChildRoles filtered by the role_id column
 * @method     ChildRoles findOneByRoleName(string $role_name) Return the first ChildRoles filtered by the role_name column *

 * @method     ChildRoles requirePk($key, ConnectionInterface $con = null) Return the ChildRoles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOne(ConnectionInterface $con = null) Return the first ChildRoles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRoles requireOneByRoleId(int $role_id) Return the first ChildRoles filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOneByRoleName(string $role_name) Return the first ChildRoles filtered by the role_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRoles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRoles objects based on current ModelCriteria
 * @method     ChildRoles[]|ObjectCollection findByRoleId(int $role_id) Return ChildRoles objects filtered by the role_id column
 * @method     ChildRoles[]|ObjectCollection findByRoleName(string $role_name) Return ChildRoles objects filtered by the role_name column
 * @method     ChildRoles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RolesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\RolesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\Roles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRolesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRolesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRolesQuery) {
            return $criteria;
        }
        $query = new ChildRolesQuery();
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
     * @return ChildRoles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RolesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RolesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRoles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT role_id, role_name FROM roles WHERE role_id = :p0';
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
            /** @var ChildRoles $obj */
            $obj = new ChildRoles();
            $obj->hydrate($row);
            RolesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRoles|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRolesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRolesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @param     mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRolesQuery The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roleId, $comparison);
    }

    /**
     * Filter the query on the role_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleName('fooValue');   // WHERE role_name = 'fooValue'
     * $query->filterByRoleName('%fooValue%', Criteria::LIKE); // WHERE role_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $roleName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRolesQuery The current query, for fluid interface
     */
    public function filterByRoleName($roleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($roleName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RolesTableMap::COL_ROLE_NAME, $roleName, $comparison);
    }

    /**
     * Filter the query by a related \db\db\RegistrantRoles object
     *
     * @param \db\db\RegistrantRoles|ObjectCollection $registrantRoles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRolesQuery The current query, for fluid interface
     */
    public function filterByRegistrantRoles($registrantRoles, $comparison = null)
    {
        if ($registrantRoles instanceof \db\db\RegistrantRoles) {
            return $this
                ->addUsingAlias(RolesTableMap::COL_ROLE_ID, $registrantRoles->getRoleId(), $comparison);
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
     * @return $this|ChildRolesQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildRoles $roles Object to remove from the list of results
     *
     * @return $this|ChildRolesQuery The current query, for fluid interface
     */
    public function prune($roles = null)
    {
        if ($roles) {
            $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roles->getRoleId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the roles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RolesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RolesTableMap::clearInstancePool();
            RolesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RolesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RolesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RolesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RolesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RolesQuery
