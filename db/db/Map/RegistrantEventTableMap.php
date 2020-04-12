<?php

namespace db\db\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use db\db\RegistrantEvent;
use db\db\RegistrantEventQuery;


/**
 * This class defines the structure of the 'registrant_event' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RegistrantEventTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'db.db.Map.RegistrantEventTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'registrant_event';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\db\\db\\RegistrantEvent';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'db.db.RegistrantEvent';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the registrant_id field
     */
    const COL_REGISTRANT_ID = 'registrant_event.registrant_id';

    /**
     * the column name for the topic_id field
     */
    const COL_TOPIC_ID = 'registrant_event.topic_id';

    /**
     * the column name for the country_id field
     */
    const COL_COUNTRY_ID = 'registrant_event.country_id';

    /**
     * the column name for the registration_time field
     */
    const COL_REGISTRATION_TIME = 'registrant_event.registration_time';

    /**
     * the column name for the approved field
     */
    const COL_APPROVED = 'registrant_event.approved';

    /**
     * the column name for the approved_time field
     */
    const COL_APPROVED_TIME = 'registrant_event.approved_time';

    /**
     * the column name for the local field
     */
    const COL_LOCAL = 'registrant_event.local';

    /**
     * the column name for the has_attended field
     */
    const COL_HAS_ATTENDED = 'registrant_event.has_attended';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('RegistrantId', 'TopicId', 'CountryId', 'RegistrationTime', 'Approved', 'ApprovedTime', 'Local', 'HasAttended', ),
        self::TYPE_CAMELNAME     => array('registrantId', 'topicId', 'countryId', 'registrationTime', 'approved', 'approvedTime', 'local', 'hasAttended', ),
        self::TYPE_COLNAME       => array(RegistrantEventTableMap::COL_REGISTRANT_ID, RegistrantEventTableMap::COL_TOPIC_ID, RegistrantEventTableMap::COL_COUNTRY_ID, RegistrantEventTableMap::COL_REGISTRATION_TIME, RegistrantEventTableMap::COL_APPROVED, RegistrantEventTableMap::COL_APPROVED_TIME, RegistrantEventTableMap::COL_LOCAL, RegistrantEventTableMap::COL_HAS_ATTENDED, ),
        self::TYPE_FIELDNAME     => array('registrant_id', 'topic_id', 'country_id', 'registration_time', 'approved', 'approved_time', 'local', 'has_attended', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('RegistrantId' => 0, 'TopicId' => 1, 'CountryId' => 2, 'RegistrationTime' => 3, 'Approved' => 4, 'ApprovedTime' => 5, 'Local' => 6, 'HasAttended' => 7, ),
        self::TYPE_CAMELNAME     => array('registrantId' => 0, 'topicId' => 1, 'countryId' => 2, 'registrationTime' => 3, 'approved' => 4, 'approvedTime' => 5, 'local' => 6, 'hasAttended' => 7, ),
        self::TYPE_COLNAME       => array(RegistrantEventTableMap::COL_REGISTRANT_ID => 0, RegistrantEventTableMap::COL_TOPIC_ID => 1, RegistrantEventTableMap::COL_COUNTRY_ID => 2, RegistrantEventTableMap::COL_REGISTRATION_TIME => 3, RegistrantEventTableMap::COL_APPROVED => 4, RegistrantEventTableMap::COL_APPROVED_TIME => 5, RegistrantEventTableMap::COL_LOCAL => 6, RegistrantEventTableMap::COL_HAS_ATTENDED => 7, ),
        self::TYPE_FIELDNAME     => array('registrant_id' => 0, 'topic_id' => 1, 'country_id' => 2, 'registration_time' => 3, 'approved' => 4, 'approved_time' => 5, 'local' => 6, 'has_attended' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('registrant_event');
        $this->setPhpName('RegistrantEvent');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\db\\db\\RegistrantEvent');
        $this->setPackage('db.db');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('registrant_id', 'RegistrantId', 'SMALLINT' , 'registrant', 'registrant_id', true, 4, null);
        $this->addForeignKey('topic_id', 'TopicId', 'TINYINT', 'topic', 'topic_id', true, 3, null);
        $this->addForeignKey('country_id', 'CountryId', 'TINYINT', 'country', 'country_id', true, 3, null);
        $this->addColumn('registration_time', 'RegistrationTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('approved', 'Approved', 'BOOLEAN', true, 1, false);
        $this->addColumn('approved_time', 'ApprovedTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('local', 'Local', 'BOOLEAN', false, 1, null);
        $this->addColumn('has_attended', 'HasAttended', 'BOOLEAN', false, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Country', '\\db\\db\\Country', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':country_id',
    1 => ':country_id',
  ),
), null, null, null, false);
        $this->addRelation('Registrant', '\\db\\db\\Registrant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, null, false);
        $this->addRelation('Topic', '\\db\\db\\Topic', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':topic_id',
    1 => ':topic_id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? RegistrantEventTableMap::CLASS_DEFAULT : RegistrantEventTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (RegistrantEvent object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RegistrantEventTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RegistrantEventTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RegistrantEventTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RegistrantEventTableMap::OM_CLASS;
            /** @var RegistrantEvent $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RegistrantEventTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = RegistrantEventTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RegistrantEventTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RegistrantEvent $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RegistrantEventTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_REGISTRANT_ID);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_TOPIC_ID);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_COUNTRY_ID);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_REGISTRATION_TIME);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_APPROVED);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_APPROVED_TIME);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_LOCAL);
            $criteria->addSelectColumn(RegistrantEventTableMap::COL_HAS_ATTENDED);
        } else {
            $criteria->addSelectColumn($alias . '.registrant_id');
            $criteria->addSelectColumn($alias . '.topic_id');
            $criteria->addSelectColumn($alias . '.country_id');
            $criteria->addSelectColumn($alias . '.registration_time');
            $criteria->addSelectColumn($alias . '.approved');
            $criteria->addSelectColumn($alias . '.approved_time');
            $criteria->addSelectColumn($alias . '.local');
            $criteria->addSelectColumn($alias . '.has_attended');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(RegistrantEventTableMap::DATABASE_NAME)->getTable(RegistrantEventTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RegistrantEventTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RegistrantEventTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RegistrantEventTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a RegistrantEvent or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or RegistrantEvent object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \db\db\RegistrantEvent) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RegistrantEventTableMap::DATABASE_NAME);
            $criteria->add(RegistrantEventTableMap::COL_REGISTRANT_ID, (array) $values, Criteria::IN);
        }

        $query = RegistrantEventQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RegistrantEventTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RegistrantEventTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the registrant_event table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RegistrantEventQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RegistrantEvent or Criteria object.
     *
     * @param mixed               $criteria Criteria or RegistrantEvent object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RegistrantEvent object
        }


        // Set the correct dbName
        $query = RegistrantEventQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RegistrantEventTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RegistrantEventTableMap::buildTableMap();
