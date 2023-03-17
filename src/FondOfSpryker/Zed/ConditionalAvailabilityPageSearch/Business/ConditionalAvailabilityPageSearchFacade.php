<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchRepositoryInterface getRepository()
 */
class ConditionalAvailabilityPageSearchFacade extends AbstractFacade implements ConditionalAvailabilityPageSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $concreteIds
     *
     * @return array<int>
     */
    public function getConditionalAvailabilityIdsByConcreteIds(array $concreteIds): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $conditionalAvailabilityIds
     *
     * @return void
     */
    public function publish(array $conditionalAvailabilityIds): void
    {
        $this->getFactory()->createConditionalAvailabilityPeriodPageSearchPublisher()
            ->publish($conditionalAvailabilityIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $conditionalAvailabilityIds
     *
     * @return void
     */
    public function unpublish(array $conditionalAvailabilityIds): void
    {
        $this->getFactory()->createConditionalAvailabilityPeriodPageSearchUnpublisher()
            ->unpublish($conditionalAvailabilityIds);
    }
}
