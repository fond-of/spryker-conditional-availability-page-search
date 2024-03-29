<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model;

interface ConditionalAvailabilityPeriodPageSearchPublisherInterface
{
    /**
     * @param array<int> $conditionalAvailabilityIds
     *
     * @return void
     */
    public function publish(array $conditionalAvailabilityIds): void;
}
