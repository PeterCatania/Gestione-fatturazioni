<?php

namespace Base;

use \Client as ChildClient;
use \ClientQuery as ChildClientQuery;
use \Exception;
use \PDO;
use Map\ClientTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'client' table.
 *
 *
 *
 * @method     ChildClientQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildClientQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildClientQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method     ChildClientQuery orderByStreet($order = Criteria::ASC) Order by the street column
 * @method     ChildClientQuery orderByHouseNo($order = Criteria::ASC) Order by the house_no column
 * @method     ChildClientQuery orderByTelephone($order = Criteria::ASC) Order by the telephone column
 * @method     ChildClientQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildClientQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 *
 * @method     ChildClientQuery groupById() Group by the id column
 * @method     ChildClientQuery groupByName() Group by the name column
 * @method     ChildClientQuery groupBySurname() Group by the surname column
 * @method     ChildClientQuery groupByStreet() Group by the street column
 * @method     ChildClientQuery groupByHouseNo() Group by the house_no column
 * @method     ChildClientQuery groupByTelephone() Group by the telephone column
 * @method     ChildClientQuery groupByEmail() Group by the email column
 * @method     ChildClientQuery groupByCityId() Group by the city_id column
 *
 * @method     ChildClientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClientQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClientQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClientQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClientQuery leftJoinCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the City relation
 * @method     ChildClientQuery rightJoinCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the City relation
 * @method     ChildClientQuery innerJoinCity($relationAlias = null) Adds a INNER JOIN clause to the query using the City relation
 *
 * @method     ChildClientQuery joinWithCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the City relation
 *
 * @method     ChildClientQuery leftJoinWithCity() Adds a LEFT JOIN clause and with to the query using the City relation
 * @method     ChildClientQuery rightJoinWithCity() Adds a RIGHT JOIN clause and with to the query using the City relation
 * @method     ChildClientQuery innerJoinWithCity() Adds a INNER JOIN clause and with to the query using the City relation
 *
 * @method     ChildClientQuery leftJoinClientCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the ClientCompany relation
 * @method     ChildClientQuery rightJoinClientCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ClientCompany relation
 * @method     ChildClientQuery innerJoinClientCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the ClientCompany relation
 *
 * @method     ChildClientQuery joinWithClientCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ClientCompany relation
 *
 * @method     ChildClientQuery leftJoinWithClientCompany() Adds a LEFT JOIN clause and with to the query using the ClientCompany relation
 * @method     ChildClientQuery rightJoinWithClientCompany() Adds a RIGHT JOIN clause and with to the query using the ClientCompany relation
 * @method     ChildClientQuery innerJoinWithClientCompany() Adds a INNER JOIN clause and with to the query using the ClientCompany relation
 *
 * @method     ChildClientQuery leftJoinInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Invoice relation
 * @method     ChildClientQuery rightJoinInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Invoice relation
 * @method     ChildClientQuery innerJoinInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the Invoice relation
 *
 * @method     ChildClientQuery joinWithInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Invoice relation
 *
 * @method     ChildClientQuery leftJoinWithInvoice() Adds a LEFT JOIN clause and with to the query using the Invoice relation
 * @method     ChildClientQuery rightJoinWithInvoice() Adds a RIGHT JOIN clause and with to the query using the Invoice relation
 * @method     ChildClientQuery innerJoinWithInvoice() Adds a INNER JOIN clause and with to the query using the Invoice relation
 *
 * @method     \CityQuery|\ClientCompanyQuery|\InvoiceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildClient findOne(ConnectionInterface $con = null) Return the first ChildClient matching the query
 * @method     ChildClient findOneOrCreate(ConnectionInterface $con = null) Return the first ChildClient matching the query, or a new ChildClient object populated from the query conditions when no match is found
 *
 * @method     ChildClient findOneById(int $id) Return the first ChildClient filtered by the id column
 * @method     ChildClient findOneByName(string $name) Return the first ChildClient filtered by the name column
 * @method     ChildClient findOneBySurname(string $surname) Return the first ChildClient filtered by the surname column
 * @method     ChildClient findOneByStreet(string $street) Return the first ChildClient filtered by the street column
 * @method     ChildClient findOneByHouseNo(string $house_no) Return the first ChildClient filtered by the house_no column
 * @method     ChildClient findOneByTelephone(string $telephone) Return the first ChildClient filtered by the telephone column
 * @method     ChildClient findOneByEmail(string $email) Return the first ChildClient filtered by the email column
 * @method     ChildClient findOneByCityId(int $city_id) Return the first ChildClient filtered by the city_id column *

 * @method     ChildClient requirePk($key, ConnectionInterface $con = null) Return the ChildClient by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOne(ConnectionInterface $con = null) Return the first ChildClient matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClient requireOneById(int $id) Return the first ChildClient filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByName(string $name) Return the first ChildClient filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneBySurname(string $surname) Return the first ChildClient filtered by the surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByStreet(string $street) Return the first ChildClient filtered by the street column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByHouseNo(string $house_no) Return the first ChildClient filtered by the house_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByTelephone(string $telephone) Return the first ChildClient filtered by the telephone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByEmail(string $email) Return the first ChildClient filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByCityId(int $city_id) Return the first ChildClient filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClient[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildClient objects based on current ModelCriteria
 * @method     ChildClient[]|ObjectCollection findById(int $id) Return ChildClient objects filtered by the id column
 * @method     ChildClient[]|ObjectCollection findByName(string $name) Return ChildClient objects filtered by the name column
 * @method     ChildClient[]|ObjectCollection findBySurname(string $surname) Return ChildClient objects filtered by the surname column
 * @method     ChildClient[]|ObjectCollection findByStreet(string $street) Return ChildClient objects filtered by the street column
 * @method     ChildClient[]|ObjectCollection findByHouseNo(string $house_no) Return ChildClient objects filtered by the house_no column
 * @method     ChildClient[]|ObjectCollection findByTelephone(string $telephone) Return ChildClient objects filtered by the telephone column
 * @method     ChildClient[]|ObjectCollection findByEmail(string $email) Return ChildClient objects filtered by the email column
 * @method     ChildClient[]|ObjectCollection findByCityId(int $city_id) Return ChildClient objects filtered by the city_id column
 * @method     ChildClient[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ClientQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ClientQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'invoices', $modelName = '\\Client', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClientQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildClientQuery) {
            return $criteria;
        }
        $query = new ChildClientQuery();
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
     * @return ChildClient|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClientTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ClientTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildClient A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, surname, street, house_no, telephone, email, city_id FROM client WHERE id = :p0';
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
            /** @var ChildClient $obj */
            $obj = new ChildClient();
            $obj->hydrate($row);
            ClientTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildClient|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClientTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClientTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the surname column
     *
     * Example usage:
     * <code>
     * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
     * $query->filterBySurname('%fooValue%', Criteria::LIKE); // WHERE surname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $surname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterBySurname($surname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_SURNAME, $surname, $comparison);
    }

    /**
     * Filter the query on the street column
     *
     * Example usage:
     * <code>
     * $query->filterByStreet('fooValue');   // WHERE street = 'fooValue'
     * $query->filterByStreet('%fooValue%', Criteria::LIKE); // WHERE street LIKE '%fooValue%'
     * </code>
     *
     * @param     string $street The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByStreet($street = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_STREET, $street, $comparison);
    }

    /**
     * Filter the query on the house_no column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseNo('fooValue');   // WHERE house_no = 'fooValue'
     * $query->filterByHouseNo('%fooValue%', Criteria::LIKE); // WHERE house_no LIKE '%fooValue%'
     * </code>
     *
     * @param     string $houseNo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByHouseNo($houseNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($houseNo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_HOUSE_NO, $houseNo, $comparison);
    }

    /**
     * Filter the query on the telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone('fooValue');   // WHERE telephone = 'fooValue'
     * $query->filterByTelephone('%fooValue%', Criteria::LIKE); // WHERE telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByTelephone($telephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_TELEPHONE, $telephone, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the city_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCityId(1234); // WHERE city_id = 1234
     * $query->filterByCityId(array(12, 34)); // WHERE city_id IN (12, 34)
     * $query->filterByCityId(array('min' => 12)); // WHERE city_id > 12
     * </code>
     *
     * @see       filterByCity()
     *
     * @param     mixed $cityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_CITY_ID, $cityId, $comparison);
    }

    /**
     * Filter the query by a related \City object
     *
     * @param \City|ObjectCollection $city The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByCity($city, $comparison = null)
    {
        if ($city instanceof \City) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_CITY_ID, $city->getId(), $comparison);
        } elseif ($city instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ClientTableMap::COL_CITY_ID, $city->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCity() only accepts arguments of type \City or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the City relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function joinCity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('City');

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
            $this->addJoinObject($join, 'City');
        }

        return $this;
    }

    /**
     * Use the City relation City object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CityQuery A secondary query class using the current class as primary query
     */
    public function useCityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'City', '\CityQuery');
    }

    /**
     * Filter the query by a related \ClientCompany object
     *
     * @param \ClientCompany|ObjectCollection $clientCompany the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByClientCompany($clientCompany, $comparison = null)
    {
        if ($clientCompany instanceof \ClientCompany) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_ID, $clientCompany->getClientId(), $comparison);
        } elseif ($clientCompany instanceof ObjectCollection) {
            return $this
                ->useClientCompanyQuery()
                ->filterByPrimaryKeys($clientCompany->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByClientCompany() only accepts arguments of type \ClientCompany or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ClientCompany relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function joinClientCompany($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ClientCompany');

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
            $this->addJoinObject($join, 'ClientCompany');
        }

        return $this;
    }

    /**
     * Use the ClientCompany relation ClientCompany object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ClientCompanyQuery A secondary query class using the current class as primary query
     */
    public function useClientCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClientCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ClientCompany', '\ClientCompanyQuery');
    }

    /**
     * Filter the query by a related \Invoice object
     *
     * @param \Invoice|ObjectCollection $invoice the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByInvoice($invoice, $comparison = null)
    {
        if ($invoice instanceof \Invoice) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_ID, $invoice->getClientId(), $comparison);
        } elseif ($invoice instanceof ObjectCollection) {
            return $this
                ->useInvoiceQuery()
                ->filterByPrimaryKeys($invoice->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildClientQuery The current query, for fluid interface
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
     * @param   ChildClient $client Object to remove from the list of results
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function prune($client = null)
    {
        if ($client) {
            $this->addUsingAlias(ClientTableMap::COL_ID, $client->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the client table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClientTableMap::clearInstancePool();
            ClientTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClientTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ClientTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ClientTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ClientQuery
