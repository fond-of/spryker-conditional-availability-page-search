<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Dependency\Client;

use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

interface ConditionalAvailabilityPageSearchToSearchClientInterface
{
    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[] $resultFormatters
     * @param array $requestParameters
     *
     * @return array|\Elastica\ResultSet
     */
    public function search(
        QueryInterface $searchQuery,
        array $resultFormatters = [],
        array $requestParameters = []
    );

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[] $searchQueryExpanders
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(
        QueryInterface $searchQuery,
        array $searchQueryExpanders,
        array $requestParameters = []
    ): QueryInterface;
}
