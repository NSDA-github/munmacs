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
use db\db\Topic as ChildTopic;
use db\db\TopicQuery as ChildTopicQuery;
use db\db\Map\TopicTableMap;

/**
 * Base class that represents a query for the 'topic' table.
 *
 *
 *
 * @method     ChildTopicQuery orderByTopicId($order = Criteria::ASC) Order by the topic_id column
 * @method     ChildTopicQuery orderByTopicName($order = Criteria::ASC) Order by the topic_name column
 * @method     ChildTopicQuery orderByMaxParticipants($order = Criteria::ASC) Order by the max_participants column
 * @method     ChildTopicQuery orderByCloseDate($order = Criteria::ASC) Order by the close_date column
 *
 * @method     ChildTopicQuery groupByTopicId() Group by the topic_id column
 * @method     ChildTopicQuery groupByTopicName() Group by the topic_name column
 * @method     ChildTopicQuery groupByMaxParticipants() Group by the max_participants column
 * @method     ChildTopicQuery groupByCloseDate() Group by the close_date column
 *
 * @method     ChildTopicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTopicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTopicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTopicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTopicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTopicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTopicQuery leftJoinRegistrantEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegistrantEvent relation
 * @method     ChildTopicQuery rightJoinRegistrantEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegistrantEvent relation
 * @method     ChildTopicQuery innerJoinRegistrantEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the RegistrantEvent relation
 *
 * @method     ChildTopicQuery joinWithRegistrantEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RegistrantEvent relation
 *
 * @method     ChildTopicQuery leftJoinWithRegistrantEvent() Adds a LEFT JOIN clause and with to the query using the RegistrantEvent relation
 * @method     ChildTopicQuery rightJoinWithRegistrantEvent() Adds a RIGHT JOIN clause and with to the query using the RegistrantEvent relation
 * @method     ChildTopicQuery innerJoinWithRegistrantEvent() Adds a INNER JOIN clause and with to the query using the RegistrantEvent relation
 *
 * @method     ChildTopicQuery leftJoinTopicCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the TopicCountry relation
 * @method     ChildTopicQuery rightJoinTopicCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TopicCountry relation
 * @method     ChildTopicQuery innerJoinTopicCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the TopicCountry relation
 *
 * @method     ChildTopicQuery joinWithTopicCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TopicCountry relation
 *
 * @method     ChildTopicQuery leftJoinWithTopicCountry() Adds a LEFT JOIN clause and with to the query using the TopicCountry relation
 * @method     ChildTopicQuery rightJoinWithTopicCountry() Adds a RIGHT JOIN clause and with to the query using the TopicCountry relation
 * @method     ChildTopicQuery innerJoinWithTopicCountry() Adds a INNER JOIN clause and with to the query using the TopicCountry relation
 *
 * @method     \db\db\RegistrantEventQuery|\db\db\TopicCountryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTopic findOne(ConnectionInterface $con = null) Return the first ChildTopic matching the query
 * @method     ChildTopic findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTopic matching the query, or a new ChildTopic object populated from the query conditions when no match is found
 *
 * @method     ChildTopic findOneByTopicId(int $topic_id) Return the first ChildTopic filtered by the topic_id column
 * @method     ChildTopic findOneByTopicName(string $topic_name) Return the first ChildTopic filtered by the topic_name column
 * @method     ChildTopic findOneByMaxParticipants(int $max_participants) Return the first ChildTopic filtered by the max_participants column
 * @method     ChildTopic findOneByCloseDate(string $close_date) Return the first ChildTopic filtered by the close_date column *

 * @method     ChildTopic requirePk($key, ConnectionInterface $con = null) Return the ChildTopic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopic requireOne(ConnectionInterface $con = null) Return the first ChildTopic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTopic requireOneByTopicId(int $topic_id) Return the first ChildTopic filtered by the topic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopic requireOneByTopicName(string $topic_name) Return the first ChildTopic filtered by the topic_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopic requireOneByMaxParticipants(int $max_participants) Return the first ChildTopic filtered by the max_participants column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopic requireOneByCloseDate(string $close_date) Return the first ChildTopic filtered by the close_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTopic[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTopic objects based on current ModelCriteria
 * @method     ChildTopic[]|ObjectCollection findByTopicId(int $topic_id) Return ChildTopic objects filtered by the topic_id column
 * @method     ChildTopic[]|ObjectCollection findByTopicName(string $topic_name) Return ChildTopic objects filtered by the topic_name column
 * @method     ChildTopic[]|ObjectCollection findByMaxParticipants(int $max_participants) Return ChildTopic objects filtered by the max_participants column
 * @method     ChildTopic[]|ObjectCollection findByCloseDate(string $close_date) Return ChildTopic objects filtered by the close_date column
 * @method     ChildTopic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TopicQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\TopicQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\Topic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTopicQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTopicQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTopicQuery) {
            return $criteria;
        }
        $query = new ChildTopicQuery();
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
     * @return ChildTopic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TopicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TopicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTopic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT topic_id, topic_name, max_participants, close_date FROM topic WHERE topic_id = :p0';
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
            /** @var ChildTopic $obj */
            $obj = new ChildTopic();
            $obj->hydrate($row);
            TopicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTopic|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $keys, Criteria::IN);
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
     * @param     mixed $topicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function filterByTopicId($topicId = null, $comparison = null)
    {
        if (is_array($topicId)) {
            $useMinMax = false;
            if (isset($topicId['min'])) {
                $this->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $topicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($topicId['max'])) {
                $this->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $topicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $topicId, $comparison);
    }

    /**
     * Filter the query on the topic_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicName('fooValue');   // WHERE topic_name = 'fooValue'
     * $query->filterByTopicName('%fooValue%', Criteria::LIKE); // WHERE topic_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $topicName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function filterByTopicName($topicName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($topicName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicTableMap::COL_TOPIC_NAME, $topicName, $comparison);
    }

    /**
     * Filter the query on the max_participants column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxParticipants(1234); // WHERE max_participants = 1234
     * $query->filterByMaxParticipants(array(12, 34)); // WHERE max_participants IN (12, 34)
     * $query->filterByMaxParticipants(array('min' => 12)); // WHERE max_participants > 12
     * </code>
     *
     * @param     mixed $maxParticipants The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function filterByMaxParticipants($maxParticipants = null, $comparison = null)
    {
        if (is_array($maxParticipants)) {
            $useMinMax = false;
            if (isset($maxParticipants['min'])) {
                $this->addUsingAlias(TopicTableMap::COL_MAX_PARTICIPANTS, $maxParticipants['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxParticipants['max'])) {
                $this->addUsingAlias(TopicTableMap::COL_MAX_PARTICIPANTS, $maxParticipants['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicTableMap::COL_MAX_PARTICIPANTS, $maxParticipants, $comparison);
    }

    /**
     * Filter the query on the close_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCloseDate('2011-03-14'); // WHERE close_date = '2011-03-14'
     * $query->filterByCloseDate('now'); // WHERE close_date = '2011-03-14'
     * $query->filterByCloseDate(array('max' => 'yesterday')); // WHERE close_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $closeDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function filterByCloseDate($closeDate = null, $comparison = null)
    {
        if (is_array($closeDate)) {
            $useMinMax = false;
            if (isset($closeDate['min'])) {
                $this->addUsingAlias(TopicTableMap::COL_CLOSE_DATE, $closeDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($closeDate['max'])) {
                $this->addUsingAlias(TopicTableMap::COL_CLOSE_DATE, $closeDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicTableMap::COL_CLOSE_DATE, $closeDate, $comparison);
    }

    /**
     * Filter the query by a related \db\db\RegistrantEvent object
     *
     * @param \db\db\RegistrantEvent|ObjectCollection $registrantEvent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTopicQuery The current query, for fluid interface
     */
    public function filterByRegistrantEvent($registrantEvent, $comparison = null)
    {
        if ($registrantEvent instanceof \db\db\RegistrantEvent) {
            return $this
                ->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $registrantEvent->getTopicId(), $comparison);
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
     * @return $this|ChildTopicQuery The current query, for fluid interface
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
     * Filter the query by a related \db\db\TopicCountry object
     *
     * @param \db\db\TopicCountry|ObjectCollection $topicCountry the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTopicQuery The current query, for fluid interface
     */
    public function filterByTopicCountry($topicCountry, $comparison = null)
    {
        if ($topicCountry instanceof \db\db\TopicCountry) {
            return $this
                ->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $topicCountry->getTopicId(), $comparison);
        } elseif ($topicCountry instanceof ObjectCollection) {
            return $this
                ->useTopicCountryQuery()
                ->filterByPrimaryKeys($topicCountry->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTopicCountry() only accepts arguments of type \db\db\TopicCountry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TopicCountry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function joinTopicCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TopicCountry');

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
            $this->addJoinObject($join, 'TopicCountry');
        }

        return $this;
    }

    /**
     * Use the TopicCountry relation TopicCountry object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\TopicCountryQuery A secondary query class using the current class as primary query
     */
    public function useTopicCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTopicCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TopicCountry', '\db\db\TopicCountryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTopic $topic Object to remove from the list of results
     *
     * @return $this|ChildTopicQuery The current query, for fluid interface
     */
    public function prune($topic = null)
    {
        if ($topic) {
            $this->addUsingAlias(TopicTableMap::COL_TOPIC_ID, $topic->getTopicId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the topic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TopicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TopicTableMap::clearInstancePool();
            TopicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TopicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TopicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TopicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TopicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TopicQuery
