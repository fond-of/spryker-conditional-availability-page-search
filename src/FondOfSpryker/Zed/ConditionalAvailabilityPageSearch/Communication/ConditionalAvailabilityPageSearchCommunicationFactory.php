<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface;
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
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR,
        );
    }
}
