<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeBridge;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeBridge;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeBridge;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ConditionalAvailabilityPageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';
    public const FACADE_SEARCH = 'FACADE_SEARCH';
    public const FACADE_STORE = 'FACADE_STORE';

    public const PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_MAP_EXPANDER = 'PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_MAP_EXPANDER';
    public const PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_DATA_EXPANDER = 'PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_DATA_EXPANDER';

    public const PROPEL_QUERY_CONDITIONAL_AVAILABILITY_PERIOD = 'PROPEL_QUERY_CONDITIONAL_AVAILABILITY_PERIOD';
    public const PROPEL_QUERY_CONDITIONAL_AVAILABILITY = 'PROPEL_QUERY_CONDITIONAL_AVAILABILITY';

    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addConditionalAvailabilityPeriodPageDataExpanderPlugins($container);
        $container = $this->addStoreFacade($container);
        $container = $this->addSearchFacade($container);
        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addConditionalAvailabilityPeriodPageMapExpanderPlugins($container);
        $container = $this->addEventBehaviorFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addConditionalAvailabilityPeriodPropelQuery($container);
        $container = $this->addConditionalAvailabilityPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityPeriodPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_CONDITIONAL_AVAILABILITY_PERIOD] = static function () {
            return FosConditionalAvailabilityPeriodQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchToStoreFacadeBridge(
                $container->getLocator()->store()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchFacade(Container $container): Container
    {
        $container[static::FACADE_SEARCH] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchToSearchFacadeBridge(
                $container->getLocator()->search()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityPeriodPageMapExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_MAP_EXPANDER] = static function () use ($self) {
            return $self->getConditionalAvailabilityPeriodPageMapExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageMapExpanderPluginInterface[]
     */
    protected function getConditionalAvailabilityPeriodPageMapExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_CONDITIONAL_AVAILABILITY] = static function () {
            return FosConditionalAvailabilityQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConditionalAvailabilityPeriodPageDataExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_DATA_EXPANDER] = static function () use ($self) {
            return $self->getConditionalAvailabilityPeriodPageDataExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface[]
     */
    protected function getConditionalAvailabilityPeriodPageDataExpanderPlugins(): array
    {
        return [];
    }
}
