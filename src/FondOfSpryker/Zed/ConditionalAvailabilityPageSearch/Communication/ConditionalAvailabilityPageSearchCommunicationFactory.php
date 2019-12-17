<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchRepositoryInterface getRepository()
 */
class ConditionalAvailabilityPageSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @throws
     *
     * @return array
     */
    public function getConditionalAvailabilityPeriodPageMapExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_MAP_EXPANDER
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    public function getStoreFacade(): ConditionalAvailabilityPageSearchToStoreFacadeInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::FACADE_STORE
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR
        );
    }
}
