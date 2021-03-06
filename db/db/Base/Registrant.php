<?php

namespace db\db\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use db\db\Country as ChildCountry;
use db\db\CountryQuery as ChildCountryQuery;
use db\db\RegistrantEvent as ChildRegistrantEvent;
use db\db\RegistrantEventQuery as ChildRegistrantEventQuery;
use db\db\RegistrantOccupation as ChildRegistrantOccupation;
use db\db\RegistrantOccupationQuery as ChildRegistrantOccupationQuery;
use db\db\RegistrantQuery as ChildRegistrantQuery;
use db\db\RegistrantSchoolStudent as ChildRegistrantSchoolStudent;
use db\db\RegistrantSchoolStudentQuery as ChildRegistrantSchoolStudentQuery;
use db\db\RegistrantStudent as ChildRegistrantStudent;
use db\db\RegistrantStudentQuery as ChildRegistrantStudentQuery;
use db\db\RegistrantTeacher as ChildRegistrantTeacher;
use db\db\RegistrantTeacherQuery as ChildRegistrantTeacherQuery;
use db\db\Map\RegistrantTableMap;

/**
 * Base class that represents a row from the 'registrant' table.
 *
 *
 *
 * @package    propel.generator.db.db.Base
 */
abstract class Registrant implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\db\\db\\Map\\RegistrantTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the registrant_id field.
     *
     * @var        int
     */
    protected $registrant_id;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the surname field.
     *
     * @var        string
     */
    protected $surname;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the discord field.
     *
     * @var        string
     */
    protected $discord;

    /**
     * The value for the institution field.
     *
     * @var        string
     */
    protected $institution;

    /**
     * The value for the residence field.
     *
     * @var        int
     */
    protected $residence;

    /**
     * @var        ChildCountry
     */
    protected $aCountry;

    /**
     * @var        ChildRegistrantEvent one-to-one related ChildRegistrantEvent object
     */
    protected $singleRegistrantEvent;

    /**
     * @var        ChildRegistrantOccupation one-to-one related ChildRegistrantOccupation object
     */
    protected $singleRegistrantOccupation;

    /**
     * @var        ChildRegistrantSchoolStudent one-to-one related ChildRegistrantSchoolStudent object
     */
    protected $singleRegistrantSchoolStudent;

    /**
     * @var        ChildRegistrantStudent one-to-one related ChildRegistrantStudent object
     */
    protected $singleRegistrantStudent;

    /**
     * @var        ChildRegistrantTeacher one-to-one related ChildRegistrantTeacher object
     */
    protected $singleRegistrantTeacher;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of db\db\Base\Registrant object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Registrant</code> instance.  If
     * <code>obj</code> is an instance of <code>Registrant</code>, delegates to
     * <code>equals(Registrant)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Registrant The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [registrant_id] column value.
     *
     * @return int
     */
    public function getRegistrantId()
    {
        return $this->registrant_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [surname] column value.
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [discord] column value.
     *
     * @return string
     */
    public function getDiscord()
    {
        return $this->discord;
    }

    /**
     * Get the [institution] column value.
     *
     * @return string
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Get the [residence] column value.
     *
     * @return int
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * Set the value of [registrant_id] column.
     *
     * @param int $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setRegistrantId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->registrant_id !== $v) {
            $this->registrant_id = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_REGISTRANT_ID] = true;
        }

        return $this;
    } // setRegistrantId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [surname] column.
     *
     * @param string $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setSurname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->surname !== $v) {
            $this->surname = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_SURNAME] = true;
        }

        return $this;
    } // setSurname()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [discord] column.
     *
     * @param string $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setDiscord($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->discord !== $v) {
            $this->discord = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_DISCORD] = true;
        }

        return $this;
    } // setDiscord()

    /**
     * Set the value of [institution] column.
     *
     * @param string $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setInstitution($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->institution !== $v) {
            $this->institution = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_INSTITUTION] = true;
        }

        return $this;
    } // setInstitution()

    /**
     * Set the value of [residence] column.
     *
     * @param int $v new value
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     */
    public function setResidence($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->residence !== $v) {
            $this->residence = $v;
            $this->modifiedColumns[RegistrantTableMap::COL_RESIDENCE] = true;
        }

        if ($this->aCountry !== null && $this->aCountry->getCountryId() !== $v) {
            $this->aCountry = null;
        }

        return $this;
    } // setResidence()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RegistrantTableMap::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registrant_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RegistrantTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RegistrantTableMap::translateFieldName('Surname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->surname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RegistrantTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RegistrantTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RegistrantTableMap::translateFieldName('Discord', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discord = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RegistrantTableMap::translateFieldName('Institution', TableMap::TYPE_PHPNAME, $indexType)];
            $this->institution = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RegistrantTableMap::translateFieldName('Residence', TableMap::TYPE_PHPNAME, $indexType)];
            $this->residence = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = RegistrantTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\db\\db\\Registrant'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aCountry !== null && $this->residence !== $this->aCountry->getCountryId()) {
            $this->aCountry = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRegistrantQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->singleRegistrantEvent = null;

            $this->singleRegistrantOccupation = null;

            $this->singleRegistrantSchoolStudent = null;

            $this->singleRegistrantStudent = null;

            $this->singleRegistrantTeacher = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Registrant::setDeleted()
     * @see Registrant::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRegistrantQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                RegistrantTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->singleRegistrantEvent !== null) {
                if (!$this->singleRegistrantEvent->isDeleted() && ($this->singleRegistrantEvent->isNew() || $this->singleRegistrantEvent->isModified())) {
                    $affectedRows += $this->singleRegistrantEvent->save($con);
                }
            }

            if ($this->singleRegistrantOccupation !== null) {
                if (!$this->singleRegistrantOccupation->isDeleted() && ($this->singleRegistrantOccupation->isNew() || $this->singleRegistrantOccupation->isModified())) {
                    $affectedRows += $this->singleRegistrantOccupation->save($con);
                }
            }

            if ($this->singleRegistrantSchoolStudent !== null) {
                if (!$this->singleRegistrantSchoolStudent->isDeleted() && ($this->singleRegistrantSchoolStudent->isNew() || $this->singleRegistrantSchoolStudent->isModified())) {
                    $affectedRows += $this->singleRegistrantSchoolStudent->save($con);
                }
            }

            if ($this->singleRegistrantStudent !== null) {
                if (!$this->singleRegistrantStudent->isDeleted() && ($this->singleRegistrantStudent->isNew() || $this->singleRegistrantStudent->isModified())) {
                    $affectedRows += $this->singleRegistrantStudent->save($con);
                }
            }

            if ($this->singleRegistrantTeacher !== null) {
                if (!$this->singleRegistrantTeacher->isDeleted() && ($this->singleRegistrantTeacher->isNew() || $this->singleRegistrantTeacher->isModified())) {
                    $affectedRows += $this->singleRegistrantTeacher->save($con);
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[RegistrantTableMap::COL_REGISTRANT_ID] = true;
        if (null !== $this->registrant_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RegistrantTableMap::COL_REGISTRANT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RegistrantTableMap::COL_REGISTRANT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'registrant_id';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_SURNAME)) {
            $modifiedColumns[':p' . $index++]  = 'surname';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_DISCORD)) {
            $modifiedColumns[':p' . $index++]  = 'discord';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_INSTITUTION)) {
            $modifiedColumns[':p' . $index++]  = 'institution';
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_RESIDENCE)) {
            $modifiedColumns[':p' . $index++]  = 'residence';
        }

        $sql = sprintf(
            'INSERT INTO registrant (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'registrant_id':
                        $stmt->bindValue($identifier, $this->registrant_id, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'surname':
                        $stmt->bindValue($identifier, $this->surname, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'discord':
                        $stmt->bindValue($identifier, $this->discord, PDO::PARAM_STR);
                        break;
                    case 'institution':
                        $stmt->bindValue($identifier, $this->institution, PDO::PARAM_STR);
                        break;
                    case 'residence':
                        $stmt->bindValue($identifier, $this->residence, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setRegistrantId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RegistrantTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getRegistrantId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getSurname();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getPhone();
                break;
            case 5:
                return $this->getDiscord();
                break;
            case 6:
                return $this->getInstitution();
                break;
            case 7:
                return $this->getResidence();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Registrant'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Registrant'][$this->hashCode()] = true;
        $keys = RegistrantTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRegistrantId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getSurname(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getPhone(),
            $keys[5] => $this->getDiscord(),
            $keys[6] => $this->getInstitution(),
            $keys[7] => $this->getResidence(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'country';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'country';
                        break;
                    default:
                        $key = 'Country';
                }

                $result[$key] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleRegistrantEvent) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registrantEvent';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registrant_event';
                        break;
                    default:
                        $key = 'RegistrantEvent';
                }

                $result[$key] = $this->singleRegistrantEvent->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleRegistrantOccupation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registrantOccupation';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registrant_occupation';
                        break;
                    default:
                        $key = 'RegistrantOccupation';
                }

                $result[$key] = $this->singleRegistrantOccupation->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleRegistrantSchoolStudent) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registrantSchoolStudent';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registrant_school_student';
                        break;
                    default:
                        $key = 'RegistrantSchoolStudent';
                }

                $result[$key] = $this->singleRegistrantSchoolStudent->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleRegistrantStudent) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registrantStudent';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registrant_student';
                        break;
                    default:
                        $key = 'RegistrantStudent';
                }

                $result[$key] = $this->singleRegistrantStudent->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleRegistrantTeacher) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registrantTeacher';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registrant_teacher';
                        break;
                    default:
                        $key = 'RegistrantTeacher';
                }

                $result[$key] = $this->singleRegistrantTeacher->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\db\db\Registrant
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RegistrantTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\db\db\Registrant
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setRegistrantId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setSurname($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setPhone($value);
                break;
            case 5:
                $this->setDiscord($value);
                break;
            case 6:
                $this->setInstitution($value);
                break;
            case 7:
                $this->setResidence($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = RegistrantTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRegistrantId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSurname($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPhone($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDiscord($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setInstitution($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setResidence($arr[$keys[7]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\db\db\Registrant The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RegistrantTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RegistrantTableMap::COL_REGISTRANT_ID)) {
            $criteria->add(RegistrantTableMap::COL_REGISTRANT_ID, $this->registrant_id);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_NAME)) {
            $criteria->add(RegistrantTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_SURNAME)) {
            $criteria->add(RegistrantTableMap::COL_SURNAME, $this->surname);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_EMAIL)) {
            $criteria->add(RegistrantTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_PHONE)) {
            $criteria->add(RegistrantTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_DISCORD)) {
            $criteria->add(RegistrantTableMap::COL_DISCORD, $this->discord);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_INSTITUTION)) {
            $criteria->add(RegistrantTableMap::COL_INSTITUTION, $this->institution);
        }
        if ($this->isColumnModified(RegistrantTableMap::COL_RESIDENCE)) {
            $criteria->add(RegistrantTableMap::COL_RESIDENCE, $this->residence);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildRegistrantQuery::create();
        $criteria->add(RegistrantTableMap::COL_REGISTRANT_ID, $this->registrant_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getRegistrantId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getRegistrantId();
    }

    /**
     * Generic method to set the primary key (registrant_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setRegistrantId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getRegistrantId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \db\db\Registrant (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setSurname($this->getSurname());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setDiscord($this->getDiscord());
        $copyObj->setInstitution($this->getInstitution());
        $copyObj->setResidence($this->getResidence());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            $relObj = $this->getRegistrantEvent();
            if ($relObj) {
                $copyObj->setRegistrantEvent($relObj->copy($deepCopy));
            }

            $relObj = $this->getRegistrantOccupation();
            if ($relObj) {
                $copyObj->setRegistrantOccupation($relObj->copy($deepCopy));
            }

            $relObj = $this->getRegistrantSchoolStudent();
            if ($relObj) {
                $copyObj->setRegistrantSchoolStudent($relObj->copy($deepCopy));
            }

            $relObj = $this->getRegistrantStudent();
            if ($relObj) {
                $copyObj->setRegistrantStudent($relObj->copy($deepCopy));
            }

            $relObj = $this->getRegistrantTeacher();
            if ($relObj) {
                $copyObj->setRegistrantTeacher($relObj->copy($deepCopy));
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRegistrantId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \db\db\Registrant Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCountry object.
     *
     * @param  ChildCountry $v
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCountry(ChildCountry $v = null)
    {
        if ($v === null) {
            $this->setResidence(NULL);
        } else {
            $this->setResidence($v->getCountryId());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addRegistrant($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCountry object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCountry The associated ChildCountry object.
     * @throws PropelException
     */
    public function getCountry(ConnectionInterface $con = null)
    {
        if ($this->aCountry === null && ($this->residence != 0)) {
            $this->aCountry = ChildCountryQuery::create()->findPk($this->residence, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addRegistrants($this);
             */
        }

        return $this->aCountry;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
    }

    /**
     * Gets a single ChildRegistrantEvent object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildRegistrantEvent
     * @throws PropelException
     */
    public function getRegistrantEvent(ConnectionInterface $con = null)
    {

        if ($this->singleRegistrantEvent === null && !$this->isNew()) {
            $this->singleRegistrantEvent = ChildRegistrantEventQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleRegistrantEvent;
    }

    /**
     * Sets a single ChildRegistrantEvent object as related to this object by a one-to-one relationship.
     *
     * @param  ChildRegistrantEvent $v ChildRegistrantEvent
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRegistrantEvent(ChildRegistrantEvent $v = null)
    {
        $this->singleRegistrantEvent = $v;

        // Make sure that that the passed-in ChildRegistrantEvent isn't already associated with this object
        if ($v !== null && $v->getRegistrant(null, false) === null) {
            $v->setRegistrant($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildRegistrantOccupation object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildRegistrantOccupation
     * @throws PropelException
     */
    public function getRegistrantOccupation(ConnectionInterface $con = null)
    {

        if ($this->singleRegistrantOccupation === null && !$this->isNew()) {
            $this->singleRegistrantOccupation = ChildRegistrantOccupationQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleRegistrantOccupation;
    }

    /**
     * Sets a single ChildRegistrantOccupation object as related to this object by a one-to-one relationship.
     *
     * @param  ChildRegistrantOccupation $v ChildRegistrantOccupation
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRegistrantOccupation(ChildRegistrantOccupation $v = null)
    {
        $this->singleRegistrantOccupation = $v;

        // Make sure that that the passed-in ChildRegistrantOccupation isn't already associated with this object
        if ($v !== null && $v->getRegistrant(null, false) === null) {
            $v->setRegistrant($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildRegistrantSchoolStudent object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildRegistrantSchoolStudent
     * @throws PropelException
     */
    public function getRegistrantSchoolStudent(ConnectionInterface $con = null)
    {

        if ($this->singleRegistrantSchoolStudent === null && !$this->isNew()) {
            $this->singleRegistrantSchoolStudent = ChildRegistrantSchoolStudentQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleRegistrantSchoolStudent;
    }

    /**
     * Sets a single ChildRegistrantSchoolStudent object as related to this object by a one-to-one relationship.
     *
     * @param  ChildRegistrantSchoolStudent $v ChildRegistrantSchoolStudent
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRegistrantSchoolStudent(ChildRegistrantSchoolStudent $v = null)
    {
        $this->singleRegistrantSchoolStudent = $v;

        // Make sure that that the passed-in ChildRegistrantSchoolStudent isn't already associated with this object
        if ($v !== null && $v->getRegistrant(null, false) === null) {
            $v->setRegistrant($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildRegistrantStudent object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildRegistrantStudent
     * @throws PropelException
     */
    public function getRegistrantStudent(ConnectionInterface $con = null)
    {

        if ($this->singleRegistrantStudent === null && !$this->isNew()) {
            $this->singleRegistrantStudent = ChildRegistrantStudentQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleRegistrantStudent;
    }

    /**
     * Sets a single ChildRegistrantStudent object as related to this object by a one-to-one relationship.
     *
     * @param  ChildRegistrantStudent $v ChildRegistrantStudent
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRegistrantStudent(ChildRegistrantStudent $v = null)
    {
        $this->singleRegistrantStudent = $v;

        // Make sure that that the passed-in ChildRegistrantStudent isn't already associated with this object
        if ($v !== null && $v->getRegistrant(null, false) === null) {
            $v->setRegistrant($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildRegistrantTeacher object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildRegistrantTeacher
     * @throws PropelException
     */
    public function getRegistrantTeacher(ConnectionInterface $con = null)
    {

        if ($this->singleRegistrantTeacher === null && !$this->isNew()) {
            $this->singleRegistrantTeacher = ChildRegistrantTeacherQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleRegistrantTeacher;
    }

    /**
     * Sets a single ChildRegistrantTeacher object as related to this object by a one-to-one relationship.
     *
     * @param  ChildRegistrantTeacher $v ChildRegistrantTeacher
     * @return $this|\db\db\Registrant The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRegistrantTeacher(ChildRegistrantTeacher $v = null)
    {
        $this->singleRegistrantTeacher = $v;

        // Make sure that that the passed-in ChildRegistrantTeacher isn't already associated with this object
        if ($v !== null && $v->getRegistrant(null, false) === null) {
            $v->setRegistrant($this);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCountry) {
            $this->aCountry->removeRegistrant($this);
        }
        $this->registrant_id = null;
        $this->name = null;
        $this->surname = null;
        $this->email = null;
        $this->phone = null;
        $this->discord = null;
        $this->institution = null;
        $this->residence = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->singleRegistrantEvent) {
                $this->singleRegistrantEvent->clearAllReferences($deep);
            }
            if ($this->singleRegistrantOccupation) {
                $this->singleRegistrantOccupation->clearAllReferences($deep);
            }
            if ($this->singleRegistrantSchoolStudent) {
                $this->singleRegistrantSchoolStudent->clearAllReferences($deep);
            }
            if ($this->singleRegistrantStudent) {
                $this->singleRegistrantStudent->clearAllReferences($deep);
            }
            if ($this->singleRegistrantTeacher) {
                $this->singleRegistrantTeacher->clearAllReferences($deep);
            }
        } // if ($deep)

        $this->singleRegistrantEvent = null;
        $this->singleRegistrantOccupation = null;
        $this->singleRegistrantSchoolStudent = null;
        $this->singleRegistrantStudent = null;
        $this->singleRegistrantTeacher = null;
        $this->aCountry = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RegistrantTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
