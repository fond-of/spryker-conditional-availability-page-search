<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Elasticsearch\QueryExpander;

use DateTime;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Range;
use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use Generated\Shared\Search\PageIndexMap;
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
        if (!isset($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_END_AT])) {
            return $searchQuery;
        }

        $endAt = new DateTime($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_END_AT]);
        $boolQuery = $this->getBoolQuery($searchQuery->getSearchQuery());

        $endAtRange = (new Range())->addField(
            PageIndexMap::END_AT,
            ['lte' => $endAt->format('Y-m-d H:i:s')]
        );

        $boolQuery->addFilter($endAtRange);

        return $searchQuery;
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
