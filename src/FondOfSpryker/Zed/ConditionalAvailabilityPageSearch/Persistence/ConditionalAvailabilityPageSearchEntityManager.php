<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence;

use Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer;
use Orm\Zed\ConditionalAvailabilityPageSearch\Persistence\FosConditionalAvailabilityPeriodPageSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchPersistenceFactory getFactory()
 */
class ConditionalAvailabilityPageSearchEntityManager extends AbstractEntityManager implements ConditionalAvailabilityPageSearchEntityManagerInterface
{
    /**
     * @param array $conditionalAvailabilityIds
     *
     * @throws
     *
     * @return void
     */
    public function deleteConditionalAvailabilityPeriodSearchPagesByConditionalAvailabilityIds(
        array $conditionalAvailabilityIds
    ): void {
        $this->getFactory()
            ->createConditionalAvailabilityPeriodPageSearchQuery()
            ->filterByFkConditionalAvailability_In($conditionalAvailabilityIds)
            ->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
     *
     * @throws
     *
     * @return void
     */
    public function createConditionalAvailabilityPeriodPageSearch(
        ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
    ): void {
        $fosConditionalAvailabilityPeriodPageSearch = $this->getFactory()
            ->createConditionalAvailabilityPeriodPageSearchMapper()
            ->mapTransferToEntity(
                $conditionalAvailabilityPeriodPageSearchTransfer,
                new FosConditionalAvailabilityPeriodPageSearch()
            );

        $fosConditionalAvailabilityPeriodPageSearch->save();
    }
}
