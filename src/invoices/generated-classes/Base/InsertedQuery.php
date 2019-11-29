<?php

namespace Base;

use \Inserted as ChildInserted;
use \InsertedQuery as ChildInsertedQuery;
use \Exception;
use \PDO;
use Map\InsertedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'inserted' table.
 *
 *
 *
 * @method     ChildInsertedQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildInsertedQuery orderByInvoiceId($order = Criteria::ASC) Order by the invoice_id column
 * @method     ChildInsertedQuery orderBySellDate($order = Criteria::ASC) Order by the sell_date column
 * @method     ChildInsertedQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 *
 * @method     ChildInsertedQuery groupByProductId() Group by the product_id column
 * @method     ChildInsertedQuery groupByInvoiceId() Group by the invoice_id column
 * @method     ChildInsertedQuery groupBySellDate() Group by the sell_date column
 * @method     ChildInsertedQuery groupByQuantity() Group by the quantity column
 *
 * @method     ChildInsertedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInsertedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInsertedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInsertedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInsertedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInsertedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInsertedQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildInsertedQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildInsertedQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildInsertedQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildInsertedQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildInsertedQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildInsertedQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildInsertedQuery leftJoinInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Invoice relation
 * @method     ChildInsertedQuery rightJoinInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Invoice relation
 * @method     ChildInsertedQuery innerJoinInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the Invoice relation
 *
 * @method     ChildInsertedQuery joinWithInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Invoice relation
 *
 * @method     ChildInsertedQuery leftJoinWithInvoice() Adds a LEFT JOIN clause and with to the query using the Invoice relation
 * @method     ChildInsertedQuery rightJoinWithInvoice() Adds a RIGHT JOIN clause and with to the query using the Invoice relation
 * @method     ChildInsertedQuery innerJoinWithInvoice() Adds a INNER JOIN clause and with to the query using the Invoice relation
 *
 * @method     \ProductQuery|\InvoiceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInserted findOne(ConnectionInterface $con = null) Return the first ChildInserted matching the query
 * @method     ChildInserted findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInserted matching the query, or a new ChildInserted object populated from the query conditions when no match is found
 *
 * @method     ChildInserted findOneByProductId(int $product_id) Return the first ChildInserted filtered by the product_id column
 * @method     ChildInserted findOneByInvoiceId(int $invoice_id) Return the first ChildInserted filtered by the invoice_id column
 * @method     ChildInserted findOneBySellDate(string $sell_date) Return the first ChildInserted filtered by the sell_date column
 * @method     ChildInserted findOneByQuantity(int $quantity) Return the first ChildInserted filtered by the quantity column *

 * @method     ChildInserted requirePk($key, ConnectionInterface $con = null) Return the ChildInserted by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInserted requireOne(ConnectionInterface $con = null) Return the first ChildInserted matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInserted requireOneByProductId(int $product_id) Return the first ChildInserted filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInserted requireOneByInvoiceId(int $invoice_id) Return the first ChildInserted filtered by the invoice_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInserted requireOneBySellDate(string $sell_date) Return the first ChildInserted filtered by the sell_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInserted requireOneByQuantity(int $quantity) Return the first ChildInserted filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInserted[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInserted objects based on current ModelCriteria
 * @method     ChildInserted[]|ObjectCollection findByProductId(int $product_id) Return ChildInserted objects filtered by the product_id column
 * @method     ChildInserted[]|ObjectCollection findByInvoiceId(int $invoice_id) Return ChildInserted objects filtered by the invoice_id column
 * @method     ChildInserted[]|ObjectCollection findBySellDate(string $sell_date) Return ChildInserted objects filtered by the sell_date column
 * @method     ChildInserted[]|ObjectCollection findByQuantity(int $quantity) Return ChildInserted objects filtered by the quantity column
 * @method     ChildInserted[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InsertedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InsertedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'invoices', $modelName = '\\Inserted', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInsertedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInsertedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInsertedQuery) {
            return $criteria;
        }
        $query = new ChildInsertedQuery();
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
     * @param array[$product_id, $invoice_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildInserted|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InsertedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InsertedTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildInserted A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_id, invoice_id, sell_date, quantity FROM inserted WHERE product_id = :p0 AND invoice_id = :p1';
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
            /** @var ChildInserted $obj */
            $obj = new ChildInserted();
            $obj->hydrate($row);
            InsertedTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildInserted|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(InsertedTableMap::COL_PRODUCT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(InsertedTableMap::COL_INVOICE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(InsertedTableMap::COL_PRODUCT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(InsertedTableMap::COL_INVOICE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @see       filterByProduct()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(InsertedTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(InsertedTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InsertedTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the invoice_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceId(1234); // WHERE invoice_id = 1234
     * $query->filterByInvoiceId(array(12, 34)); // WHERE invoice_id IN (12, 34)
     * $query->filterByInvoiceId(array('min' => 12)); // WHERE invoice_id > 12
     * </code>
     *
     * @see       filterByInvoice()
     *
     * @param     mixed $invoiceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByInvoiceId($invoiceId = null, $comparison = null)
    {
        if (is_array($invoiceId)) {
            $useMinMax = false;
            if (isset($invoiceId['min'])) {
                $this->addUsingAlias(InsertedTableMap::COL_INVOICE_ID, $invoiceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invoiceId['max'])) {
                $this->addUsingAlias(InsertedTableMap::COL_INVOICE_ID, $invoiceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InsertedTableMap::COL_INVOICE_ID, $invoiceId, $comparison);
    }

    /**
     * Filter the query on the sell_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySellDate('2011-03-14'); // WHERE sell_date = '2011-03-14'
     * $query->filterBySellDate('now'); // WHERE sell_date = '2011-03-14'
     * $query->filterBySellDate(array('max' => 'yesterday')); // WHERE sell_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $sellDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function filterBySellDate($sellDate = null, $comparison = null)
    {
        if (is_array($sellDate)) {
            $useMinMax = false;
            if (isset($sellDate['min'])) {
                $this->addUsingAlias(InsertedTableMap::COL_SELL_DATE, $sellDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sellDate['max'])) {
                $this->addUsingAlias(InsertedTableMap::COL_SELL_DATE, $sellDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InsertedTableMap::COL_SELL_DATE, $sellDate, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(InsertedTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(InsertedTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InsertedTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(InsertedTableMap::COL_PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InsertedTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\ProductQuery');
    }

    /**
     * Filter the query by a related \Invoice object
     *
     * @param \Invoice|ObjectCollection $invoice The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInsertedQuery The current query, for fluid interface
     */
    public function filterByInvoice($invoice, $comparison = null)
    {
        if ($invoice instanceof \Invoice) {
            return $this
                ->addUsingAlias(InsertedTableMap::COL_INVOICE_ID, $invoice->getId(), $comparison);
        } elseif ($invoice instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InsertedTableMap::COL_INVOICE_ID, $invoice->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByInvoice() only accepts arguments of type \Invoice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Invoice relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function joinInvoice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Invoice');

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
            $this->addJoinObject($join, 'Invoice');
        }

        return $this;
    }

    /**
     * Use the Invoice relation Invoice object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InvoiceQuery A secondary query class using the current class as primary query
     */
    public function useInvoiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInvoice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Invoice', '\InvoiceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInserted $inserted Object to remove from the list of results
     *
     * @return $this|ChildInsertedQuery The current query, for fluid interface
     */
    public function prune($inserted = null)
    {
        if ($inserted) {
            $this->addCond('pruneCond0', $this->getAliasedColName(InsertedTableMap::COL_PRODUCT_ID), $inserted->getProductId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(InsertedTableMap::COL_INVOICE_ID), $inserted->getInvoiceId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the inserted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InsertedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InsertedTableMap::clearInstancePool();
            InsertedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(InsertedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InsertedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InsertedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InsertedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InsertedQuery
