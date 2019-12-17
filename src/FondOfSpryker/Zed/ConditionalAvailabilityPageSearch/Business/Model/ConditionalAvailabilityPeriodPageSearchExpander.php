<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer;

class ConditionalAvailabilityPeriodPageSearchExpander implements ConditionalAvailabilityPeriodPageSearchExpanderInterface
{
    protected const KEY_SEPARATOR = ':';

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface $storeFacade
     */
    public function __construct(ConditionalAvailabilityPageSearchToStoreFacadeInterface $storeFacade)
    {
        $this->storeFacade = $storeFacade;
    }

    public function expand(
        ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
    ): ConditionalAvailabilityPeriodPageSearchTransfer {
        $conditionalAvailabilityPeriodPageSearchTransfer = $this->expandWithConditionalAvailabilityPeriodKey(
            $conditionalAvailabilityPeriodPageSearchTransfer
        );

        $conditionalAvailabilityPeriodPageSearchTransfer = $this->expandWithStoreName(
            $conditionalAvailabilityPeriodPageSearchTransfer
        );

        return $conditionalAvailabilityPeriodPageSearchTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer
     */
    protected function expandWithConditionalAvailabilityPeriodKey(
        ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
    ): ConditionalAvailabilityPeriodPageSearchTransfer {
        $concatenatedStartAndEndDate = sprintf(
            '%s - %s',
            $conditionalAvailabilityPeriodPageSearchTransfer->getStartAt(),
            $conditionalAvailabilityPeriodPageSearchTransfer->getEndAt()
        );

        $conditionalAvailabilityPeriodKey = implode(static::KEY_SEPARATOR, [
            $conditionalAvailabilityPeriodPageSearchTransfer->getFkConditionalAvailability(),
            $this->storeFacade->getCurrentStore()->getName(),
            sha1($concatenatedStartAndEndDate),
        ]);

        return $conditionalAvailabilityPeriodPageSearchTransfer->setConditionalAvailabilityPeriodKey(
            $conditionalAvailabilityPeriodKey
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer
     */
    protected function expandWithStoreName(
        ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
    ): ConditionalAvailabilityPeriodPageSearchTransfer {
        return $conditionalAvailabilityPeriodPageSearchTransfer->setStoreName(
            $this->storeFacade->getCurrentStore()->getName()
        );
    }
}
