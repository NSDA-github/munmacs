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
use db\db\Teachers as ChildTeachers;
use db\db\TeachersQuery as ChildTeachersQuery;
use db\db\Map\TeachersTableMap;

/**
 * Base class that represents a query for the 'teachers' table.
 *
 *
 *
 * @method     ChildTeachersQuery orderByRegistrantId($order = Criteria::ASC) Order by the registrant_id column
 * @method     ChildTeachersQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 *
 * @method     ChildTeachersQuery groupByRegistrantId() Group by the registrant_id column
 * @method     ChildTeachersQuery groupBySubject() Group by the subject column
 *
 * @method     ChildTeachersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTeachersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTeachersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTeachersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTeachersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTeachersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTeachersQuery leftJoinRegistrants($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registrants relation
 * @method     ChildTeachersQuery rightJoinRegistrants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registrants relation
 * @method     ChildTeachersQuery innerJoinRegistrants($relationAlias = null) Adds a INNER JOIN clause to the query using the Registrants relation
 *
 * @method     ChildTeachersQuery joinWithRegistrants($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registrants relation
 *
 * @method     ChildTeachersQuery leftJoinWithRegistrants() Adds a LEFT JOIN clause and with to the query using the Registrants relation
 * @method     ChildTeachersQuery rightJoinWithRegistrants() Adds a RIGHT JOIN clause and with to the query using the Registrants relation
 * @method     ChildTeachersQuery innerJoinWithRegistrants() Adds a INNER JOIN clause and with to the query using the Registrants relation
 *
 * @method     \db\db\RegistrantsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTeachers findOne(ConnectionInterface $con = null) Return the first ChildTeachers matching the query
 * @method     ChildTeachers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTeachers matching the query, or a new ChildTeachers object populated from the query conditions when no match is found
 *
 * @method     ChildTeachers findOneByRegistrantId(int $registrant_id) Return the first ChildTeachers filtered by the registrant_id column
 * @method     ChildTeachers findOneBySubject(string $subject) Return the first ChildTeachers filtered by the subject column *

 * @method     ChildTeachers requirePk($key, ConnectionInterface $con = null) Return the ChildTeachers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTeachers requireOne(ConnectionInterface $con = null) Return the first ChildTeachers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTeachers requireOneByRegistrantId(int $registrant_id) Return the first ChildTeachers filtered by the registrant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTeachers requireOneBySubject(string $subject) Return the first ChildTeachers filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTeachers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTeachers objects based on current ModelCriteria
 * @method     ChildTeachers[]|ObjectCollection findByRegistrantId(int $registrant_id) Return ChildTeachers objects filtered by the registrant_id column
 * @method     ChildTeachers[]|ObjectCollection findBySubject(string $subject) Return ChildTeachers objects filtered by the subject column
 * @method     ChildTeachers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TeachersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\TeachersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\Teachers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTeachersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTeachersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTeachersQuery) {
            return $criteria;
        }
        $query = new ChildTeachersQuery();
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
     * @return ChildTeachers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TeachersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TeachersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTeachers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registrant_id, subject FROM teachers WHERE registrant_id = :p0';
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
            /** @var ChildTeachers $obj */
            $obj = new ChildTeachers();
            $obj->hydrate($row);
            TeachersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTeachers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTeachersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTeachersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTeachersQuery The current query, for fluid interface
     */
    public function filterByRegistrantId($registrantId = null, $comparison = null)
    {
        if (is_array($registrantId)) {
            $useMinMax = false;
            if (isset($registrantId['min'])) {
                $this->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $registrantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrantId['max'])) {
                $this->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $registrantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $registrantId, $comparison);
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTeachersQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeachersTableMap::COL_SUBJECT, $subject, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Registrants object
     *
     * @param \db\db\Registrants|ObjectCollection $registrants The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTeachersQuery The current query, for fluid interface
     */
    public function filterByRegistrants($registrants, $comparison = null)
    {
        if ($registrants instanceof \db\db\Registrants) {
            return $this
                ->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $registrants->getRegistrantId(), $comparison);
        } elseif ($registrants instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $registrants->toKeyValue('PrimaryKey', 'RegistrantId'), $comparison);
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
     * @return $this|ChildTeachersQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildTeachers $teachers Object to remove from the list of results
     *
     * @return $this|ChildTeachersQuery The current query, for fluid interface
     */
    public function prune($teachers = null)
    {
        if ($teachers) {
            $this->addUsingAlias(TeachersTableMap::COL_REGISTRANT_ID, $teachers->getRegistrantId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the teachers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TeachersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TeachersTableMap::clearInstancePool();
            TeachersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TeachersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TeachersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TeachersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TeachersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TeachersQuery
