<?php

namespace db\db\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use db\db\EditHistoryVerification as ChildEditHistoryVerification;
use db\db\EditHistoryVerificationQuery as ChildEditHistoryVerificationQuery;
use db\db\Map\EditHistoryVerificationTableMap;

/**
 * Base class that represents a query for the 'edit_history_verification' table.
 *
 *
 *
 * @method     ChildEditHistoryVerificationQuery orderByEditId($order = Criteria::ASC) Order by the edit_id column
 * @method     ChildEditHistoryVerificationQuery orderByEditSubject($order = Criteria::ASC) Order by the edit_subject column
 * @method     ChildEditHistoryVerificationQuery orderByWhoEdited($order = Criteria::ASC) Order by the who_edited column
 * @method     ChildEditHistoryVerificationQuery orderByWhomEdited($order = Criteria::ASC) Order by the whom_edited column
 * @method     ChildEditHistoryVerificationQuery orderByEditDatetime($order = Criteria::ASC) Order by the edit_datetime column
 * @method     ChildEditHistoryVerificationQuery orderByEditedFrom($order = Criteria::ASC) Order by the edited_from column
 * @method     ChildEditHistoryVerificationQuery orderByEditedTo($order = Criteria::ASC) Order by the edited_to column
 *
 * @method     ChildEditHistoryVerificationQuery groupByEditId() Group by the edit_id column
 * @method     ChildEditHistoryVerificationQuery groupByEditSubject() Group by the edit_subject column
 * @method     ChildEditHistoryVerificationQuery groupByWhoEdited() Group by the who_edited column
 * @method     ChildEditHistoryVerificationQuery groupByWhomEdited() Group by the whom_edited column
 * @method     ChildEditHistoryVerificationQuery groupByEditDatetime() Group by the edit_datetime column
 * @method     ChildEditHistoryVerificationQuery groupByEditedFrom() Group by the edited_from column
 * @method     ChildEditHistoryVerificationQuery groupByEditedTo() Group by the edited_to column
 *
 * @method     ChildEditHistoryVerificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEditHistoryVerificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEditHistoryVerificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEditHistoryVerificationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEditHistoryVerificationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEditHistoryVerificationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEditHistoryVerification findOne(ConnectionInterface $con = null) Return the first ChildEditHistoryVerification matching the query
 * @method     ChildEditHistoryVerification findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEditHistoryVerification matching the query, or a new ChildEditHistoryVerification object populated from the query conditions when no match is found
 *
 * @method     ChildEditHistoryVerification findOneByEditId(int $edit_id) Return the first ChildEditHistoryVerification filtered by the edit_id column
 * @method     ChildEditHistoryVerification findOneByEditSubject(string $edit_subject) Return the first ChildEditHistoryVerification filtered by the edit_subject column
 * @method     ChildEditHistoryVerification findOneByWhoEdited(int $who_edited) Return the first ChildEditHistoryVerification filtered by the who_edited column
 * @method     ChildEditHistoryVerification findOneByWhomEdited(int $whom_edited) Return the first ChildEditHistoryVerification filtered by the whom_edited column
 * @method     ChildEditHistoryVerification findOneByEditDatetime(string $edit_datetime) Return the first ChildEditHistoryVerification filtered by the edit_datetime column
 * @method     ChildEditHistoryVerification findOneByEditedFrom(boolean $edited_from) Return the first ChildEditHistoryVerification filtered by the edited_from column
 * @method     ChildEditHistoryVerification findOneByEditedTo(boolean $edited_to) Return the first ChildEditHistoryVerification filtered by the edited_to column *

 * @method     ChildEditHistoryVerification requirePk($key, ConnectionInterface $con = null) Return the ChildEditHistoryVerification by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOne(ConnectionInterface $con = null) Return the first ChildEditHistoryVerification matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEditHistoryVerification requireOneByEditId(int $edit_id) Return the first ChildEditHistoryVerification filtered by the edit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOneByEditSubject(string $edit_subject) Return the first ChildEditHistoryVerification filtered by the edit_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOneByWhoEdited(int $who_edited) Return the first ChildEditHistoryVerification filtered by the who_edited column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOneByWhomEdited(int $whom_edited) Return the first ChildEditHistoryVerification filtered by the whom_edited column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOneByEditDatetime(string $edit_datetime) Return the first ChildEditHistoryVerification filtered by the edit_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOneByEditedFrom(boolean $edited_from) Return the first ChildEditHistoryVerification filtered by the edited_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEditHistoryVerification requireOneByEditedTo(boolean $edited_to) Return the first ChildEditHistoryVerification filtered by the edited_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEditHistoryVerification[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEditHistoryVerification objects based on current ModelCriteria
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByEditId(int $edit_id) Return ChildEditHistoryVerification objects filtered by the edit_id column
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByEditSubject(string $edit_subject) Return ChildEditHistoryVerification objects filtered by the edit_subject column
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByWhoEdited(int $who_edited) Return ChildEditHistoryVerification objects filtered by the who_edited column
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByWhomEdited(int $whom_edited) Return ChildEditHistoryVerification objects filtered by the whom_edited column
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByEditDatetime(string $edit_datetime) Return ChildEditHistoryVerification objects filtered by the edit_datetime column
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByEditedFrom(boolean $edited_from) Return ChildEditHistoryVerification objects filtered by the edited_from column
 * @method     ChildEditHistoryVerification[]|ObjectCollection findByEditedTo(boolean $edited_to) Return ChildEditHistoryVerification objects filtered by the edited_to column
 * @method     ChildEditHistoryVerification[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EditHistoryVerificationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\EditHistoryVerificationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\EditHistoryVerification', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEditHistoryVerificationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEditHistoryVerificationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEditHistoryVerificationQuery) {
            return $criteria;
        }
        $query = new ChildEditHistoryVerificationQuery();
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
     * @return ChildEditHistoryVerification|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EditHistoryVerificationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EditHistoryVerificationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEditHistoryVerification A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT edit_id, edit_subject, who_edited, whom_edited, edit_datetime, edited_from, edited_to FROM edit_history_verification WHERE edit_id = :p0';
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
            /** @var ChildEditHistoryVerification $obj */
            $obj = new ChildEditHistoryVerification();
            $obj->hydrate($row);
            EditHistoryVerificationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEditHistoryVerification|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the edit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEditId(1234); // WHERE edit_id = 1234
     * $query->filterByEditId(array(12, 34)); // WHERE edit_id IN (12, 34)
     * $query->filterByEditId(array('min' => 12)); // WHERE edit_id > 12
     * </code>
     *
     * @param     mixed $editId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByEditId($editId = null, $comparison = null)
    {
        if (is_array($editId)) {
            $useMinMax = false;
            if (isset($editId['min'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_ID, $editId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editId['max'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_ID, $editId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_ID, $editId, $comparison);
    }

    /**
     * Filter the query on the edit_subject column
     *
     * Example usage:
     * <code>
     * $query->filterByEditSubject('fooValue');   // WHERE edit_subject = 'fooValue'
     * $query->filterByEditSubject('%fooValue%', Criteria::LIKE); // WHERE edit_subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $editSubject The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByEditSubject($editSubject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($editSubject)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_SUBJECT, $editSubject, $comparison);
    }

    /**
     * Filter the query on the who_edited column
     *
     * Example usage:
     * <code>
     * $query->filterByWhoEdited(1234); // WHERE who_edited = 1234
     * $query->filterByWhoEdited(array(12, 34)); // WHERE who_edited IN (12, 34)
     * $query->filterByWhoEdited(array('min' => 12)); // WHERE who_edited > 12
     * </code>
     *
     * @param     mixed $whoEdited The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByWhoEdited($whoEdited = null, $comparison = null)
    {
        if (is_array($whoEdited)) {
            $useMinMax = false;
            if (isset($whoEdited['min'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_WHO_EDITED, $whoEdited['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($whoEdited['max'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_WHO_EDITED, $whoEdited['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_WHO_EDITED, $whoEdited, $comparison);
    }

    /**
     * Filter the query on the whom_edited column
     *
     * Example usage:
     * <code>
     * $query->filterByWhomEdited(1234); // WHERE whom_edited = 1234
     * $query->filterByWhomEdited(array(12, 34)); // WHERE whom_edited IN (12, 34)
     * $query->filterByWhomEdited(array('min' => 12)); // WHERE whom_edited > 12
     * </code>
     *
     * @param     mixed $whomEdited The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByWhomEdited($whomEdited = null, $comparison = null)
    {
        if (is_array($whomEdited)) {
            $useMinMax = false;
            if (isset($whomEdited['min'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_WHOM_EDITED, $whomEdited['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($whomEdited['max'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_WHOM_EDITED, $whomEdited['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_WHOM_EDITED, $whomEdited, $comparison);
    }

    /**
     * Filter the query on the edit_datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByEditDatetime('2011-03-14'); // WHERE edit_datetime = '2011-03-14'
     * $query->filterByEditDatetime('now'); // WHERE edit_datetime = '2011-03-14'
     * $query->filterByEditDatetime(array('max' => 'yesterday')); // WHERE edit_datetime > '2011-03-13'
     * </code>
     *
     * @param     mixed $editDatetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByEditDatetime($editDatetime = null, $comparison = null)
    {
        if (is_array($editDatetime)) {
            $useMinMax = false;
            if (isset($editDatetime['min'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_DATETIME, $editDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDatetime['max'])) {
                $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_DATETIME, $editDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_DATETIME, $editDatetime, $comparison);
    }

    /**
     * Filter the query on the edited_from column
     *
     * Example usage:
     * <code>
     * $query->filterByEditedFrom(true); // WHERE edited_from = true
     * $query->filterByEditedFrom('yes'); // WHERE edited_from = true
     * </code>
     *
     * @param     boolean|string $editedFrom The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByEditedFrom($editedFrom = null, $comparison = null)
    {
        if (is_string($editedFrom)) {
            $editedFrom = in_array(strtolower($editedFrom), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDITED_FROM, $editedFrom, $comparison);
    }

    /**
     * Filter the query on the edited_to column
     *
     * Example usage:
     * <code>
     * $query->filterByEditedTo(true); // WHERE edited_to = true
     * $query->filterByEditedTo('yes'); // WHERE edited_to = true
     * </code>
     *
     * @param     boolean|string $editedTo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function filterByEditedTo($editedTo = null, $comparison = null)
    {
        if (is_string($editedTo)) {
            $editedTo = in_array(strtolower($editedTo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDITED_TO, $editedTo, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEditHistoryVerification $editHistoryVerification Object to remove from the list of results
     *
     * @return $this|ChildEditHistoryVerificationQuery The current query, for fluid interface
     */
    public function prune($editHistoryVerification = null)
    {
        if ($editHistoryVerification) {
            $this->addUsingAlias(EditHistoryVerificationTableMap::COL_EDIT_ID, $editHistoryVerification->getEditId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the edit_history_verification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EditHistoryVerificationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EditHistoryVerificationTableMap::clearInstancePool();
            EditHistoryVerificationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EditHistoryVerificationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EditHistoryVerificationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EditHistoryVerificationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EditHistoryVerificationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EditHistoryVerificationQuery
