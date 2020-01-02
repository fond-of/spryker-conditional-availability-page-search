<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch;

use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Dependency\Client\ConditionalAvailabilityPageSearchToSearchClientBridge;
use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Elasticsearch\Query\ConditionalAvailabilityPageSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ConditionalAvailabilityPageSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const PLUGIN_SEARCH_QUERY = 'PLUGIN_SEARCH_QUERY';
    public const PLUGINS_SEARCH_QUERY_EXPANDER = 'PLUGINS_SEARCH_QUERY_EXPANDER';
    public const PLUGINS_SEARCH_RESULT_FORMATTER = 'PLUGINS_SEARCH_RESULT_FORMATTER';
    public const PLUGINS_FACET_CONFIG_TRANSFER_BUILDER = 'PLUGINS_FACET_CONFIG_TRANSFER_BUILDER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addSearchClient($container);
        $container = $this->addSearchQueryPlugin($container);
        $container = $this->addQueryExpanderPlugins($container);
        $container = $this->addResultFormatterPlugins($container);
        $container = $this->addFacetConfigTransferBuilderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchClient(Container $container): Container
    {
        $container[static::CLIENT_SEARCH] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchToSearchClientBridge(
                $container->getLocator()->search()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchQueryPlugin(Container $container): Container
    {
        $container[static::PLUGIN_SEARCH_QUERY] = static function () {
            return new ConditionalAvailabilityPageSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addQueryExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SEARCH_QUERY_EXPANDER] = static function () use ($self) {
            return $self->getQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addResultFormatterPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SEARCH_RESULT_FORMATTER] = static function () use ($self) {
            return $self->getResultFormatterPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addFacetConfigTransferBuilderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_FACET_CONFIG_TRANSFER_BUILDER] = static function () use ($self) {
            return $self->getFacetConfigTransferBuilderPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function getQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function getResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Client\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\FacetConfigTransferBuilderPluginInterface[]
     */
    protected function getFacetConfigTransferBuilderPlugins(): array
    {
        return [];
    }
}
