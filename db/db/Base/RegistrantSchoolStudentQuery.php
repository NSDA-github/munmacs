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
use db\db\RegistrantSchoolStudent as ChildRegistrantSchoolStudent;
use db\db\RegistrantSchoolStudentQuery as ChildRegistrantSchoolStudentQuery;
use db\db\Map\RegistrantSchoolStudentTableMap;

/**
 * Base class that represents a query for the 'registrant_school_student' table.
 *
 *
 *
 * @method     ChildRegistrantSchoolStudentQuery orderByRegistrantId($order = Criteria::ASC) Order by the registrant_id column
 * @method     ChildRegistrantSchoolStudentQuery orderByGrade($order = Criteria::ASC) Order by the grade column
 * @method     ChildRegistrantSchoolStudentQuery orderByGradeLetter($order = Criteria::ASC) Order by the grade_letter column
 *
 * @method     ChildRegistrantSchoolStudentQuery groupByRegistrantId() Group by the registrant_id column
 * @method     ChildRegistrantSchoolStudentQuery groupByGrade() Group by the grade column
 * @method     ChildRegistrantSchoolStudentQuery groupByGradeLetter() Group by the grade_letter column
 *
 * @method     ChildRegistrantSchoolStudentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegistrantSchoolStudentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegistrantSchoolStudentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegistrantSchoolStudentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegistrantSchoolStudentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegistrantSchoolStudentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegistrantSchoolStudentQuery leftJoinRegistrant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Registrant relation
 * @method     ChildRegistrantSchoolStudentQuery rightJoinRegistrant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Registrant relation
 * @method     ChildRegistrantSchoolStudentQuery innerJoinRegistrant($relationAlias = null) Adds a INNER JOIN clause to the query using the Registrant relation
 *
 * @method     ChildRegistrantSchoolStudentQuery joinWithRegistrant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Registrant relation
 *
 * @method     ChildRegistrantSchoolStudentQuery leftJoinWithRegistrant() Adds a LEFT JOIN clause and with to the query using the Registrant relation
 * @method     ChildRegistrantSchoolStudentQuery rightJoinWithRegistrant() Adds a RIGHT JOIN clause and with to the query using the Registrant relation
 * @method     ChildRegistrantSchoolStudentQuery innerJoinWithRegistrant() Adds a INNER JOIN clause and with to the query using the Registrant relation
 *
 * @method     \db\db\RegistrantQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegistrantSchoolStudent findOne(ConnectionInterface $con = null) Return the first ChildRegistrantSchoolStudent matching the query
 * @method     ChildRegistrantSchoolStudent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRegistrantSchoolStudent matching the query, or a new ChildRegistrantSchoolStudent object populated from the query conditions when no match is found
 *
 * @method     ChildRegistrantSchoolStudent findOneByRegistrantId(int $registrant_id) Return the first ChildRegistrantSchoolStudent filtered by the registrant_id column
 * @method     ChildRegistrantSchoolStudent findOneByGrade(int $grade) Return the first ChildRegistrantSchoolStudent filtered by the grade column
 * @method     ChildRegistrantSchoolStudent findOneByGradeLetter(string $grade_letter) Return the first ChildRegistrantSchoolStudent filtered by the grade_letter column *

 * @method     ChildRegistrantSchoolStudent requirePk($key, ConnectionInterface $con = null) Return the ChildRegistrantSchoolStudent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantSchoolStudent requireOne(ConnectionInterface $con = null) Return the first ChildRegistrantSchoolStudent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrantSchoolStudent requireOneByRegistrantId(int $registrant_id) Return the first ChildRegistrantSchoolStudent filtered by the registrant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantSchoolStudent requireOneByGrade(int $grade) Return the first ChildRegistrantSchoolStudent filtered by the grade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegistrantSchoolStudent requireOneByGradeLetter(string $grade_letter) Return the first ChildRegistrantSchoolStudent filtered by the grade_letter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegistrantSchoolStudent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRegistrantSchoolStudent objects based on current ModelCriteria
 * @method     ChildRegistrantSchoolStudent[]|ObjectCollection findByRegistrantId(int $registrant_id) Return ChildRegistrantSchoolStudent objects filtered by the registrant_id column
 * @method     ChildRegistrantSchoolStudent[]|ObjectCollection findByGrade(int $grade) Return ChildRegistrantSchoolStudent objects filtered by the grade column
 * @method     ChildRegistrantSchoolStudent[]|ObjectCollection findByGradeLetter(string $grade_letter) Return ChildRegistrantSchoolStudent objects filtered by the grade_letter column
 * @method     ChildRegistrantSchoolStudent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegistrantSchoolStudentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\RegistrantSchoolStudentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\RegistrantSchoolStudent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegistrantSchoolStudentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegistrantSchoolStudentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRegistrantSchoolStudentQuery) {
            return $criteria;
        }
        $query = new ChildRegistrantSchoolStudentQuery();
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
     * @return ChildRegistrantSchoolStudent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantSchoolStudentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RegistrantSchoolStudentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRegistrantSchoolStudent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT registrant_id, grade, grade_letter FROM registrant_school_student WHERE registrant_id = :p0';
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
            /** @var ChildRegistrantSchoolStudent $obj */
            $obj = new ChildRegistrantSchoolStudent();
            $obj->hydrate($row);
            RegistrantSchoolStudentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRegistrantSchoolStudent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function filterByRegistrantId($registrantId = null, $comparison = null)
    {
        if (is_array($registrantId)) {
            $useMinMax = false;
            if (isset($registrantId['min'])) {
                $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $registrantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registrantId['max'])) {
                $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $registrantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $registrantId, $comparison);
    }

    /**
     * Filter the query on the grade column
     *
     * Example usage:
     * <code>
     * $query->filterByGrade(1234); // WHERE grade = 1234
     * $query->filterByGrade(array(12, 34)); // WHERE grade IN (12, 34)
     * $query->filterByGrade(array('min' => 12)); // WHERE grade > 12
     * </code>
     *
     * @param     mixed $grade The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function filterByGrade($grade = null, $comparison = null)
    {
        if (is_array($grade)) {
            $useMinMax = false;
            if (isset($grade['min'])) {
                $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_GRADE, $grade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grade['max'])) {
                $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_GRADE, $grade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_GRADE, $grade, $comparison);
    }

    /**
     * Filter the query on the grade_letter column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeLetter('fooValue');   // WHERE grade_letter = 'fooValue'
     * $query->filterByGradeLetter('%fooValue%', Criteria::LIKE); // WHERE grade_letter LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gradeLetter The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function filterByGradeLetter($gradeLetter = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gradeLetter)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_GRADE_LETTER, $gradeLetter, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Registrant object
     *
     * @param \db\db\Registrant|ObjectCollection $registrant The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function filterByRegistrant($registrant, $comparison = null)
    {
        if ($registrant instanceof \db\db\Registrant) {
            return $this
                ->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $registrant->getRegistrantId(), $comparison);
        } elseif ($registrant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $registrant->toKeyValue('PrimaryKey', 'RegistrantId'), $comparison);
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
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildRegistrantSchoolStudent $registrantSchoolStudent Object to remove from the list of results
     *
     * @return $this|ChildRegistrantSchoolStudentQuery The current query, for fluid interface
     */
    public function prune($registrantSchoolStudent = null)
    {
        if ($registrantSchoolStudent) {
            $this->addUsingAlias(RegistrantSchoolStudentTableMap::COL_REGISTRANT_ID, $registrantSchoolStudent->getRegistrantId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the registrant_school_student table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantSchoolStudentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegistrantSchoolStudentTableMap::clearInstancePool();
            RegistrantSchoolStudentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantSchoolStudentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegistrantSchoolStudentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegistrantSchoolStudentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegistrantSchoolStudentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RegistrantSchoolStudentQuery
