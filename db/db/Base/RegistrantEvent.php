<?php

namespace db\db\Base;

use \DateTime;
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
use Propel\Runtime\Util\PropelDateTime;
use db\db\Country as ChildCountry;
use db\db\CountryQuery as ChildCountryQuery;
use db\db\Registrant as ChildRegistrant;
use db\db\RegistrantEventQuery as ChildRegistrantEventQuery;
use db\db\RegistrantQuery as ChildRegistrantQuery;
use db\db\Topic as ChildTopic;
use db\db\TopicQuery as ChildTopicQuery;
use db\db\Map\RegistrantEventTableMap;

/**
 * Base class that represents a row from the 'registrant_event' table.
 *
 *
 *
 * @package    propel.generator.db.db.Base
 */
abstract class RegistrantEvent implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\db\\db\\Map\\RegistrantEventTableMap';


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
     * The value for the topic_id field.
     *
     * @var        int
     */
    protected $topic_id;

    /**
     * The value for the country_id field.
     *
     * @var        int
     */
    protected $country_id;

    /**
     * The value for the country_desired field.
     *
     * @var        int
     */
    protected $country_desired;

    /**
     * The value for the interest_text field.
     *
     * @var        string
     */
    protected $interest_text;

    /**
     * The value for the registration_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $registration_time;

    /**
     * The value for the approved field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $approved;

    /**
     * The value for the approved_time field.
     *
     * @var        DateTime
     */
    protected $approved_time;

    /**
     * The value for the interest_verified field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $interest_verified;

    /**
     * The value for the discord_verified field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $discord_verified;

    /**
     * The value for the mic_verified field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $mic_verified;

    /**
     * The value for the local field.
     *
     * @var        boolean
     */
    protected $local;

    /**
     * The value for the has_attended field.
     *
     * @var        boolean
     */
    protected $has_attended;

    /**
     * @var        ChildCountry
     */
    protected $aCountryRelatedByCountryId;

    /**
     * @var        ChildRegistrant
     */
    protected $aRegistrant;

    /**
     * @var        ChildTopic
     */
    protected $aTopic;

    /**
     * @var        ChildCountry
     */
    protected $aCountryRelatedByCountryDesired;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->approved = false;
        $this->interest_verified = false;
        $this->discord_verified = false;
        $this->mic_verified = false;
    }

    /**
     * Initializes internal state of db\db\Base\RegistrantEvent object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>RegistrantEvent</code> instance.  If
     * <code>obj</code> is an instance of <code>RegistrantEvent</code>, delegates to
     * <code>equals(RegistrantEvent)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|RegistrantEvent The current object, for fluid interface
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
     * Get the [topic_id] column value.
     *
     * @return int
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * Get the [country_id] column value.
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Get the [country_desired] column value.
     *
     * @return int
     */
    public function getCountryDesired()
    {
        return $this->country_desired;
    }

    /**
     * Get the [interest_text] column value.
     *
     * @return string
     */
    public function getInterestText()
    {
        return $this->interest_text;
    }

    /**
     * Get the [optionally formatted] temporal [registration_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRegistrationTime($format = NULL)
    {
        if ($format === null) {
            return $this->registration_time;
        } else {
            return $this->registration_time instanceof \DateTimeInterface ? $this->registration_time->format($format) : null;
        }
    }

    /**
     * Get the [approved] column value.
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Get the [approved] column value.
     *
     * @return boolean
     */
    public function isApproved()
    {
        return $this->getApproved();
    }

    /**
     * Get the [optionally formatted] temporal [approved_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getApprovedTime($format = NULL)
    {
        if ($format === null) {
            return $this->approved_time;
        } else {
            return $this->approved_time instanceof \DateTimeInterface ? $this->approved_time->format($format) : null;
        }
    }

    /**
     * Get the [interest_verified] column value.
     *
     * @return boolean
     */
    public function getInterestVerified()
    {
        return $this->interest_verified;
    }

    /**
     * Get the [interest_verified] column value.
     *
     * @return boolean
     */
    public function isInterestVerified()
    {
        return $this->getInterestVerified();
    }

    /**
     * Get the [discord_verified] column value.
     *
     * @return boolean
     */
    public function getDiscordVerified()
    {
        return $this->discord_verified;
    }

    /**
     * Get the [discord_verified] column value.
     *
     * @return boolean
     */
    public function isDiscordVerified()
    {
        return $this->getDiscordVerified();
    }

    /**
     * Get the [mic_verified] column value.
     *
     * @return boolean
     */
    public function getMicVerified()
    {
        return $this->mic_verified;
    }

    /**
     * Get the [mic_verified] column value.
     *
     * @return boolean
     */
    public function isMicVerified()
    {
        return $this->getMicVerified();
    }

    /**
     * Get the [local] column value.
     *
     * @return boolean
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Get the [local] column value.
     *
     * @return boolean
     */
    public function isLocal()
    {
        return $this->getLocal();
    }

    /**
     * Get the [has_attended] column value.
     *
     * @return boolean
     */
    public function getHasAttended()
    {
        return $this->has_attended;
    }

    /**
     * Get the [has_attended] column value.
     *
     * @return boolean
     */
    public function hasAttended()
    {
        return $this->getHasAttended();
    }

    /**
     * Set the value of [registrant_id] column.
     *
     * @param int $v new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setRegistrantId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->registrant_id !== $v) {
            $this->registrant_id = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_REGISTRANT_ID] = true;
        }

        if ($this->aRegistrant !== null && $this->aRegistrant->getRegistrantId() !== $v) {
            $this->aRegistrant = null;
        }

        return $this;
    } // setRegistrantId()

    /**
     * Set the value of [topic_id] column.
     *
     * @param int $v new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setTopicId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->topic_id !== $v) {
            $this->topic_id = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_TOPIC_ID] = true;
        }

        if ($this->aTopic !== null && $this->aTopic->getTopicId() !== $v) {
            $this->aTopic = null;
        }

        return $this;
    } // setTopicId()

    /**
     * Set the value of [country_id] column.
     *
     * @param int $v new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setCountryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_id !== $v) {
            $this->country_id = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_COUNTRY_ID] = true;
        }

        if ($this->aCountryRelatedByCountryId !== null && $this->aCountryRelatedByCountryId->getCountryId() !== $v) {
            $this->aCountryRelatedByCountryId = null;
        }

        return $this;
    } // setCountryId()

    /**
     * Set the value of [country_desired] column.
     *
     * @param int $v new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setCountryDesired($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_desired !== $v) {
            $this->country_desired = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_COUNTRY_DESIRED] = true;
        }

        if ($this->aCountryRelatedByCountryDesired !== null && $this->aCountryRelatedByCountryDesired->getCountryId() !== $v) {
            $this->aCountryRelatedByCountryDesired = null;
        }

        return $this;
    } // setCountryDesired()

    /**
     * Set the value of [interest_text] column.
     *
     * @param string $v new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setInterestText($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->interest_text !== $v) {
            $this->interest_text = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_INTEREST_TEXT] = true;
        }

        return $this;
    } // setInterestText()

    /**
     * Sets the value of [registration_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setRegistrationTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registration_time !== null || $dt !== null) {
            if ($this->registration_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->registration_time->format("Y-m-d H:i:s.u")) {
                $this->registration_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RegistrantEventTableMap::COL_REGISTRATION_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setRegistrationTime()

    /**
     * Sets the value of the [approved] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setApproved($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->approved !== $v) {
            $this->approved = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_APPROVED] = true;
        }

        return $this;
    } // setApproved()

    /**
     * Sets the value of [approved_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setApprovedTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->approved_time !== null || $dt !== null) {
            if ($this->approved_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->approved_time->format("Y-m-d H:i:s.u")) {
                $this->approved_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RegistrantEventTableMap::COL_APPROVED_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setApprovedTime()

    /**
     * Sets the value of the [interest_verified] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setInterestVerified($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->interest_verified !== $v) {
            $this->interest_verified = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_INTEREST_VERIFIED] = true;
        }

        return $this;
    } // setInterestVerified()

    /**
     * Sets the value of the [discord_verified] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setDiscordVerified($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->discord_verified !== $v) {
            $this->discord_verified = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_DISCORD_VERIFIED] = true;
        }

        return $this;
    } // setDiscordVerified()

    /**
     * Sets the value of the [mic_verified] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setMicVerified($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->mic_verified !== $v) {
            $this->mic_verified = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_MIC_VERIFIED] = true;
        }

        return $this;
    } // setMicVerified()

    /**
     * Sets the value of the [local] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setLocal($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->local !== $v) {
            $this->local = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_LOCAL] = true;
        }

        return $this;
    } // setLocal()

    /**
     * Sets the value of the [has_attended] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     */
    public function setHasAttended($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->has_attended !== $v) {
            $this->has_attended = $v;
            $this->modifiedColumns[RegistrantEventTableMap::COL_HAS_ATTENDED] = true;
        }

        return $this;
    } // setHasAttended()

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
            if ($this->approved !== false) {
                return false;
            }

            if ($this->interest_verified !== false) {
                return false;
            }

            if ($this->discord_verified !== false) {
                return false;
            }

            if ($this->mic_verified !== false) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RegistrantEventTableMap::translateFieldName('RegistrantId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registrant_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RegistrantEventTableMap::translateFieldName('TopicId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->topic_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RegistrantEventTableMap::translateFieldName('CountryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RegistrantEventTableMap::translateFieldName('CountryDesired', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_desired = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RegistrantEventTableMap::translateFieldName('InterestText', TableMap::TYPE_PHPNAME, $indexType)];
            $this->interest_text = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RegistrantEventTableMap::translateFieldName('RegistrationTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registration_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RegistrantEventTableMap::translateFieldName('Approved', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RegistrantEventTableMap::translateFieldName('ApprovedTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->approved_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : RegistrantEventTableMap::translateFieldName('InterestVerified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->interest_verified = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : RegistrantEventTableMap::translateFieldName('DiscordVerified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discord_verified = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : RegistrantEventTableMap::translateFieldName('MicVerified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mic_verified = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : RegistrantEventTableMap::translateFieldName('Local', TableMap::TYPE_PHPNAME, $indexType)];
            $this->local = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : RegistrantEventTableMap::translateFieldName('HasAttended', TableMap::TYPE_PHPNAME, $indexType)];
            $this->has_attended = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = RegistrantEventTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\db\\db\\RegistrantEvent'), 0, $e);
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
        if ($this->aRegistrant !== null && $this->registrant_id !== $this->aRegistrant->getRegistrantId()) {
            $this->aRegistrant = null;
        }
        if ($this->aTopic !== null && $this->topic_id !== $this->aTopic->getTopicId()) {
            $this->aTopic = null;
        }
        if ($this->aCountryRelatedByCountryId !== null && $this->country_id !== $this->aCountryRelatedByCountryId->getCountryId()) {
            $this->aCountryRelatedByCountryId = null;
        }
        if ($this->aCountryRelatedByCountryDesired !== null && $this->country_desired !== $this->aCountryRelatedByCountryDesired->getCountryId()) {
            $this->aCountryRelatedByCountryDesired = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRegistrantEventQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountryRelatedByCountryId = null;
            $this->aRegistrant = null;
            $this->aTopic = null;
            $this->aCountryRelatedByCountryDesired = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see RegistrantEvent::setDeleted()
     * @see RegistrantEvent::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantEventTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRegistrantEventQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(RegistrantEventTableMap::DATABASE_NAME);
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
                RegistrantEventTableMap::addInstanceToPool($this);
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

            if ($this->aCountryRelatedByCountryId !== null) {
                if ($this->aCountryRelatedByCountryId->isModified() || $this->aCountryRelatedByCountryId->isNew()) {
                    $affectedRows += $this->aCountryRelatedByCountryId->save($con);
                }
                $this->setCountryRelatedByCountryId($this->aCountryRelatedByCountryId);
            }

            if ($this->aRegistrant !== null) {
                if ($this->aRegistrant->isModified() || $this->aRegistrant->isNew()) {
                    $affectedRows += $this->aRegistrant->save($con);
                }
                $this->setRegistrant($this->aRegistrant);
            }

            if ($this->aTopic !== null) {
                if ($this->aTopic->isModified() || $this->aTopic->isNew()) {
                    $affectedRows += $this->aTopic->save($con);
                }
                $this->setTopic($this->aTopic);
            }

            if ($this->aCountryRelatedByCountryDesired !== null) {
                if ($this->aCountryRelatedByCountryDesired->isModified() || $this->aCountryRelatedByCountryDesired->isNew()) {
                    $affectedRows += $this->aCountryRelatedByCountryDesired->save($con);
                }
                $this->setCountryRelatedByCountryDesired($this->aCountryRelatedByCountryDesired);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RegistrantEventTableMap::COL_REGISTRANT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'registrant_id';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_TOPIC_ID)) {
            $modifiedColumns[':p' . $index++]  = 'topic_id';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_COUNTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'country_id';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_COUNTRY_DESIRED)) {
            $modifiedColumns[':p' . $index++]  = 'country_desired';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_INTEREST_TEXT)) {
            $modifiedColumns[':p' . $index++]  = 'interest_text';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_REGISTRATION_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'registration_time';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_APPROVED)) {
            $modifiedColumns[':p' . $index++]  = 'approved';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_APPROVED_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'approved_time';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_INTEREST_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'interest_verified';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_DISCORD_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'discord_verified';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_MIC_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'mic_verified';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_LOCAL)) {
            $modifiedColumns[':p' . $index++]  = 'local';
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_HAS_ATTENDED)) {
            $modifiedColumns[':p' . $index++]  = 'has_attended';
        }

        $sql = sprintf(
            'INSERT INTO registrant_event (%s) VALUES (%s)',
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
                    case 'topic_id':
                        $stmt->bindValue($identifier, $this->topic_id, PDO::PARAM_INT);
                        break;
                    case 'country_id':
                        $stmt->bindValue($identifier, $this->country_id, PDO::PARAM_INT);
                        break;
                    case 'country_desired':
                        $stmt->bindValue($identifier, $this->country_desired, PDO::PARAM_INT);
                        break;
                    case 'interest_text':
                        $stmt->bindValue($identifier, $this->interest_text, PDO::PARAM_STR);
                        break;
                    case 'registration_time':
                        $stmt->bindValue($identifier, $this->registration_time ? $this->registration_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'approved':
                        $stmt->bindValue($identifier, (int) $this->approved, PDO::PARAM_INT);
                        break;
                    case 'approved_time':
                        $stmt->bindValue($identifier, $this->approved_time ? $this->approved_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'interest_verified':
                        $stmt->bindValue($identifier, (int) $this->interest_verified, PDO::PARAM_INT);
                        break;
                    case 'discord_verified':
                        $stmt->bindValue($identifier, (int) $this->discord_verified, PDO::PARAM_INT);
                        break;
                    case 'mic_verified':
                        $stmt->bindValue($identifier, (int) $this->mic_verified, PDO::PARAM_INT);
                        break;
                    case 'local':
                        $stmt->bindValue($identifier, (int) $this->local, PDO::PARAM_INT);
                        break;
                    case 'has_attended':
                        $stmt->bindValue($identifier, (int) $this->has_attended, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = RegistrantEventTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTopicId();
                break;
            case 2:
                return $this->getCountryId();
                break;
            case 3:
                return $this->getCountryDesired();
                break;
            case 4:
                return $this->getInterestText();
                break;
            case 5:
                return $this->getRegistrationTime();
                break;
            case 6:
                return $this->getApproved();
                break;
            case 7:
                return $this->getApprovedTime();
                break;
            case 8:
                return $this->getInterestVerified();
                break;
            case 9:
                return $this->getDiscordVerified();
                break;
            case 10:
                return $this->getMicVerified();
                break;
            case 11:
                return $this->getLocal();
                break;
            case 12:
                return $this->getHasAttended();
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

        if (isset($alreadyDumpedObjects['RegistrantEvent'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['RegistrantEvent'][$this->hashCode()] = true;
        $keys = RegistrantEventTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRegistrantId(),
            $keys[1] => $this->getTopicId(),
            $keys[2] => $this->getCountryId(),
            $keys[3] => $this->getCountryDesired(),
            $keys[4] => $this->getInterestText(),
            $keys[5] => $this->getRegistrationTime(),
            $keys[6] => $this->getApproved(),
            $keys[7] => $this->getApprovedTime(),
            $keys[8] => $this->getInterestVerified(),
            $keys[9] => $this->getDiscordVerified(),
            $keys[10] => $this->getMicVerified(),
            $keys[11] => $this->getLocal(),
            $keys[12] => $this->getHasAttended(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCountryRelatedByCountryId) {

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

                $result[$key] = $this->aCountryRelatedByCountryId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRegistrant) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'registrant';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'registrant';
                        break;
                    default:
                        $key = 'Registrant';
                }

                $result[$key] = $this->aRegistrant->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTopic) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'topic';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'topic';
                        break;
                    default:
                        $key = 'Topic';
                }

                $result[$key] = $this->aTopic->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCountryRelatedByCountryDesired) {

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

                $result[$key] = $this->aCountryRelatedByCountryDesired->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\db\db\RegistrantEvent
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RegistrantEventTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\db\db\RegistrantEvent
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setRegistrantId($value);
                break;
            case 1:
                $this->setTopicId($value);
                break;
            case 2:
                $this->setCountryId($value);
                break;
            case 3:
                $this->setCountryDesired($value);
                break;
            case 4:
                $this->setInterestText($value);
                break;
            case 5:
                $this->setRegistrationTime($value);
                break;
            case 6:
                $this->setApproved($value);
                break;
            case 7:
                $this->setApprovedTime($value);
                break;
            case 8:
                $this->setInterestVerified($value);
                break;
            case 9:
                $this->setDiscordVerified($value);
                break;
            case 10:
                $this->setMicVerified($value);
                break;
            case 11:
                $this->setLocal($value);
                break;
            case 12:
                $this->setHasAttended($value);
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
        $keys = RegistrantEventTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRegistrantId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTopicId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCountryId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCountryDesired($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setInterestText($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRegistrationTime($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setApproved($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setApprovedTime($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setInterestVerified($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDiscordVerified($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMicVerified($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLocal($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setHasAttended($arr[$keys[12]]);
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
     * @return $this|\db\db\RegistrantEvent The current object, for fluid interface
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
        $criteria = new Criteria(RegistrantEventTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RegistrantEventTableMap::COL_REGISTRANT_ID)) {
            $criteria->add(RegistrantEventTableMap::COL_REGISTRANT_ID, $this->registrant_id);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_TOPIC_ID)) {
            $criteria->add(RegistrantEventTableMap::COL_TOPIC_ID, $this->topic_id);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_COUNTRY_ID)) {
            $criteria->add(RegistrantEventTableMap::COL_COUNTRY_ID, $this->country_id);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_COUNTRY_DESIRED)) {
            $criteria->add(RegistrantEventTableMap::COL_COUNTRY_DESIRED, $this->country_desired);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_INTEREST_TEXT)) {
            $criteria->add(RegistrantEventTableMap::COL_INTEREST_TEXT, $this->interest_text);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_REGISTRATION_TIME)) {
            $criteria->add(RegistrantEventTableMap::COL_REGISTRATION_TIME, $this->registration_time);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_APPROVED)) {
            $criteria->add(RegistrantEventTableMap::COL_APPROVED, $this->approved);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_APPROVED_TIME)) {
            $criteria->add(RegistrantEventTableMap::COL_APPROVED_TIME, $this->approved_time);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_INTEREST_VERIFIED)) {
            $criteria->add(RegistrantEventTableMap::COL_INTEREST_VERIFIED, $this->interest_verified);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_DISCORD_VERIFIED)) {
            $criteria->add(RegistrantEventTableMap::COL_DISCORD_VERIFIED, $this->discord_verified);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_MIC_VERIFIED)) {
            $criteria->add(RegistrantEventTableMap::COL_MIC_VERIFIED, $this->mic_verified);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_LOCAL)) {
            $criteria->add(RegistrantEventTableMap::COL_LOCAL, $this->local);
        }
        if ($this->isColumnModified(RegistrantEventTableMap::COL_HAS_ATTENDED)) {
            $criteria->add(RegistrantEventTableMap::COL_HAS_ATTENDED, $this->has_attended);
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
        $criteria = ChildRegistrantEventQuery::create();
        $criteria->add(RegistrantEventTableMap::COL_REGISTRANT_ID, $this->registrant_id);

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

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation registrant_event_ibfk_2 to table registrant
        if ($this->aRegistrant && $hash = spl_object_hash($this->aRegistrant)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

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
     * @param      object $copyObj An object of \db\db\RegistrantEvent (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRegistrantId($this->getRegistrantId());
        $copyObj->setTopicId($this->getTopicId());
        $copyObj->setCountryId($this->getCountryId());
        $copyObj->setCountryDesired($this->getCountryDesired());
        $copyObj->setInterestText($this->getInterestText());
        $copyObj->setRegistrationTime($this->getRegistrationTime());
        $copyObj->setApproved($this->getApproved());
        $copyObj->setApprovedTime($this->getApprovedTime());
        $copyObj->setInterestVerified($this->getInterestVerified());
        $copyObj->setDiscordVerified($this->getDiscordVerified());
        $copyObj->setMicVerified($this->getMicVerified());
        $copyObj->setLocal($this->getLocal());
        $copyObj->setHasAttended($this->getHasAttended());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \db\db\RegistrantEvent Clone of current object.
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
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCountryRelatedByCountryId(ChildCountry $v = null)
    {
        if ($v === null) {
            $this->setCountryId(NULL);
        } else {
            $this->setCountryId($v->getCountryId());
        }

        $this->aCountryRelatedByCountryId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addRegistrantEventRelatedByCountryId($this);
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
    public function getCountryRelatedByCountryId(ConnectionInterface $con = null)
    {
        if ($this->aCountryRelatedByCountryId === null && ($this->country_id != 0)) {
            $this->aCountryRelatedByCountryId = ChildCountryQuery::create()->findPk($this->country_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountryRelatedByCountryId->addRegistrantEventsRelatedByCountryId($this);
             */
        }

        return $this->aCountryRelatedByCountryId;
    }

    /**
     * Declares an association between this object and a ChildRegistrant object.
     *
     * @param  ChildRegistrant $v
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRegistrant(ChildRegistrant $v = null)
    {
        if ($v === null) {
            $this->setRegistrantId(NULL);
        } else {
            $this->setRegistrantId($v->getRegistrantId());
        }

        $this->aRegistrant = $v;

        // Add binding for other direction of this 1:1 relationship.
        if ($v !== null) {
            $v->setRegistrantEvent($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRegistrant object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRegistrant The associated ChildRegistrant object.
     * @throws PropelException
     */
    public function getRegistrant(ConnectionInterface $con = null)
    {
        if ($this->aRegistrant === null && ($this->registrant_id != 0)) {
            $this->aRegistrant = ChildRegistrantQuery::create()->findPk($this->registrant_id, $con);
            // Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
            $this->aRegistrant->setRegistrantEvent($this);
        }

        return $this->aRegistrant;
    }

    /**
     * Declares an association between this object and a ChildTopic object.
     *
     * @param  ChildTopic $v
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTopic(ChildTopic $v = null)
    {
        if ($v === null) {
            $this->setTopicId(NULL);
        } else {
            $this->setTopicId($v->getTopicId());
        }

        $this->aTopic = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTopic object, it will not be re-added.
        if ($v !== null) {
            $v->addRegistrantEvent($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTopic object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTopic The associated ChildTopic object.
     * @throws PropelException
     */
    public function getTopic(ConnectionInterface $con = null)
    {
        if ($this->aTopic === null && ($this->topic_id != 0)) {
            $this->aTopic = ChildTopicQuery::create()->findPk($this->topic_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTopic->addRegistrantEvents($this);
             */
        }

        return $this->aTopic;
    }

    /**
     * Declares an association between this object and a ChildCountry object.
     *
     * @param  ChildCountry $v
     * @return $this|\db\db\RegistrantEvent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCountryRelatedByCountryDesired(ChildCountry $v = null)
    {
        if ($v === null) {
            $this->setCountryDesired(NULL);
        } else {
            $this->setCountryDesired($v->getCountryId());
        }

        $this->aCountryRelatedByCountryDesired = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addRegistrantEventRelatedByCountryDesired($this);
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
    public function getCountryRelatedByCountryDesired(ConnectionInterface $con = null)
    {
        if ($this->aCountryRelatedByCountryDesired === null && ($this->country_desired != 0)) {
            $this->aCountryRelatedByCountryDesired = ChildCountryQuery::create()->findPk($this->country_desired, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountryRelatedByCountryDesired->addRegistrantEventsRelatedByCountryDesired($this);
             */
        }

        return $this->aCountryRelatedByCountryDesired;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCountryRelatedByCountryId) {
            $this->aCountryRelatedByCountryId->removeRegistrantEventRelatedByCountryId($this);
        }
        if (null !== $this->aRegistrant) {
            $this->aRegistrant->removeRegistrantEvent($this);
        }
        if (null !== $this->aTopic) {
            $this->aTopic->removeRegistrantEvent($this);
        }
        if (null !== $this->aCountryRelatedByCountryDesired) {
            $this->aCountryRelatedByCountryDesired->removeRegistrantEventRelatedByCountryDesired($this);
        }
        $this->registrant_id = null;
        $this->topic_id = null;
        $this->country_id = null;
        $this->country_desired = null;
        $this->interest_text = null;
        $this->registration_time = null;
        $this->approved = null;
        $this->approved_time = null;
        $this->interest_verified = null;
        $this->discord_verified = null;
        $this->mic_verified = null;
        $this->local = null;
        $this->has_attended = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
        } // if ($deep)

        $this->aCountryRelatedByCountryId = null;
        $this->aRegistrant = null;
        $this->aTopic = null;
        $this->aCountryRelatedByCountryDesired = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RegistrantEventTableMap::DEFAULT_STRING_FORMAT);
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
