<?php

namespace Base;

use \Invoice as ChildInvoice;
use \InvoiceQuery as ChildInvoiceQuery;
use \Exception;
use \PDO;
use Map\InvoiceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'invoice' table.
 *
 *
 *
 * @method     ChildInvoiceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildInvoiceQuery orderByPrintNo($order = Criteria::ASC) Order by the print_no column
 * @method     ChildInvoiceQuery orderByPaymentDate($order = Criteria::ASC) Order by the payment_date column
 * @method     ChildInvoiceQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildInvoiceQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildInvoiceQuery orderByCallback($order = Criteria::ASC) Order by the callback column
 * @method     ChildInvoiceQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildInvoiceQuery orderByTypologyId($order = Criteria::ASC) Order by the typology_id column
 *
 * @method     ChildInvoiceQuery groupById() Group by the id column
 * @method     ChildInvoiceQuery groupByPrintNo() Group by the print_no column
 * @method     ChildInvoiceQuery groupByPaymentDate() Group by the payment_date column
 * @method     ChildInvoiceQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildInvoiceQuery groupByStatus() Group by the status column
 * @method     ChildInvoiceQuery groupByCallback() Group by the callback column
 * @method     ChildInvoiceQuery groupByClientId() Group by the client_id column
 * @method     ChildInvoiceQuery groupByTypologyId() Group by the typology_id column
 *
 * @method     ChildInvoiceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInvoiceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInvoiceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInvoiceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInvoiceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInvoiceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInvoiceQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method     ChildInvoiceQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method     ChildInvoiceQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method     ChildInvoiceQuery joinWithClient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Client relation
 *
 * @method     ChildInvoiceQuery leftJoinWithClient() Adds a LEFT JOIN clause and with to the query using the Client relation
 * @method     ChildInvoiceQuery rightJoinWithClient() Adds a RIGHT JOIN clause and with to the query using the Client relation
 * @method     ChildInvoiceQuery innerJoinWithClient() Adds a INNER JOIN clause and with to the query using the Client relation
 *
 * @method     ChildInvoiceQuery leftJoinTypology($relationAlias = null) Adds a LEFT JOIN clause to the query using the Typology relation
 * @method     ChildInvoiceQuery rightJoinTypology($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Typology relation
 * @method     ChildInvoiceQuery innerJoinTypology($relationAlias = null) Adds a INNER JOIN clause to the query using the Typology relation
 *
 * @method     ChildInvoiceQuery joinWithTypology($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Typology relation
 *
 * @method     ChildInvoiceQuery leftJoinWithTypology() Adds a LEFT JOIN clause and with to the query using the Typology relation
 * @method     ChildInvoiceQuery rightJoinWithTypology() Adds a RIGHT JOIN clause and with to the query using the Typology relation
 * @method     ChildInvoiceQuery innerJoinWithTypology() Adds a INNER JOIN clause and with to the query using the Typology relation
 *
 * @method     ChildInvoiceQuery leftJoinInserted($relationAlias = null) Adds a LEFT JOIN clause to the query using the Inserted relation
 * @method     ChildInvoiceQuery rightJoinInserted($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Inserted relation
 * @method     ChildInvoiceQuery innerJoinInserted($relationAlias = null) Adds a INNER JOIN clause to the query using the Inserted relation
 *
 * @method     ChildInvoiceQuery joinWithInserted($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Inserted relation
 *
 * @method     ChildInvoiceQuery leftJoinWithInserted() Adds a LEFT JOIN clause and with to the query using the Inserted relation
 * @method     ChildInvoiceQuery rightJoinWithInserted() Adds a RIGHT JOIN clause and with to the query using the Inserted relation
 * @method     ChildInvoiceQuery innerJoinWithInserted() Adds a INNER JOIN clause and with to the query using the Inserted relation
 *
 * @method     \ClientQuery|\TypologyQuery|\InsertedQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInvoice findOne(ConnectionInterface $con = null) Return the first ChildInvoice matching the query
 * @method     ChildInvoice findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInvoice matching the query, or a new ChildInvoice object populated from the query conditions when no match is found
 *
 * @method     ChildInvoice findOneById(int $id) Return the first ChildInvoice filtered by the id column
 * @method     ChildInvoice findOneByPrintNo(int $print_no) Return the first ChildInvoice filtered by the print_no column
 * @method     ChildInvoice findOneByPaymentDate(string $payment_date) Return the first ChildInvoice filtered by the payment_date column
 * @method     ChildInvoice findOneByCreationDate(string $creation_date) Return the first ChildInvoice filtered by the creation_date column
 * @method     ChildInvoice findOneByStatus(string $status) Return the first ChildInvoice filtered by the status column
 * @method     ChildInvoice findOneByCallback(int $callback) Return the first ChildInvoice filtered by the callback column
 * @method     ChildInvoice findOneByClientId(int $client_id) Return the first ChildInvoice filtered by the client_id column
 * @method     ChildInvoice findOneByTypologyId(int $typology_id) Return the first ChildInvoice filtered by the typology_id column *

 * @method     ChildInvoice requirePk($key, ConnectionInterface $con = null) Return the ChildInvoice by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOne(ConnectionInterface $con = null) Return the first ChildInvoice matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInvoice requireOneById(int $id) Return the first ChildInvoice filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByPrintNo(int $print_no) Return the first ChildInvoice filtered by the print_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByPaymentDate(string $payment_date) Return the first ChildInvoice filtered by the payment_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByCreationDate(string $creation_date) Return the first ChildInvoice filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByStatus(string $status) Return the first ChildInvoice filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByCallback(int $callback) Return the first ChildInvoice filtered by the callback column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByClientId(int $client_id) Return the first ChildInvoice filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvoice requireOneByTypologyId(int $typology_id) Return the first ChildInvoice filtered by the typology_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInvoice[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInvoice objects based on current ModelCriteria
 * @method     ChildInvoice[]|ObjectCollection findById(int $id) Return ChildInvoice objects filtered by the id column
 * @method     ChildInvoice[]|ObjectCollection findByPrintNo(int $print_no) Return ChildInvoice objects filtered by the print_no column
 * @method     ChildInvoice[]|ObjectCollection findByPaymentDate(string $payment_date) Return ChildInvoice objects filtered by the payment_date column
 * @method     ChildInvoice[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildInvoice objects filtered by the creation_date column
 * @method     ChildInvoice[]|ObjectCollection findByStatus(string $status) Return ChildInvoice objects filtered by the status column
 * @method     ChildInvoice[]|ObjectCollection findByCallback(int $callback) Return ChildInvoice objects filtered by the callback column
 * @method     ChildInvoice[]|ObjectCollection findByClientId(int $client_id) Return ChildInvoice objects filtered by the client_id column
 * @method     ChildInvoice[]|ObjectCollection findByTypologyId(int $typology_id) Return ChildInvoice objects filtered by the typology_id column
 * @method     ChildInvoice[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InvoiceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InvoiceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'invoices', $modelName = '\\Invoice', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInvoiceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInvoiceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInvoiceQuery) {
            return $criteria;
        }
        $query = new ChildInvoiceQuery();
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
     * @return ChildInvoice|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InvoiceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InvoiceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildInvoice A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, print_no, payment_date, creation_date, status, callback, client_id, typology_id FROM invoice WHERE id = :p0';
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
            /** @var ChildInvoice $obj */
            $obj = new ChildInvoice();
            $obj->hydrate($row);
            InvoiceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildInvoice|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InvoiceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InvoiceTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the print_no column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintNo(1234); // WHERE print_no = 1234
     * $query->filterByPrintNo(array(12, 34)); // WHERE print_no IN (12, 34)
     * $query->filterByPrintNo(array('min' => 12)); // WHERE print_no > 12
     * </code>
     *
     * @param     mixed $printNo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByPrintNo($printNo = null, $comparison = null)
    {
        if (is_array($printNo)) {
            $useMinMax = false;
            if (isset($printNo['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_PRINT_NO, $printNo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($printNo['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_PRINT_NO, $printNo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_PRINT_NO, $printNo, $comparison);
    }

    /**
     * Filter the query on the payment_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentDate('2011-03-14'); // WHERE payment_date = '2011-03-14'
     * $query->filterByPaymentDate('now'); // WHERE payment_date = '2011-03-14'
     * $query->filterByPaymentDate(array('max' => 'yesterday')); // WHERE payment_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $paymentDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByPaymentDate($paymentDate = null, $comparison = null)
    {
        if (is_array($paymentDate)) {
            $useMinMax = false;
            if (isset($paymentDate['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_PAYMENT_DATE, $paymentDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentDate['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_PAYMENT_DATE, $paymentDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_PAYMENT_DATE, $paymentDate, $comparison);
    }

    /**
     * Filter the query on the creation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationDate('2011-03-14'); // WHERE creation_date = '2011-03-14'
     * $query->filterByCreationDate('now'); // WHERE creation_date = '2011-03-14'
     * $query->filterByCreationDate(array('max' => 'yesterday')); // WHERE creation_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the callback column
     *
     * Example usage:
     * <code>
     * $query->filterByCallback(1234); // WHERE callback = 1234
     * $query->filterByCallback(array(12, 34)); // WHERE callback IN (12, 34)
     * $query->filterByCallback(array('min' => 12)); // WHERE callback > 12
     * </code>
     *
     * @param     mixed $callback The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByCallback($callback = null, $comparison = null)
    {
        if (is_array($callback)) {
            $useMinMax = false;
            if (isset($callback['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_CALLBACK, $callback['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($callback['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_CALLBACK, $callback['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_CALLBACK, $callback, $comparison);
    }

    /**
     * Filter the query on the client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClientId(1234); // WHERE client_id = 1234
     * $query->filterByClientId(array(12, 34)); // WHERE client_id IN (12, 34)
     * $query->filterByClientId(array('min' => 12)); // WHERE client_id > 12
     * </code>
     *
     * @see       filterByClient()
     *
     * @param     mixed $clientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (is_array($clientId)) {
            $useMinMax = false;
            if (isset($clientId['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_CLIENT_ID, $clientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientId['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_CLIENT_ID, $clientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the typology_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypologyId(1234); // WHERE typology_id = 1234
     * $query->filterByTypologyId(array(12, 34)); // WHERE typology_id IN (12, 34)
     * $query->filterByTypologyId(array('min' => 12)); // WHERE typology_id > 12
     * </code>
     *
     * @see       filterByTypology()
     *
     * @param     mixed $typologyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByTypologyId($typologyId = null, $comparison = null)
    {
        if (is_array($typologyId)) {
            $useMinMax = false;
            if (isset($typologyId['min'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_TYPOLOGY_ID, $typologyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typologyId['max'])) {
                $this->addUsingAlias(InvoiceTableMap::COL_TYPOLOGY_ID, $typologyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvoiceTableMap::COL_TYPOLOGY_ID, $typologyId, $comparison);
    }

    /**
     * Filter the query by a related \Client object
     *
     * @param \Client|ObjectCollection $client The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof \Client) {
            return $this
                ->addUsingAlias(InvoiceTableMap::COL_CLIENT_ID, $client->getId(), $comparison);
        } elseif ($client instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InvoiceTableMap::COL_CLIENT_ID, $client->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByClient() only accepts arguments of type \Client or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Client relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Client');

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
            $this->addJoinObject($join, 'Client');
        }

        return $this;
    }

    /**
     * Use the Client relation Client object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ClientQuery A secondary query class using the current class as primary query
     */
    public function useClientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\ClientQuery');
    }

    /**
     * Filter the query by a related \Typology object
     *
     * @param \Typology|ObjectCollection $typology The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByTypology($typology, $comparison = null)
    {
        if ($typology instanceof \Typology) {
            return $this
                ->addUsingAlias(InvoiceTableMap::COL_TYPOLOGY_ID, $typology->getId(), $comparison);
        } elseif ($typology instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InvoiceTableMap::COL_TYPOLOGY_ID, $typology->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTypology() only accepts arguments of type \Typology or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Typology relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function joinTypology($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Typology');

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
            $this->addJoinObject($join, 'Typology');
        }

        return $this;
    }

    /**
     * Use the Typology relation Typology object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TypologyQuery A secondary query class using the current class as primary query
     */
    public function useTypologyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTypology($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Typology', '\TypologyQuery');
    }

    /**
     * Filter the query by a related \Inserted object
     *
     * @param \Inserted|ObjectCollection $inserted the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInvoiceQuery The current query, for fluid interface
     */
    public function filterByInserted($inserted, $comparison = null)
    {
        if ($inserted instanceof \Inserted) {
            return $this
                ->addUsingAlias(InvoiceTableMap::COL_ID, $inserted->getInvoiceId(), $comparison);
        } elseif ($inserted instanceof ObjectCollection) {
            return $this
                ->useInsertedQuery()
                ->filterByPrimaryKeys($inserted->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInserted() only accepts arguments of type \Inserted or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Inserted relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function joinInserted($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Inserted');

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
            $this->addJoinObject($join, 'Inserted');
        }

        return $this;
    }

    /**
     * Use the Inserted relation Inserted object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InsertedQuery A secondary query class using the current class as primary query
     */
    public function useInsertedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInserted($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Inserted', '\InsertedQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInvoice $invoice Object to remove from the list of results
     *
     * @return $this|ChildInvoiceQuery The current query, for fluid interface
     */
    public function prune($invoice = null)
    {
        if ($invoice) {
            $this->addUsingAlias(InvoiceTableMap::COL_ID, $invoice->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the invoice table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InvoiceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InvoiceTableMap::clearInstancePool();
            InvoiceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(InvoiceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InvoiceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InvoiceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InvoiceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InvoiceQuery
