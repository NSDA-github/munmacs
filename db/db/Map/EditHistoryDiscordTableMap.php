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
use db\db\EditHistoryDiscord;
use db\db\EditHistoryDiscordQuery;


/**
 * This class defines the structure of the 'edit_history_discord' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EditHistoryDiscordTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'db.db.Map.EditHistoryDiscordTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'edit_history_discord';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\db\\db\\EditHistoryDiscord';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'db.db.EditHistoryDiscord';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the edit_id field
     */
    const COL_EDIT_ID = 'edit_history_discord.edit_id';

    /**
     * the column name for the who_edited field
     */
    const COL_WHO_EDITED = 'edit_history_discord.who_edited';

    /**
     * the column name for the whom_edited field
     */
    const COL_WHOM_EDITED = 'edit_history_discord.whom_edited';

    /**
     * the column name for the edit_datetime field
     */
    const COL_EDIT_DATETIME = 'edit_history_discord.edit_datetime';

    /**
     * the column name for the edited_from field
     */
    const COL_EDITED_FROM = 'edit_history_discord.edited_from';

    /**
     * the column name for the edited_to field
     */
    const COL_EDITED_TO = 'edit_history_discord.edited_to';

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
        self::TYPE_PHPNAME       => array('EditId', 'WhoEdited', 'WhomEdited', 'EditDatetime', 'EditedFrom', 'EditedTo', ),
        self::TYPE_CAMELNAME     => array('editId', 'whoEdited', 'whomEdited', 'editDatetime', 'editedFrom', 'editedTo', ),
        self::TYPE_COLNAME       => array(EditHistoryDiscordTableMap::COL_EDIT_ID, EditHistoryDiscordTableMap::COL_WHO_EDITED, EditHistoryDiscordTableMap::COL_WHOM_EDITED, EditHistoryDiscordTableMap::COL_EDIT_DATETIME, EditHistoryDiscordTableMap::COL_EDITED_FROM, EditHistoryDiscordTableMap::COL_EDITED_TO, ),
        self::TYPE_FIELDNAME     => array('edit_id', 'who_edited', 'whom_edited', 'edit_datetime', 'edited_from', 'edited_to', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EditId' => 0, 'WhoEdited' => 1, 'WhomEdited' => 2, 'EditDatetime' => 3, 'EditedFrom' => 4, 'EditedTo' => 5, ),
        self::TYPE_CAMELNAME     => array('editId' => 0, 'whoEdited' => 1, 'whomEdited' => 2, 'editDatetime' => 3, 'editedFrom' => 4, 'editedTo' => 5, ),
        self::TYPE_COLNAME       => array(EditHistoryDiscordTableMap::COL_EDIT_ID => 0, EditHistoryDiscordTableMap::COL_WHO_EDITED => 1, EditHistoryDiscordTableMap::COL_WHOM_EDITED => 2, EditHistoryDiscordTableMap::COL_EDIT_DATETIME => 3, EditHistoryDiscordTableMap::COL_EDITED_FROM => 4, EditHistoryDiscordTableMap::COL_EDITED_TO => 5, ),
        self::TYPE_FIELDNAME     => array('edit_id' => 0, 'who_edited' => 1, 'whom_edited' => 2, 'edit_datetime' => 3, 'edited_from' => 4, 'edited_to' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('edit_history_discord');
        $this->setPhpName('EditHistoryDiscord');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\db\\db\\EditHistoryDiscord');
        $this->setPackage('db.db');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('edit_id', 'EditId', 'INTEGER', true, null, null);
        $this->addColumn('who_edited', 'WhoEdited', 'TINYINT', true, 3, null);
        $this->addColumn('whom_edited', 'WhomEdited', 'SMALLINT', true, 4, null);
        $this->addColumn('edit_datetime', 'EditDatetime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('edited_from', 'EditedFrom', 'VARCHAR', true, 255, null);
        $this->addColumn('edited_to', 'EditedTo', 'VARCHAR', true, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EditId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EditHistoryDiscordTableMap::CLASS_DEFAULT : EditHistoryDiscordTableMap::OM_CLASS;
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
     * @return array           (EditHistoryDiscord object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EditHistoryDiscordTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EditHistoryDiscordTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EditHistoryDiscordTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EditHistoryDiscordTableMap::OM_CLASS;
            /** @var EditHistoryDiscord $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EditHistoryDiscordTableMap::addInstanceToPool($obj, $key);
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
            $key = EditHistoryDiscordTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EditHistoryDiscordTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EditHistoryDiscord $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EditHistoryDiscordTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EditHistoryDiscordTableMap::COL_EDIT_ID);
            $criteria->addSelectColumn(EditHistoryDiscordTableMap::COL_WHO_EDITED);
            $criteria->addSelectColumn(EditHistoryDiscordTableMap::COL_WHOM_EDITED);
            $criteria->addSelectColumn(EditHistoryDiscordTableMap::COL_EDIT_DATETIME);
            $criteria->addSelectColumn(EditHistoryDiscordTableMap::COL_EDITED_FROM);
            $criteria->addSelectColumn(EditHistoryDiscordTableMap::COL_EDITED_TO);
        } else {
            $criteria->addSelectColumn($alias . '.edit_id');
            $criteria->addSelectColumn($alias . '.who_edited');
            $criteria->addSelectColumn($alias . '.whom_edited');
            $criteria->addSelectColumn($alias . '.edit_datetime');
            $criteria->addSelectColumn($alias . '.edited_from');
            $criteria->addSelectColumn($alias . '.edited_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(EditHistoryDiscordTableMap::DATABASE_NAME)->getTable(EditHistoryDiscordTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EditHistoryDiscordTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EditHistoryDiscordTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EditHistoryDiscordTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a EditHistoryDiscord or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or EditHistoryDiscord object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EditHistoryDiscordTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \db\db\EditHistoryDiscord) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EditHistoryDiscordTableMap::DATABASE_NAME);
            $criteria->add(EditHistoryDiscordTableMap::COL_EDIT_ID, (array) $values, Criteria::IN);
        }

        $query = EditHistoryDiscordQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EditHistoryDiscordTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EditHistoryDiscordTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the edit_history_discord table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EditHistoryDiscordQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EditHistoryDiscord or Criteria object.
     *
     * @param mixed               $criteria Criteria or EditHistoryDiscord object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EditHistoryDiscordTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EditHistoryDiscord object
        }

        if ($criteria->containsKey(EditHistoryDiscordTableMap::COL_EDIT_ID) && $criteria->keyContainsValue(EditHistoryDiscordTableMap::COL_EDIT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EditHistoryDiscordTableMap::COL_EDIT_ID.')');
        }


        // Set the correct dbName
        $query = EditHistoryDiscordQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EditHistoryDiscordTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EditHistoryDiscordTableMap::buildTableMap();
