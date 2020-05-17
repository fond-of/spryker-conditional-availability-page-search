<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch;

use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Dependency\Client\ConditionalAvailabilityPageSearchToCustomerClientInterface;
use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Dependency\Client\ConditionalAvailabilityPageSearchToSearchClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;

class ConditionalAvailabilityPageSearchFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Dependency\Client\ConditionalAvailabilityPageSearchToSearchClientInterface
     */
    public function getSearchClient(): ConditionalAvailabilityPageSearchToSearchClientInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Dependency\Client\ConditionalAvailabilityPageSearchToCustomerClientInterface
     */
    public function getCustomerClient(): ConditionalAvailabilityPageSearchToCustomerClientInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @param string $searchString
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function createSearchQuery(string $searchString): QueryInterface
    {
        $searchQuery = $this->getSearchQueryPlugin();

        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($searchString);
        }

        return $searchQuery;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function getSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::PLUGIN_SEARCH_QUERY
        );
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER
        );
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getSearchResultFormatterPlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER
        );
    }
}
