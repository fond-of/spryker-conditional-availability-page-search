<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchBusinessFactory getFactory()
 */
class ConditionalAvailabilityPageSearchFacade extends AbstractFacade implements ConditionalAvailabilityPageSearchFacadeInterface
{
    /**
     * @inheritDoc
     */
    public function getConditionalAvailabilityIdsByConcreteIds(array $concreteIds): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
