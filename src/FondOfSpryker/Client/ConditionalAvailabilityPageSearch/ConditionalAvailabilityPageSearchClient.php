<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchFactory getFactory()
 */
class ConditionalAvailabilityPageSearchClient extends AbstractClient implements ConditionalAvailabilityPageSearchClientInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function search(string $searchString, array $requestParameters = []): array
    {
        $searchQuery = $this
            ->getFactory()
            ->createSearchQuery($searchString);

        $searchQuery = $this
            ->getFactory()
            ->getSearchClient()
            ->expandQuery($searchQuery, $this->getFactory()->getSearchQueryExpanderPlugins(), $requestParameters);

        $resultFormatters = $this
            ->getFactory()
            ->getSearchResultFormatterPlugins();

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, $resultFormatters, $requestParameters);
    }
}
