<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\SearchExtension;

use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class SortConditionalAvailabilityPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (!isset($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_SORT])) {
            return $searchQuery;
        }

        $query = $searchQuery->getSearchQuery();

        foreach ($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_SORT] as $field => $order) {
            $query->addSort(
                [
                    $field => [
                        'order' => $order,
                    ],
                ]
            );
        }

        return $searchQuery;
    }
}
