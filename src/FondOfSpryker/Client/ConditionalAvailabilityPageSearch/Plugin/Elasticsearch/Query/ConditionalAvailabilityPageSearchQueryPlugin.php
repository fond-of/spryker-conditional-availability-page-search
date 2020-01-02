<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\AbstractQuery;
use Elastica\Query\BoolQuery;
use Elastica\Query\Match;
use Elastica\Query\MatchAll;
use Elastica\Query\MultiMatch;
use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringGetterInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Search\SearchConstants;

class ConditionalAvailabilityPageSearchQueryPlugin extends AbstractPlugin implements QueryInterface, SearchStringSetterInterface, SearchStringGetterInterface
{
    /**
     * @var string
     */
    protected $searchString;

    /**
     * @var \Elastica\Query
     */
    protected $query;

    public function __construct()
    {
        $this->query = $this->createSearchQuery();
    }

    /**
     * @return \Elastica\Query
     */
    public function getSearchQuery(): Query
    {
        return $this->query;
    }

    /**
     * @param string $searchString
     *
     * @return void
     */
    public function setSearchString($searchString): void
    {
        $this->searchString = $searchString;
        $this->query = $this->createSearchQuery();
    }

    /**
     * @return string
     */
    public function getSearchString(): string
    {
        return $this->searchString;
    }

    /**
     * @return \Elastica\Query
     */
    protected function createSearchQuery()
    {
        $query = (new Query())
            ->setSource([PageIndexMap::SEARCH_RESULT_DATA]);

        $query = $this->addFulltextSearchToQuery($query);

        return $query;
    }

    /**
     * @param \Elastica\Query $baseQuery
     *
     * @return \Elastica\Query
     */
    protected function addFulltextSearchToQuery(Query $baseQuery): Query
    {
        if (!empty($this->searchString)) {
            $matchQuery = $this->createFulltextSearchQuery($this->searchString);
        } else {
            $matchQuery = new MatchAll();
        }

        return $baseQuery->setQuery($this->createBoolQuery($matchQuery));
    }

    /**
     * @param string $searchString
     *
     * @throws
     *
     * @return \Elastica\Query\AbstractQuery
     */
    protected function createFulltextSearchQuery($searchString): AbstractQuery
    {
        $fields = [
            PageIndexMap::FULL_TEXT,
            PageIndexMap::FULL_TEXT_BOOSTED . '^' . Config::get(SearchConstants::FULL_TEXT_BOOSTED_BOOSTING_VALUE),
        ];

        return (new MultiMatch())
            ->setFields($fields)
            ->setQuery($searchString)
            ->setType(MultiMatch::TYPE_CROSS_FIELDS);
    }

    /**
     * @param \Elastica\Query\AbstractQuery $matchQuery
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function createBoolQuery(AbstractQuery $matchQuery): BoolQuery
    {
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($matchQuery);

        $this->setTypeFilter($boolQuery);

        return $boolQuery;
    }

    /**
     * @param \Elastica\Query\BoolQuery $boolQuery
     *
     * @return void
     */
    protected function setTypeFilter(BoolQuery $boolQuery): void
    {
        $typeFilter = (new Match())
            ->setField(
                PageIndexMap::TYPE,
                ConditionalAvailabilityPageSearchConstants::CONDITIONAL_AVAILABILITY_PERIOD_RESOURCE_NAME
            );

        $boolQuery->addMust($typeFilter);
    }
}
