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
use db\db\RegistrantRoles as ChildRegistrantRoles;
use db\db\RegistrantRolesQuery as ChildRegistrantRolesQuery;
use db\db\Map\RegistrantRolesTableMap;

/**
 * Base class that represents a query for the 'registrant_roles' table.
 *
 *
 *
 * @method     ChildRegistrantRolesQuery orderByRegistrantId($order = Criteria::ASC) Order by the registrant_id column
 * @method     ChildRegistrantRolesQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 *
 * @method     ChildRegistrantRolesQuery groupByRegistrantId() Group by the registrant_id column
 * @method     ChildRegistrantRolesQuery groupByRoleId() Group by the role_id column
 *
 * @method     ChildRegistrantRolesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistrantRolesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistrantRolesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistrantRolesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistrantRolesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistrantRolesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistrantRolesQuery leftJoinRegistrants($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registrants relation
 * @method     ChildRegistrantRolesQuery rightJoinRegistrants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registrants relation
 * @method     ChildRegistrantRolesQuery innerJoinRegistrants($relationAlias = null) Adds a INNER JOIN clause to the query using the Registrants relation
 *
 * @method     ChildRegistrantRolesQuery joinWithRegistrants($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registrants relation
 *
 * @method     ChildRegistrantRolesQuery leftJoinWithRegistrants() Adds a LEFT JOIN clause and with to the query using the Registrants relation
 * @method     ChildRegistrantRolesQuery rightJoinWithRegistrants() Adds a RIGHT JOIN clause and with to the query using the Registrants relation
 * @method     ChildRegistrantRolesQuery innerJoinWithRegistrants() Adds a INNER JOIN clause and with to the query using the Registrants relation
 *
 * @method     ChildRegistrantRolesQuery leftJoinRoles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Roles relation
 * @method     ChildRegistrantRolesQuery rightJoinRoles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Roles relation
 * @method     ChildRegistrantRolesQuery innerJoinRoles($relationAlias = null) Adds a INNER JOIN clause to the query using the Roles relation
 *
 * @method     ChildRegistrantRolesQuery joinWithRoles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Roles relation
 *
 * @method     ChildRegistrantRolesQuery leftJoinWithRoles() Adds a LEFT JOIN clause and with to the query using the Roles relation
 * @method     ChildRegistrantRolesQuery rightJoinWithRoles() Adds a RIGHT JOIN clause and with to the query using the Roles relation
 * @method     ChildRegistrantRolesQuery innerJoinWithRoles() Adds a INNER JOIN clause and with to the query using the Roles relation
 *
 * @method     \db\db\RegistrantsQuery|\db\db\RolesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistrantRoles findOne(ConnectionInterface $con = null) Return the first ChildRegistrantRoles matching the query
 * @method     ChildRegistrantRoles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRegistrantRoles matching the query, or a new ChildRegistrantRoles object populated from the query conditions when no match is found
 *
 * @method     ChildRegistrantRoles findOneByRegistrantId(int $registrant_id) Return the first ChildRegistrantRoles filtered by the registrant_id column
 * @method     ChildRegistrantRoles findOneByRoleId(int $role_id) Return the first ChildRegistrantRoles filtered by the role_id column *

 * @method     ChildRegistrantRoles requirePk($key, ConnectionInterface $con = null) Return the ChildRegistrantRoles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantRoles requireOne(ConnectionInterface $con = null) Return the first ChildRegistrantRoles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrantRoles requireOneByRegistrantId(int $registrant_id) Return the first ChildRegistrantRoles filtered by the registrant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantRoles requireOneByRoleId(int $role_id) Return the first ChildRegistrantRoles filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrantRoles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRegistrantRoles objects based on current ModelCriteria
 * @method     ChildRegistrantRoles[]|ObjectCollection findByRegistrantId(int $registrant_id) Return ChildRegistrantRoles objects filtered by the registrant_id column
 * @method     ChildRegistrantRoles[]|ObjectCollection findByRoleId(int $role_id) Return ChildRegistrantRoles objects filtered by the role_id column
 * @method     ChildRegistrantRoles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistrantRolesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\RegistrantRolesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\RegistrantRoles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistrantRolesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistrantRolesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRegistrantRolesQuery) {
            return $criteria;
        }
        $query = new ChildRegistrantRolesQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$registrant_id, $role_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRegistrantRoles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantRolesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistrantRolesTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildRegistrantRoles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registrant_id, role_id FROM registrant_roles WHERE registrant_id = :p0 AND role_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRegistrantRoles $obj */
            $obj = new ChildRegistrantRoles();
            $obj->hydrate($row);
            RegistrantRolesTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildRegistrantRoles|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(RegistrantRolesTableMap::COL_REGISTRANT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RegistrantRolesTableMap::COL_ROLE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RegistrantRolesTableMap::COL_REGISTRANT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RegistrantRolesTableMap::COL_ROLE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByRegistrants()
     *
     * @param     mixed $registrantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function filterByRegistrantId($registrantId = null, $comparison = null)
    {
        if (is_array($registrantId)) {
            $useMinMax = false;
            if (isset($registrantId['min'])) {
                $this->addUsingAlias(RegistrantRolesTableMap::COL_REGISTRANT_ID, $registrantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrantId['max'])) {
                $this->addUsingAlias(RegistrantRolesTableMap::COL_REGISTRANT_ID, $registrantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantRolesTableMap::COL_REGISTRANT_ID, $registrantId, $comparison);
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
     * @see       filterByRoles()
     *
     * @param     mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(RegistrantRolesTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(RegistrantRolesTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantRolesTableMap::COL_ROLE_ID, $roleId, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Registrants object
     *
     * @param \db\db\Registrants|ObjectCollection $registrants The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function filterByRegistrants($registrants, $comparison = null)
    {
        if ($registrants instanceof \db\db\Registrants) {
            return $this
                ->addUsingAlias(RegistrantRolesTableMap::COL_REGISTRANT_ID, $registrants->getRegistrantId(), $comparison);
        } elseif ($registrants instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantRolesTableMap::COL_REGISTRANT_ID, $registrants->toKeyValue('PrimaryKey', 'RegistrantId'), $comparison);
        } else {
            throw new PropelException('filterByRegistrants() only accepts arguments of type \db\db\Registrants or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Registrants relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function joinRegistrants($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Registrants');

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
            $this->addJoinObject($join, 'Registrants');
        }

        return $this;
    }

    /**
     * Use the Registrants relation Registrants object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RegistrantsQuery A secondary query class using the current class as primary query
     */
    public function useRegistrantsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegistrants($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Registrants', '\db\db\RegistrantsQuery');
    }

    /**
     * Filter the query by a related \db\db\Roles object
     *
     * @param \db\db\Roles|ObjectCollection $roles The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function filterByRoles($roles, $comparison = null)
    {
        if ($roles instanceof \db\db\Roles) {
            return $this
                ->addUsingAlias(RegistrantRolesTableMap::COL_ROLE_ID, $roles->getRoleId(), $comparison);
        } elseif ($roles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantRolesTableMap::COL_ROLE_ID, $roles->toKeyValue('PrimaryKey', 'RoleId'), $comparison);
        } else {
            throw new PropelException('filterByRoles() only accepts arguments of type \db\db\Roles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Roles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function joinRoles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Roles');

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
            $this->addJoinObject($join, 'Roles');
        }

        return $this;
    }

    /**
     * Use the Roles relation Roles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\RolesQuery A secondary query class using the current class as primary query
     */
    public function useRolesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRoles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Roles', '\db\db\RolesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRegistrantRoles $registrantRoles Object to remove from the list of results
     *
     * @return $this|ChildRegistrantRolesQuery The current query, for fluid interface
     */
    public function prune($registrantRoles = null)
    {
        if ($registrantRoles) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RegistrantRolesTableMap::COL_REGISTRANT_ID), $registrantRoles->getRegistrantId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RegistrantRolesTableMap::COL_ROLE_ID), $registrantRoles->getRoleId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registrant_roles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantRolesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistrantRolesTableMap::clearInstancePool();
            RegistrantRolesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantRolesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistrantRolesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistrantRolesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistrantRolesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RegistrantRolesQuery
