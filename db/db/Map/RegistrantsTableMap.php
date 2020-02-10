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
use db\db\Registrants;
use db\db\RegistrantsQuery;


/**
 * This class defines the structure of the 'registrants' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RegistrantsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'db.db.Map.RegistrantsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'registrants';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\db\\db\\Registrants';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'db.db.Registrants';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the registrant_id field
     */
    const COL_REGISTRANT_ID = 'registrants.registrant_id';

    /**
     * the column name for the institution field
     */
    const COL_INSTITUTION = 'registrants.institution';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'registrants.email';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'registrants.name';

    /**
     * the column name for the surname field
     */
    const COL_SURNAME = 'registrants.surname';

    /**
     * the column name for the tel field
     */
    const COL_TEL = 'registrants.tel';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'registrants.country';

    /**
     * the column name for the country_reserved field
     */
    const COL_COUNTRY_RESERVED = 'registrants.country_reserved';

    /**
     * the column name for the last_update field
     */
    const COL_LAST_UPDATE = 'registrants.last_update';

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
        self::TYPE_PHPNAME       => array('RegistrantId', 'Institution', 'Email', 'Name', 'Surname', 'Tel', 'Country', 'CountryReserved', 'LastUpdate', ),
        self::TYPE_CAMELNAME     => array('registrantId', 'institution', 'email', 'name', 'surname', 'tel', 'country', 'countryReserved', 'lastUpdate', ),
        self::TYPE_COLNAME       => array(RegistrantsTableMap::COL_REGISTRANT_ID, RegistrantsTableMap::COL_INSTITUTION, RegistrantsTableMap::COL_EMAIL, RegistrantsTableMap::COL_NAME, RegistrantsTableMap::COL_SURNAME, RegistrantsTableMap::COL_TEL, RegistrantsTableMap::COL_COUNTRY, RegistrantsTableMap::COL_COUNTRY_RESERVED, RegistrantsTableMap::COL_LAST_UPDATE, ),
        self::TYPE_FIELDNAME     => array('registrant_id', 'institution', 'email', 'name', 'surname', 'tel', 'country', 'country_reserved', 'last_update', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('RegistrantId' => 0, 'Institution' => 1, 'Email' => 2, 'Name' => 3, 'Surname' => 4, 'Tel' => 5, 'Country' => 6, 'CountryReserved' => 7, 'LastUpdate' => 8, ),
        self::TYPE_CAMELNAME     => array('registrantId' => 0, 'institution' => 1, 'email' => 2, 'name' => 3, 'surname' => 4, 'tel' => 5, 'country' => 6, 'countryReserved' => 7, 'lastUpdate' => 8, ),
        self::TYPE_COLNAME       => array(RegistrantsTableMap::COL_REGISTRANT_ID => 0, RegistrantsTableMap::COL_INSTITUTION => 1, RegistrantsTableMap::COL_EMAIL => 2, RegistrantsTableMap::COL_NAME => 3, RegistrantsTableMap::COL_SURNAME => 4, RegistrantsTableMap::COL_TEL => 5, RegistrantsTableMap::COL_COUNTRY => 6, RegistrantsTableMap::COL_COUNTRY_RESERVED => 7, RegistrantsTableMap::COL_LAST_UPDATE => 8, ),
        self::TYPE_FIELDNAME     => array('registrant_id' => 0, 'institution' => 1, 'email' => 2, 'name' => 3, 'surname' => 4, 'tel' => 5, 'country' => 6, 'country_reserved' => 7, 'last_update' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('registrants');
        $this->setPhpName('Registrants');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\db\\db\\Registrants');
        $this->setPackage('db.db');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('registrant_id', 'RegistrantId', 'INTEGER', true, null, null);
        $this->addColumn('institution', 'Institution', 'VARCHAR', true, 40, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 40, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 30, null);
        $this->addColumn('surname', 'Surname', 'VARCHAR', true, 30, null);
        $this->addColumn('tel', 'Tel', 'VARCHAR', true, 17, null);
        $this->addForeignKey('country', 'Country', 'INTEGER', 'countries', 'country_id', true, null, null);
        $this->addForeignKey('country_reserved', 'CountryReserved', 'INTEGER', 'countries', 'country_id', false, null, null);
        $this->addColumn('last_update', 'LastUpdate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CountriesRelatedByCountry', '\\db\\db\\Countries', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':country',
    1 => ':country_id',
  ),
), null, null, null, false);
        $this->addRelation('CountriesRelatedByCountryReserved', '\\db\\db\\Countries', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':country_reserved',
    1 => ':country_id',
  ),
), null, null, null, false);
        $this->addRelation('RegistrantRoles', '\\db\\db\\RegistrantRoles', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, 'RegistrantRoless', false);
        $this->addRelation('Students', '\\db\\db\\Students', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':registrant_id',
    1 => ':registrant_id',
  ),
), null, null, null, false);
        $this->addRelation('Teachers', '\\db\\db\\Teachers', RelationMap::ONE_TO_ONE, array (
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
        return $withPrefix ? RegistrantsTableMap::CLASS_DEFAULT : RegistrantsTableMap::OM_CLASS;
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
     * @return array           (Registrants object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RegistrantsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RegistrantsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RegistrantsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RegistrantsTableMap::OM_CLASS;
            /** @var Registrants $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RegistrantsTableMap::addInstanceToPool($obj, $key);
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
            $key = RegistrantsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RegistrantsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Registrants $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RegistrantsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RegistrantsTableMap::COL_REGISTRANT_ID);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_INSTITUTION);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_EMAIL);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_NAME);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_SURNAME);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_TEL);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_COUNTRY_RESERVED);
            $criteria->addSelectColumn(RegistrantsTableMap::COL_LAST_UPDATE);
        } else {
            $criteria->addSelectColumn($alias . '.registrant_id');
            $criteria->addSelectColumn($alias . '.institution');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.surname');
            $criteria->addSelectColumn($alias . '.tel');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.country_reserved');
            $criteria->addSelectColumn($alias . '.last_update');
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
        return Propel::getServiceContainer()->getDatabaseMap(RegistrantsTableMap::DATABASE_NAME)->getTable(RegistrantsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RegistrantsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RegistrantsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RegistrantsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Registrants or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Registrants object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \db\db\Registrants) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RegistrantsTableMap::DATABASE_NAME);
            $criteria->add(RegistrantsTableMap::COL_REGISTRANT_ID, (array) $values, Criteria::IN);
        }

        $query = RegistrantsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RegistrantsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RegistrantsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the registrants table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RegistrantsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Registrants or Criteria object.
     *
     * @param mixed               $criteria Criteria or Registrants object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Registrants object
        }

        if ($criteria->containsKey(RegistrantsTableMap::COL_REGISTRANT_ID) && $criteria->keyContainsValue(RegistrantsTableMap::COL_REGISTRANT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RegistrantsTableMap::COL_REGISTRANT_ID.')');
        }


        // Set the correct dbName
        $query = RegistrantsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RegistrantsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RegistrantsTableMap::buildTableMap();
