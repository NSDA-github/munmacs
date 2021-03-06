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
use db\db\TopicCountry as ChildTopicCountry;
use db\db\TopicCountryQuery as ChildTopicCountryQuery;
use db\db\Map\TopicCountryTableMap;

/**
 * Base class that represents a query for the 'topic_country' table.
 *
 *
 *
 * @method     ChildTopicCountryQuery orderByTopicId($order = Criteria::ASC) Order by the topic_id column
 * @method     ChildTopicCountryQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildTopicCountryQuery orderByAvailable($order = Criteria::ASC) Order by the available column
 * @method     ChildTopicCountryQuery orderByReserved($order = Criteria::ASC) Order by the reserved column
 *
 * @method     ChildTopicCountryQuery groupByTopicId() Group by the topic_id column
 * @method     ChildTopicCountryQuery groupByCountryId() Group by the country_id column
 * @method     ChildTopicCountryQuery groupByAvailable() Group by the available column
 * @method     ChildTopicCountryQuery groupByReserved() Group by the reserved column
 *
 * @method     ChildTopicCountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTopicCountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTopicCountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTopicCountryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTopicCountryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTopicCountryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTopicCountryQuery leftJoinTopic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Topic relation
 * @method     ChildTopicCountryQuery rightJoinTopic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Topic relation
 * @method     ChildTopicCountryQuery innerJoinTopic($relationAlias = null) Adds a INNER JOIN clause to the query using the Topic relation
 *
 * @method     ChildTopicCountryQuery joinWithTopic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Topic relation
 *
 * @method     ChildTopicCountryQuery leftJoinWithTopic() Adds a LEFT JOIN clause and with to the query using the Topic relation
 * @method     ChildTopicCountryQuery rightJoinWithTopic() Adds a RIGHT JOIN clause and with to the query using the Topic relation
 * @method     ChildTopicCountryQuery innerJoinWithTopic() Adds a INNER JOIN clause and with to the query using the Topic relation
 *
 * @method     ChildTopicCountryQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildTopicCountryQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildTopicCountryQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildTopicCountryQuery joinWithCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Country relation
 *
 * @method     ChildTopicCountryQuery leftJoinWithCountry() Adds a LEFT JOIN clause and with to the query using the Country relation
 * @method     ChildTopicCountryQuery rightJoinWithCountry() Adds a RIGHT JOIN clause and with to the query using the Country relation
 * @method     ChildTopicCountryQuery innerJoinWithCountry() Adds a INNER JOIN clause and with to the query using the Country relation
 *
 * @method     \db\db\TopicQuery|\db\db\CountryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTopicCountry findOne(ConnectionInterface $con = null) Return the first ChildTopicCountry matching the query
 * @method     ChildTopicCountry findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTopicCountry matching the query, or a new ChildTopicCountry object populated from the query conditions when no match is found
 *
 * @method     ChildTopicCountry findOneByTopicId(int $topic_id) Return the first ChildTopicCountry filtered by the topic_id column
 * @method     ChildTopicCountry findOneByCountryId(int $country_id) Return the first ChildTopicCountry filtered by the country_id column
 * @method     ChildTopicCountry findOneByAvailable(boolean $available) Return the first ChildTopicCountry filtered by the available column
 * @method     ChildTopicCountry findOneByReserved(int $reserved) Return the first ChildTopicCountry filtered by the reserved column *

 * @method     ChildTopicCountry requirePk($key, ConnectionInterface $con = null) Return the ChildTopicCountry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopicCountry requireOne(ConnectionInterface $con = null) Return the first ChildTopicCountry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTopicCountry requireOneByTopicId(int $topic_id) Return the first ChildTopicCountry filtered by the topic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopicCountry requireOneByCountryId(int $country_id) Return the first ChildTopicCountry filtered by the country_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopicCountry requireOneByAvailable(boolean $available) Return the first ChildTopicCountry filtered by the available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTopicCountry requireOneByReserved(int $reserved) Return the first ChildTopicCountry filtered by the reserved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTopicCountry[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTopicCountry objects based on current ModelCriteria
 * @method     ChildTopicCountry[]|ObjectCollection findByTopicId(int $topic_id) Return ChildTopicCountry objects filtered by the topic_id column
 * @method     ChildTopicCountry[]|ObjectCollection findByCountryId(int $country_id) Return ChildTopicCountry objects filtered by the country_id column
 * @method     ChildTopicCountry[]|ObjectCollection findByAvailable(boolean $available) Return ChildTopicCountry objects filtered by the available column
 * @method     ChildTopicCountry[]|ObjectCollection findByReserved(int $reserved) Return ChildTopicCountry objects filtered by the reserved column
 * @method     ChildTopicCountry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TopicCountryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \db\db\Base\TopicCountryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\db\\db\\TopicCountry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTopicCountryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTopicCountryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTopicCountryQuery) {
            return $criteria;
        }
        $query = new ChildTopicCountryQuery();
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
     * @param array[$topic_id, $country_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTopicCountry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TopicCountryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TopicCountryTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildTopicCountry A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT topic_id, country_id, available, reserved FROM topic_country WHERE topic_id = :p0 AND country_id = :p1';
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
            /** @var ChildTopicCountry $obj */
            $obj = new ChildTopicCountry();
            $obj->hydrate($row);
            TopicCountryTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildTopicCountry|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TopicCountryTableMap::COL_TOPIC_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TopicCountryTableMap::COL_COUNTRY_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TopicCountryTableMap::COL_TOPIC_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TopicCountryTableMap::COL_COUNTRY_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByTopicId($topicId = null, $comparison = null)
    {
        if (is_array($topicId)) {
            $useMinMax = false;
            if (isset($topicId['min'])) {
                $this->addUsingAlias(TopicCountryTableMap::COL_TOPIC_ID, $topicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($topicId['max'])) {
                $this->addUsingAlias(TopicCountryTableMap::COL_TOPIC_ID, $topicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicCountryTableMap::COL_TOPIC_ID, $topicId, $comparison);
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
     * @see       filterByCountry()
     *
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(TopicCountryTableMap::COL_COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(TopicCountryTableMap::COL_COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicCountryTableMap::COL_COUNTRY_ID, $countryId, $comparison);
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
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByAvailable($available = null, $comparison = null)
    {
        if (is_string($available)) {
            $available = in_array(strtolower($available), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TopicCountryTableMap::COL_AVAILABLE, $available, $comparison);
    }

    /**
     * Filter the query on the reserved column
     *
     * Example usage:
     * <code>
     * $query->filterByReserved(1234); // WHERE reserved = 1234
     * $query->filterByReserved(array(12, 34)); // WHERE reserved IN (12, 34)
     * $query->filterByReserved(array('min' => 12)); // WHERE reserved > 12
     * </code>
     *
     * @param     mixed $reserved The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByReserved($reserved = null, $comparison = null)
    {
        if (is_array($reserved)) {
            $useMinMax = false;
            if (isset($reserved['min'])) {
                $this->addUsingAlias(TopicCountryTableMap::COL_RESERVED, $reserved['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reserved['max'])) {
                $this->addUsingAlias(TopicCountryTableMap::COL_RESERVED, $reserved['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TopicCountryTableMap::COL_RESERVED, $reserved, $comparison);
    }

    /**
     * Filter the query by a related \db\db\Topic object
     *
     * @param \db\db\Topic|ObjectCollection $topic The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByTopic($topic, $comparison = null)
    {
        if ($topic instanceof \db\db\Topic) {
            return $this
                ->addUsingAlias(TopicCountryTableMap::COL_TOPIC_ID, $topic->getTopicId(), $comparison);
        } elseif ($topic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TopicCountryTableMap::COL_TOPIC_ID, $topic->toKeyValue('PrimaryKey', 'TopicId'), $comparison);
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
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
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
     * @return ChildTopicCountryQuery The current query, for fluid interface
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof \db\db\Country) {
            return $this
                ->addUsingAlias(TopicCountryTableMap::COL_COUNTRY_ID, $country->getCountryId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TopicCountryTableMap::COL_COUNTRY_ID, $country->toKeyValue('PrimaryKey', 'CountryId'), $comparison);
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \db\db\Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \db\db\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\db\db\CountryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTopicCountry $topicCountry Object to remove from the list of results
     *
     * @return $this|ChildTopicCountryQuery The current query, for fluid interface
     */
    public function prune($topicCountry = null)
    {
        if ($topicCountry) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TopicCountryTableMap::COL_TOPIC_ID), $topicCountry->getTopicId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TopicCountryTableMap::COL_COUNTRY_ID), $topicCountry->getCountryId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the topic_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TopicCountryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TopicCountryTableMap::clearInstancePool();
            TopicCountryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TopicCountryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TopicCountryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TopicCountryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TopicCountryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TopicCountryQuery
