<?php

namespace Base;

use \Client as ChildClient;
use \ClientQuery as ChildClientQuery;
use \Inserted as ChildInserted;
use \InsertedQuery as ChildInsertedQuery;
use \Invoice as ChildInvoice;
use \InvoiceQuery as ChildInvoiceQuery;
use \Typology as ChildTypology;
use \TypologyQuery as ChildTypologyQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\InsertedTableMap;
use Map\InvoiceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'invoice' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Invoice implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\InvoiceTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the print_no field.
     *
     * @var        int
     */
    protected $print_no;

    /**
     * The value for the payment_date field.
     *
     * @var        DateTime
     */
    protected $payment_date;

    /**
     * The value for the creation_date field.
     *
     * @var        DateTime
     */
    protected $creation_date;

    /**
     * The value for the status field.
     *
     * @var        string
     */
    protected $status;

    /**
     * The value for the callback field.
     *
     * @var        int
     */
    protected $callback;

    /**
     * The value for the client_id field.
     *
     * @var        int
     */
    protected $client_id;

    /**
     * The value for the typology_id field.
     *
     * @var        int
     */
    protected $typology_id;

    /**
     * @var        ChildClient
     */
    protected $aClient;

    /**
     * @var        ChildTypology
     */
    protected $aTypology;

    /**
     * @var        ObjectCollection|ChildInserted[] Collection to store aggregation of ChildInserted objects.
     */
    protected $collInserteds;
    protected $collInsertedsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildInserted[]
     */
    protected $insertedsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Invoice object.
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
     * Compares this with another <code>Invoice</code> instance.  If
     * <code>obj</code> is an instance of <code>Invoice</code>, delegates to
     * <code>equals(Invoice)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Invoice The current object, for fluid interface
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [print_no] column value.
     *
     * @return int
     */
    public function getPrintNo()
    {
        return $this->print_no;
    }

    /**
     * Get the [optionally formatted] temporal [payment_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPaymentDate($format = NULL)
    {
        if ($format === null) {
            return $this->payment_date;
        } else {
            return $this->payment_date instanceof \DateTimeInterface ? $this->payment_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [creation_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreationDate($format = NULL)
    {
        if ($format === null) {
            return $this->creation_date;
        } else {
            return $this->creation_date instanceof \DateTimeInterface ? $this->creation_date->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [callback] column value.
     *
     * @return int
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Get the [client_id] column value.
     *
     * @return int
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Get the [typology_id] column value.
     *
     * @return int
     */
    public function getTypologyId()
    {
        return $this->typology_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[InvoiceTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [print_no] column.
     *
     * @param int $v new value
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setPrintNo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->print_no !== $v) {
            $this->print_no = $v;
            $this->modifiedColumns[InvoiceTableMap::COL_PRINT_NO] = true;
        }

        return $this;
    } // setPrintNo()

    /**
     * Sets the value of [payment_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setPaymentDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->payment_date !== null || $dt !== null) {
            if ($this->payment_date === null || $dt === null || $dt->format("Y-m-d") !== $this->payment_date->format("Y-m-d")) {
                $this->payment_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[InvoiceTableMap::COL_PAYMENT_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPaymentDate()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d") !== $this->creation_date->format("Y-m-d")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[InvoiceTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[InvoiceTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [callback] column.
     *
     * @param int $v new value
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setCallback($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->callback !== $v) {
            $this->callback = $v;
            $this->modifiedColumns[InvoiceTableMap::COL_CALLBACK] = true;
        }

        return $this;
    } // setCallback()

    /**
     * Set the value of [client_id] column.
     *
     * @param int $v new value
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setClientId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->client_id !== $v) {
            $this->client_id = $v;
            $this->modifiedColumns[InvoiceTableMap::COL_CLIENT_ID] = true;
        }

        if ($this->aClient !== null && $this->aClient->getId() !== $v) {
            $this->aClient = null;
        }

        return $this;
    } // setClientId()

    /**
     * Set the value of [typology_id] column.
     *
     * @param int $v new value
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function setTypologyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->typology_id !== $v) {
            $this->typology_id = $v;
            $this->modifiedColumns[InvoiceTableMap::COL_TYPOLOGY_ID] = true;
        }

        if ($this->aTypology !== null && $this->aTypology->getId() !== $v) {
            $this->aTypology = null;
        }

        return $this;
    } // setTypologyId()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : InvoiceTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : InvoiceTableMap::translateFieldName('PrintNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_no = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : InvoiceTableMap::translateFieldName('PaymentDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->payment_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : InvoiceTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : InvoiceTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : InvoiceTableMap::translateFieldName('Callback', TableMap::TYPE_PHPNAME, $indexType)];
            $this->callback = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : InvoiceTableMap::translateFieldName('ClientId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->client_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : InvoiceTableMap::translateFieldName('TypologyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->typology_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = InvoiceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Invoice'), 0, $e);
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
        if ($this->aClient !== null && $this->client_id !== $this->aClient->getId()) {
            $this->aClient = null;
        }
        if ($this->aTypology !== null && $this->typology_id !== $this->aTypology->getId()) {
            $this->aTypology = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(InvoiceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildInvoiceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aClient = null;
            $this->aTypology = null;
            $this->collInserteds = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Invoice::setDeleted()
     * @see Invoice::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(InvoiceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildInvoiceQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(InvoiceTableMap::DATABASE_NAME);
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
                InvoiceTableMap::addInstanceToPool($this);
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

            if ($this->aClient !== null) {
                if ($this->aClient->isModified() || $this->aClient->isNew()) {
                    $affectedRows += $this->aClient->save($con);
                }
                $this->setClient($this->aClient);
            }

            if ($this->aTypology !== null) {
                if ($this->aTypology->isModified() || $this->aTypology->isNew()) {
                    $affectedRows += $this->aTypology->save($con);
                }
                $this->setTypology($this->aTypology);
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

            if ($this->insertedsScheduledForDeletion !== null) {
                if (!$this->insertedsScheduledForDeletion->isEmpty()) {
                    \InsertedQuery::create()
                        ->filterByPrimaryKeys($this->insertedsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->insertedsScheduledForDeletion = null;
                }
            }

            if ($this->collInserteds !== null) {
                foreach ($this->collInserteds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
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

        $this->modifiedColumns[InvoiceTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . InvoiceTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(InvoiceTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_PRINT_NO)) {
            $modifiedColumns[':p' . $index++]  = 'print_no';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_PAYMENT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'payment_date';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'creation_date';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_CALLBACK)) {
            $modifiedColumns[':p' . $index++]  = 'callback';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_CLIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'client_id';
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_TYPOLOGY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'typology_id';
        }

        $sql = sprintf(
            'INSERT INTO invoice (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'print_no':
                        $stmt->bindValue($identifier, $this->print_no, PDO::PARAM_INT);
                        break;
                    case 'payment_date':
                        $stmt->bindValue($identifier, $this->payment_date ? $this->payment_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'creation_date':
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'callback':
                        $stmt->bindValue($identifier, $this->callback, PDO::PARAM_INT);
                        break;
                    case 'client_id':
                        $stmt->bindValue($identifier, $this->client_id, PDO::PARAM_INT);
                        break;
                    case 'typology_id':
                        $stmt->bindValue($identifier, $this->typology_id, PDO::PARAM_INT);
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
        $this->setId($pk);

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
        $pos = InvoiceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();
                break;
            case 1:
                return $this->getPrintNo();
                break;
            case 2:
                return $this->getPaymentDate();
                break;
            case 3:
                return $this->getCreationDate();
                break;
            case 4:
                return $this->getStatus();
                break;
            case 5:
                return $this->getCallback();
                break;
            case 6:
                return $this->getClientId();
                break;
            case 7:
                return $this->getTypologyId();
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

        if (isset($alreadyDumpedObjects['Invoice'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Invoice'][$this->hashCode()] = true;
        $keys = InvoiceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPrintNo(),
            $keys[2] => $this->getPaymentDate(),
            $keys[3] => $this->getCreationDate(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getCallback(),
            $keys[6] => $this->getClientId(),
            $keys[7] => $this->getTypologyId(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aClient) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'client';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'client';
                        break;
                    default:
                        $key = 'Client';
                }

                $result[$key] = $this->aClient->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTypology) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'typology';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'typology';
                        break;
                    default:
                        $key = 'Typology';
                }

                $result[$key] = $this->aTypology->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collInserteds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'inserteds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'inserteds';
                        break;
                    default:
                        $key = 'Inserteds';
                }

                $result[$key] = $this->collInserteds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Invoice
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = InvoiceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Invoice
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPrintNo($value);
                break;
            case 2:
                $this->setPaymentDate($value);
                break;
            case 3:
                $this->setCreationDate($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setCallback($value);
                break;
            case 6:
                $this->setClientId($value);
                break;
            case 7:
                $this->setTypologyId($value);
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
        $keys = InvoiceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPrintNo($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPaymentDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreationDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCallback($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setClientId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTypologyId($arr[$keys[7]]);
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
     * @return $this|\Invoice The current object, for fluid interface
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
        $criteria = new Criteria(InvoiceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(InvoiceTableMap::COL_ID)) {
            $criteria->add(InvoiceTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_PRINT_NO)) {
            $criteria->add(InvoiceTableMap::COL_PRINT_NO, $this->print_no);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_PAYMENT_DATE)) {
            $criteria->add(InvoiceTableMap::COL_PAYMENT_DATE, $this->payment_date);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_CREATION_DATE)) {
            $criteria->add(InvoiceTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_STATUS)) {
            $criteria->add(InvoiceTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_CALLBACK)) {
            $criteria->add(InvoiceTableMap::COL_CALLBACK, $this->callback);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_CLIENT_ID)) {
            $criteria->add(InvoiceTableMap::COL_CLIENT_ID, $this->client_id);
        }
        if ($this->isColumnModified(InvoiceTableMap::COL_TYPOLOGY_ID)) {
            $criteria->add(InvoiceTableMap::COL_TYPOLOGY_ID, $this->typology_id);
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
        $criteria = ChildInvoiceQuery::create();
        $criteria->add(InvoiceTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Invoice (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPrintNo($this->getPrintNo());
        $copyObj->setPaymentDate($this->getPaymentDate());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCallback($this->getCallback());
        $copyObj->setClientId($this->getClientId());
        $copyObj->setTypologyId($this->getTypologyId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getInserteds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInserted($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Invoice Clone of current object.
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
     * Declares an association between this object and a ChildClient object.
     *
     * @param  ChildClient $v
     * @return $this|\Invoice The current object (for fluent API support)
     * @throws PropelException
     */
    public function setClient(ChildClient $v = null)
    {
        if ($v === null) {
            $this->setClientId(NULL);
        } else {
            $this->setClientId($v->getId());
        }

        $this->aClient = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildClient object, it will not be re-added.
        if ($v !== null) {
            $v->addInvoice($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildClient object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildClient The associated ChildClient object.
     * @throws PropelException
     */
    public function getClient(ConnectionInterface $con = null)
    {
        if ($this->aClient === null && ($this->client_id != 0)) {
            $this->aClient = ChildClientQuery::create()->findPk($this->client_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aClient->addInvoices($this);
             */
        }

        return $this->aClient;
    }

    /**
     * Declares an association between this object and a ChildTypology object.
     *
     * @param  ChildTypology $v
     * @return $this|\Invoice The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTypology(ChildTypology $v = null)
    {
        if ($v === null) {
            $this->setTypologyId(NULL);
        } else {
            $this->setTypologyId($v->getId());
        }

        $this->aTypology = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTypology object, it will not be re-added.
        if ($v !== null) {
            $v->addInvoice($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTypology object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTypology The associated ChildTypology object.
     * @throws PropelException
     */
    public function getTypology(ConnectionInterface $con = null)
    {
        if ($this->aTypology === null && ($this->typology_id != 0)) {
            $this->aTypology = ChildTypologyQuery::create()->findPk($this->typology_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypology->addInvoices($this);
             */
        }

        return $this->aTypology;
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
        if ('Inserted' == $relationName) {
            $this->initInserteds();
            return;
        }
    }

    /**
     * Clears out the collInserteds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInserteds()
     */
    public function clearInserteds()
    {
        $this->collInserteds = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collInserteds collection loaded partially.
     */
    public function resetPartialInserteds($v = true)
    {
        $this->collInsertedsPartial = $v;
    }

    /**
     * Initializes the collInserteds collection.
     *
     * By default this just sets the collInserteds collection to an empty array (like clearcollInserteds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInserteds($overrideExisting = true)
    {
        if (null !== $this->collInserteds && !$overrideExisting) {
            return;
        }

        $collectionClassName = InsertedTableMap::getTableMap()->getCollectionClassName();

        $this->collInserteds = new $collectionClassName;
        $this->collInserteds->setModel('\Inserted');
    }

    /**
     * Gets an array of ChildInserted objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildInvoice is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildInserted[] List of ChildInserted objects
     * @throws PropelException
     */
    public function getInserteds(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collInsertedsPartial && !$this->isNew();
        if (null === $this->collInserteds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInserteds) {
                // return empty collection
                $this->initInserteds();
            } else {
                $collInserteds = ChildInsertedQuery::create(null, $criteria)
                    ->filterByInvoice($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collInsertedsPartial && count($collInserteds)) {
                        $this->initInserteds(false);

                        foreach ($collInserteds as $obj) {
                            if (false == $this->collInserteds->contains($obj)) {
                                $this->collInserteds->append($obj);
                            }
                        }

                        $this->collInsertedsPartial = true;
                    }

                    return $collInserteds;
                }

                if ($partial && $this->collInserteds) {
                    foreach ($this->collInserteds as $obj) {
                        if ($obj->isNew()) {
                            $collInserteds[] = $obj;
                        }
                    }
                }

                $this->collInserteds = $collInserteds;
                $this->collInsertedsPartial = false;
            }
        }

        return $this->collInserteds;
    }

    /**
     * Sets a collection of ChildInserted objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $inserteds A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildInvoice The current object (for fluent API support)
     */
    public function setInserteds(Collection $inserteds, ConnectionInterface $con = null)
    {
        /** @var ChildInserted[] $insertedsToDelete */
        $insertedsToDelete = $this->getInserteds(new Criteria(), $con)->diff($inserteds);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->insertedsScheduledForDeletion = clone $insertedsToDelete;

        foreach ($insertedsToDelete as $insertedRemoved) {
            $insertedRemoved->setInvoice(null);
        }

        $this->collInserteds = null;
        foreach ($inserteds as $inserted) {
            $this->addInserted($inserted);
        }

        $this->collInserteds = $inserteds;
        $this->collInsertedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Inserted objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Inserted objects.
     * @throws PropelException
     */
    public function countInserteds(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collInsertedsPartial && !$this->isNew();
        if (null === $this->collInserteds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInserteds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInserteds());
            }

            $query = ChildInsertedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByInvoice($this)
                ->count($con);
        }

        return count($this->collInserteds);
    }

    /**
     * Method called to associate a ChildInserted object to this object
     * through the ChildInserted foreign key attribute.
     *
     * @param  ChildInserted $l ChildInserted
     * @return $this|\Invoice The current object (for fluent API support)
     */
    public function addInserted(ChildInserted $l)
    {
        if ($this->collInserteds === null) {
            $this->initInserteds();
            $this->collInsertedsPartial = true;
        }

        if (!$this->collInserteds->contains($l)) {
            $this->doAddInserted($l);

            if ($this->insertedsScheduledForDeletion and $this->insertedsScheduledForDeletion->contains($l)) {
                $this->insertedsScheduledForDeletion->remove($this->insertedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildInserted $inserted The ChildInserted object to add.
     */
    protected function doAddInserted(ChildInserted $inserted)
    {
        $this->collInserteds[]= $inserted;
        $inserted->setInvoice($this);
    }

    /**
     * @param  ChildInserted $inserted The ChildInserted object to remove.
     * @return $this|ChildInvoice The current object (for fluent API support)
     */
    public function removeInserted(ChildInserted $inserted)
    {
        if ($this->getInserteds()->contains($inserted)) {
            $pos = $this->collInserteds->search($inserted);
            $this->collInserteds->remove($pos);
            if (null === $this->insertedsScheduledForDeletion) {
                $this->insertedsScheduledForDeletion = clone $this->collInserteds;
                $this->insertedsScheduledForDeletion->clear();
            }
            $this->insertedsScheduledForDeletion[]= clone $inserted;
            $inserted->setInvoice(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Invoice is new, it will return
     * an empty collection; or if this Invoice has previously
     * been saved, it will retrieve related Inserteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Invoice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildInserted[] List of ChildInserted objects
     */
    public function getInsertedsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildInsertedQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getInserteds($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aClient) {
            $this->aClient->removeInvoice($this);
        }
        if (null !== $this->aTypology) {
            $this->aTypology->removeInvoice($this);
        }
        $this->id = null;
        $this->print_no = null;
        $this->payment_date = null;
        $this->creation_date = null;
        $this->status = null;
        $this->callback = null;
        $this->client_id = null;
        $this->typology_id = null;
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
            if ($this->collInserteds) {
                foreach ($this->collInserteds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collInserteds = null;
        $this->aClient = null;
        $this->aTypology = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(InvoiceTableMap::DEFAULT_STRING_FORMAT);
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
