<?php

namespace Base;

use \Company as ChildCompany;
use \CompanyQuery as ChildCompanyQuery;
use \Exception;
use \PDO;
use Map\CompanyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'company' table.
 *
 *
 *
 * @method     ChildCompanyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCompanyQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCompanyQuery orderByLogoPath($order = Criteria::ASC) Order by the logo_path column
 * @method     ChildCompanyQuery orderByIban($order = Criteria::ASC) Order by the iban column
 * @method     ChildCompanyQuery orderByStreet($order = Criteria::ASC) Order by the street column
 * @method     ChildCompanyQuery orderByHouseNo($order = Criteria::ASC) Order by the house_no column
 * @method     ChildCompanyQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildCompanyQuery orderBySite($order = Criteria::ASC) Order by the site column
 * @method     ChildCompanyQuery orderByTelefone($order = Criteria::ASC) Order by the telefone column
 * @method     ChildCompanyQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 *
 * @method     ChildCompanyQuery groupById() Group by the id column
 * @method     ChildCompanyQuery groupByName() Group by the name column
 * @method     ChildCompanyQuery groupByLogoPath() Group by the logo_path column
 * @method     ChildCompanyQuery groupByIban() Group by the iban column
 * @method     ChildCompanyQuery groupByStreet() Group by the street column
 * @method     ChildCompanyQuery groupByHouseNo() Group by the house_no column
 * @method     ChildCompanyQuery groupByEmail() Group by the email column
 * @method     ChildCompanyQuery groupBySite() Group by the site column
 * @method     ChildCompanyQuery groupByTelefone() Group by the telefone column
 * @method     ChildCompanyQuery groupByCityId() Group by the city_id column
 *
 * @method     ChildCompanyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCompanyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCompanyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCompanyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCompanyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCompanyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCompanyQuery leftJoinCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the City relation
 * @method     ChildCompanyQuery rightJoinCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the City relation
 * @method     ChildCompanyQuery innerJoinCity($relationAlias = null) Adds a INNER JOIN clause to the query using the City relation
 *
 * @method     ChildCompanyQuery joinWithCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the City relation
 *
 * @method     ChildCompanyQuery leftJoinWithCity() Adds a LEFT JOIN clause and with to the query using the City relation
 * @method     ChildCompanyQuery rightJoinWithCity() Adds a RIGHT JOIN clause and with to the query using the City relation
 * @method     ChildCompanyQuery innerJoinWithCity() Adds a INNER JOIN clause and with to the query using the City relation
 *
 * @method     \CityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCompany findOne(ConnectionInterface $con = null) Return the first ChildCompany matching the query
 * @method     ChildCompany findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCompany matching the query, or a new ChildCompany object populated from the query conditions when no match is found
 *
 * @method     ChildCompany findOneById(int $id) Return the first ChildCompany filtered by the id column
 * @method     ChildCompany findOneByName(string $name) Return the first ChildCompany filtered by the name column
 * @method     ChildCompany findOneByLogoPath(string $logo_path) Return the first ChildCompany filtered by the logo_path column
 * @method     ChildCompany findOneByIban(string $iban) Return the first ChildCompany filtered by the iban column
 * @method     ChildCompany findOneByStreet(string $street) Return the first ChildCompany filtered by the street column
 * @method     ChildCompany findOneByHouseNo(string $house_no) Return the first ChildCompany filtered by the house_no column
 * @method     ChildCompany findOneByEmail(string $email) Return the first ChildCompany filtered by the email column
 * @method     ChildCompany findOneBySite(string $site) Return the first ChildCompany filtered by the site column
 * @method     ChildCompany findOneByTelefone(string $telefone) Return the first ChildCompany filtered by the telefone column
 * @method     ChildCompany findOneByCityId(int $city_id) Return the first ChildCompany filtered by the city_id column *

 * @method     ChildCompany requirePk($key, ConnectionInterface $con = null) Return the ChildCompany by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOne(ConnectionInterface $con = null) Return the first ChildCompany matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompany requireOneById(int $id) Return the first ChildCompany filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByName(string $name) Return the first ChildCompany filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByLogoPath(string $logo_path) Return the first ChildCompany filtered by the logo_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByIban(string $iban) Return the first ChildCompany filtered by the iban column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByStreet(string $street) Return the first ChildCompany filtered by the street column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByHouseNo(string $house_no) Return the first ChildCompany filtered by the house_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByEmail(string $email) Return the first ChildCompany filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneBySite(string $site) Return the first ChildCompany filtered by the site column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByTelefone(string $telefone) Return the first ChildCompany filtered by the telefone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCityId(int $city_id) Return the first ChildCompany filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompany[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCompany objects based on current ModelCriteria
 * @method     ChildCompany[]|ObjectCollection findById(int $id) Return ChildCompany objects filtered by the id column
 * @method     ChildCompany[]|ObjectCollection findByName(string $name) Return ChildCompany objects filtered by the name column
 * @method     ChildCompany[]|ObjectCollection findByLogoPath(string $logo_path) Return ChildCompany objects filtered by the logo_path column
 * @method     ChildCompany[]|ObjectCollection findByIban(string $iban) Return ChildCompany objects filtered by the iban column
 * @method     ChildCompany[]|ObjectCollection findByStreet(string $street) Return ChildCompany objects filtered by the street column
 * @method     ChildCompany[]|ObjectCollection findByHouseNo(string $house_no) Return ChildCompany objects filtered by the house_no column
 * @method     ChildCompany[]|ObjectCollection findByEmail(string $email) Return ChildCompany objects filtered by the email column
 * @method     ChildCompany[]|ObjectCollection findBySite(string $site) Return ChildCompany objects filtered by the site column
 * @method     ChildCompany[]|ObjectCollection findByTelefone(string $telefone) Return ChildCompany objects filtered by the telefone column
 * @method     ChildCompany[]|ObjectCollection findByCityId(int $city_id) Return ChildCompany objects filtered by the city_id column
 * @method     ChildCompany[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CompanyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CompanyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'invoices', $modelName = '\\Company', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCompanyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCompanyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCompanyQuery) {
            return $criteria;
        }
        $query = new ChildCompanyQuery();
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
     * @return ChildCompany|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CompanyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CompanyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCompany A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, logo_path, iban, street, house_no, email, site, telefone, city_id FROM company WHERE id = :p0';
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
            /** @var ChildCompany $obj */
            $obj = new ChildCompany();
            $obj->hydrate($row);
            CompanyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCompany|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CompanyTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CompanyTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the logo_path column
     *
     * Example usage:
     * <code>
     * $query->filterByLogoPath('fooValue');   // WHERE logo_path = 'fooValue'
     * $query->filterByLogoPath('%fooValue%', Criteria::LIKE); // WHERE logo_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $logoPath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByLogoPath($logoPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logoPath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_LOGO_PATH, $logoPath, $comparison);
    }

    /**
     * Filter the query on the iban column
     *
     * Example usage:
     * <code>
     * $query->filterByIban('fooValue');   // WHERE iban = 'fooValue'
     * $query->filterByIban('%fooValue%', Criteria::LIKE); // WHERE iban LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iban The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByIban($iban = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iban)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_IBAN, $iban, $comparison);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByStreet($street = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_STREET, $street, $comparison);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByHouseNo($houseNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($houseNo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_HOUSE_NO, $houseNo, $comparison);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the site column
     *
     * Example usage:
     * <code>
     * $query->filterBySite('fooValue');   // WHERE site = 'fooValue'
     * $query->filterBySite('%fooValue%', Criteria::LIKE); // WHERE site LIKE '%fooValue%'
     * </code>
     *
     * @param     string $site The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterBySite($site = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($site)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_SITE, $site, $comparison);
    }

    /**
     * Filter the query on the telefone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefone('fooValue');   // WHERE telefone = 'fooValue'
     * $query->filterByTelefone('%fooValue%', Criteria::LIKE); // WHERE telefone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByTelefone($telefone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_TELEFONE, $telefone, $comparison);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyTableMap::COL_CITY_ID, $cityId, $comparison);
    }

    /**
     * Filter the query by a related \City object
     *
     * @param \City|ObjectCollection $city The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCompanyQuery The current query, for fluid interface
     */
    public function filterByCity($city, $comparison = null)
    {
        if ($city instanceof \City) {
            return $this
                ->addUsingAlias(CompanyTableMap::COL_CITY_ID, $city->getId(), $comparison);
        } elseif ($city instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CompanyTableMap::COL_CITY_ID, $city->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCompanyQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCompany $company Object to remove from the list of results
     *
     * @return $this|ChildCompanyQuery The current query, for fluid interface
     */
    public function prune($company = null)
    {
        if ($company) {
            $this->addUsingAlias(CompanyTableMap::COL_ID, $company->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the company table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompanyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CompanyTableMap::clearInstancePool();
            CompanyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CompanyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CompanyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CompanyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CompanyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CompanyQuery
