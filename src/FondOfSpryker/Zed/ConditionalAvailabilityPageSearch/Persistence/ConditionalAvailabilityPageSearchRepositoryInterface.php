<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

interface ConditionalAvailabilityPageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array $conditionalAvailabilityIds
     *
     * @return \Generated\Shared\Transfer\FosConditionalAvailabilityPeriodPageSearchEntityTransfer[]
     */
    public function findFilteredConditionalAvailabilityPeriodPageSearchEntities(
        FilterTransfer $filterTransfer,
        array $conditionalAvailabilityIds = []
    ): array;
}
