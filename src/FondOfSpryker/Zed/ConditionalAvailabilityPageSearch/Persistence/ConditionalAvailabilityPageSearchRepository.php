<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchPersistenceFactory getFactory()
 */
class ConditionalAvailabilityPageSearchRepository extends AbstractRepository implements ConditionalAvailabilityPageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param int[] $conditionalAvailabilityIds
     *
     * @return \Generated\Shared\Transfer\FosConditionalAvailabilityPeriodPageSearchEntityTransfer[]
     */
    public function findFilteredConditionalAvailabilityPeriodPageSearchEntities(
        FilterTransfer $filterTransfer,
        array $conditionalAvailabilityIds = []
    ): array {
        $fosConditionalAvailabilityPeriodPageSearchQuery = $this->getFactory()
            ->createConditionalAvailabilityPeriodPageSearchQuery();

        if (!empty($conditionalAvailabilityIds)) {
            $fosConditionalAvailabilityPeriodPageSearchQuery->filterByFkConditionalAvailability_In(
                $conditionalAvailabilityIds
            );
        }

        return $this->buildQueryFromCriteria(
            $fosConditionalAvailabilityPeriodPageSearchQuery,
            $filterTransfer
        )->find();
    }
}
