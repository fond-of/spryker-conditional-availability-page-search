<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Elasticsearch\QueryExpander;

use DateTimeInterface;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Range;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\ConditionalAvailability\Search\PageIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchFactory getFactory()
 */
class EndAtConditionalAvailabilityPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if ($this->hasDate($requestParameters)) {
            $this->addDateFilterToQuery($searchQuery->getSearchQuery(), $this->getDateFrom($requestParameters));
        }

        return $searchQuery;
    }

    /**
     * @param array $requestParameters
     *
     * @return \DateTimeInterface
     */
    protected function getDateFrom(array $requestParameters): DateTimeInterface
    {
        return $requestParameters[ConditionalAvailabilityConstants::PARAMETER_END_AT];
    }

    /**
     * @param array $requestParameters
     *
     * @return bool
     */
    protected function hasDate(array $requestParameters): bool
    {
        return array_key_exists(ConditionalAvailabilityConstants::PARAMETER_END_AT, $requestParameters);
    }

    /**
     * @param \Elastica\Query $query
     * @param \DateTimeInterface $dateTime
     *
     * @return void
     */
    protected function addDateFilterToQuery(Query $query, DateTimeInterface $dateTime): void
    {
        $boolQuery = $this->getBoolQuery($query);

        $rangeEnd = (new Range())->addField(
            PageIndexMap::ENDAT,
            ['lte' => $dateTime->format('Y-m-d H:i:s')]
        );

        $boolQuery->addFilter($rangeEnd);
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'Localized query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
