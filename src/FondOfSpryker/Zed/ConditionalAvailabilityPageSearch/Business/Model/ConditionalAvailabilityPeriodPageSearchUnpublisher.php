<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface;

class ConditionalAvailabilityPeriodPageSearchUnpublisher implements ConditionalAvailabilityPeriodPageSearchUnpublisherInterface
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface $entityManager
     */
    public function __construct(ConditionalAvailabilityPageSearchEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array<int> $conditionalAvailabilityIds
     *
     * @return void
     */
    public function unpublish(array $conditionalAvailabilityIds): void
    {
        $this->entityManager->deleteConditionalAvailabilityPeriodSearchPagesByConditionalAvailabilityIds(
            $conditionalAvailabilityIds,
        );
    }
}
