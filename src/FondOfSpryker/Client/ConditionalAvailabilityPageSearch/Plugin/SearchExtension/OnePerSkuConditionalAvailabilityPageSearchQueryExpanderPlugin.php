<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\SearchExtension;

use Elastica\Collapse;
use Elastica\Query;
use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use Generated\Shared\Search\ConditionalAvailabilityPeriodIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class OnePerSkuConditionalAvailabilityPageSearchQueryExpanderPlugin extends AbstractPlugin implements
    QueryExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @throws \InvalidArgumentException
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (!$this->canExpandQuery($requestParameters)) {
            return $searchQuery;
        }

        $query = $searchQuery->getSearchQuery();

        if (!($query instanceof Query)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Query expander available only with %s, got: %s',
                    Query::class,
                    get_class($query)
                )
            );
        }

        $query->setCollapse(
            (new Collapse())->setFieldname(ConditionalAvailabilityPeriodIndexMap::SKU)
        );

        return $searchQuery;
    }

    /**
     * @param array $requestParameters
     *
     * @return bool
     */
    protected function canExpandQuery(array $requestParameters = []): bool
    {
        return isset($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_ONE_PER_SKU])
            && preg_match('/^(true|false)$/', $requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_ONE_PER_SKU])
            && ((bool)$requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_ONE_PER_SKU]) === true;
    }
}
