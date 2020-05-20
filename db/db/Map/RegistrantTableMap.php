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
use db\db\Registrant;
use db\db\RegistrantQuery;


/**
 * This class defines the structure of the 'registrant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RegistrantTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'db.db.Map.RegistrantTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'registrant';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\db\\db\\Registrant';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'db.db.Registrant';

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
    const COL_REGISTRANT_ID = 'registrant.registrant_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'registrant.name';

    /**
     * the column name for the surname field
     */
    const COL_SURNAME = 'registrant.surname';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'registrant.email';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'registrant.phone';

    /**
     * the column name for the discord field
     */
    const COL_DISCORD = 'registrant.discord';

    /**
     * the column name for the institution field
     */
    const COL_INSTITUTION = 'registrant.institution';

    /**
     * the column name for the residence field
     */
    const COL_RESIDENCE = 'registrant.residence';

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
        self::TYPE_PHPNAME       => array('RegistrantId', 'Name', 'Surname', 'Email', 'Phone', 'Discord', 'Institution', 'Residence', ),
        self::TYPE_CAMELNAME     => array('registrantId', 'name', 'surname', 'email', 'phone', 'discord', 'institution', 'residence', ),
        self::TYPE_COLNAME       => array(RegistrantTableMap::COL_REGISTRANT_ID, RegistrantTableMap::COL_NAME, RegistrantTableMap::COL_SURNAME, RegistrantTableMap::COL_EMAIL, RegistrantTableMap::COL_PHONE, RegistrantTableMap::COL_DISCORD, RegistrantTableMap::COL_INSTITUTION, RegistrantTableMap::COL_RESIDENCE, ),
        self::TYPE_FIELDNAME     => array('registrant_id', 'name', 'surname', 'email', 'phone', 'discord', 'institution', 'residence', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('RegistrantId' => 0, 'Name' => 1, 'Surname' => 2, 'Email' => 3, 'Phone' => 4, 'Discord' => 5, 'Institution' => 6, 'Residence' => 7, ),
        self::TYPE_CAMELNAME     => array('registrantId' => 0, 'name' => 1, 'surname' => 2, 'email' => 3, 'phone' => 4, 'discord' => 5, 'institution' => 6, 'residence' => 7, ),
        self::TYPE_COLNAME       => array(RegistrantTableMap::COL_REGISTRANT_ID => 0, RegistrantTableMap::COL_NAME => 1, RegistrantTableMap::COL_SURNAME => 2, RegistrantTableMap::COL_EMAIL => 3, RegistrantTableMap::COL_PHONE => 4, RegistrantTableMap::COL_DISCORD => 5, RegistrantTableMap::COL_INSTITUTION => 6, RegistrantTableMap::COL_RESIDENCE => 7, ),
        self::TYPE_FIELDNAME     => array('registrant_id' => 0, 'name' => 1, 'surname' => 2, 'email' => 3, 'phone' => 4, 'discord' => 5, 'institution' => 6, 'residence' => 7, ),
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
        $this->setName('registrant');
        $this->setPhpName('Registrant');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\db\\db\\Registrant');
        $this->setPackage('db.db');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('registrant_id', 'RegistrantId', 'SMALLINT', true, 4, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 50, null);
        $this->addColumn('surname', 'Surname', 'VARCHAR', true, 50, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 80, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 12, null);
        $this->addColumn('discord', 'Discord', 'VARCHAR', false, 255, null);
        $this->addColumn('institution', 'Institution', 'VARCHAR', true, 255, null);
        $this->addForeignKey('residence', 'Residence', 'TINYINT', 'country', 'country_id', true, 3, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Country', '\\db\\db\\Country', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':residence',
    1 => ':country_id',
  ),
), null, null, null, false);
        $this->addRelation('RegistrantEvent', '\\db\\db\\RegistrantEvent', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, null, false);
        $this->addRelation('RegistrantOccupation', '\\db\\db\\RegistrantOccupation', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, null, false);
        $this->addRelation('RegistrantSchoolStudent', '\\db\\db\\RegistrantSchoolStudent', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, null, false);
        $this->addRelation('RegistrantStudent', '\\db\\db\\RegistrantStudent', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, null, false);
        $this->addRelation('RegistrantTeacher', '\\db\\db\\RegistrantTeacher', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
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
        return $withPrefix ? RegistrantTableMap::CLASS_DEFAULT : RegistrantTableMap::OM_CLASS;
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
     * @return array           (Registrant object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RegistrantTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RegistrantTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RegistrantTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RegistrantTableMap::OM_CLASS;
            /** @var Registrant $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RegistrantTableMap::addInstanceToPool($obj, $key);
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
            $key = RegistrantTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RegistrantTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Registrant $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RegistrantTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RegistrantTableMap::COL_REGISTRANT_ID);
            $criteria->addSelectColumn(RegistrantTableMap::COL_NAME);
            $criteria->addSelectColumn(RegistrantTableMap::COL_SURNAME);
            $criteria->addSelectColumn(RegistrantTableMap::COL_EMAIL);
            $criteria->addSelectColumn(RegistrantTableMap::COL_PHONE);
            $criteria->addSelectColumn(RegistrantTableMap::COL_DISCORD);
            $criteria->addSelectColumn(RegistrantTableMap::COL_INSTITUTION);
            $criteria->addSelectColumn(RegistrantTableMap::COL_RESIDENCE);
        } else {
            $criteria->addSelectColumn($alias . '.registrant_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.surname');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.discord');
            $criteria->addSelectColumn($alias . '.institution');
            $criteria->addSelectColumn($alias . '.residence');
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
        return Propel::getServiceContainer()->getDatabaseMap(RegistrantTableMap::DATABASE_NAME)->getTable(RegistrantTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RegistrantTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RegistrantTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RegistrantTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Registrant or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Registrant object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \db\db\Registrant) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RegistrantTableMap::DATABASE_NAME);
            $criteria->add(RegistrantTableMap::COL_REGISTRANT_ID, (array) $values, Criteria::IN);
        }

        $query = RegistrantQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RegistrantTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RegistrantTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the registrant table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RegistrantQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Registrant or Criteria object.
     *
     * @param mixed               $criteria Criteria or Registrant object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Registrant object
        }

        if ($criteria->containsKey(RegistrantTableMap::COL_REGISTRANT_ID) && $criteria->keyContainsValue(RegistrantTableMap::COL_REGISTRANT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RegistrantTableMap::COL_REGISTRANT_ID.')');
        }


        // Set the correct dbName
        $query = RegistrantQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RegistrantTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RegistrantTableMap::buildTableMap();
