<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model;

use DateTime;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer;

class ConditionalAvailabilityPeriodPageSearchExpander implements ConditionalAvailabilityPeriodPageSearchExpanderInterface
{
    /**
     * @var string
     */
    protected const KEY_SEPARATOR = ':';

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var array<\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface>
     */
    protected $conditionalAvailabilityPeriodPageDataExpanderPlugins;

    /**
     * @var \DateTime
     */
    protected $currentDateTime;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface $storeFacade
     * @param array<\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface> $conditionalAvailabilityPeriodPageDataExpanderPlugins
     */
    public function __construct(
        ConditionalAvailabilityPageSearchToStoreFacadeInterface $storeFacade,
        array $conditionalAvailabilityPeriodPageDataExpanderPlugins
    ) {
        $this->storeFacade = $storeFacade;
        $this->conditionalAvailabilityPeriodPageDataExpanderPlugins = $conditionalAvailabilityPeriodPageDataExpanderPlugins;
        $this->currentDateTime = new DateTime();
    }

    /**
     * @param \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer
     */
    public function expand(
        ConditionalAvailabilityPeriodPageSearchTransfer $conditionalAvailabilityPeriodPageSearchTransfer
    ): ConditionalAvailabilityPeriodPageSearchTransfer {
        $conditionalAvailabilityPeriodPageSearchTransfer = $this->expandWithConditionalAvailabilityPeriodKey(
            $conditionalAvailabilityPeriodPageSearchTransfer,
        );

        $conditionalAvailabilityPeriodPageSearchTransfer = $this->expandWithStoreName(
            $conditionalAvailabilityPeriodPageSearchTransfer,
        );

        foreach ($this->conditionalAvailabilityPeriodPageDataExpanderPlugins as $conditionalAvailabilityPeriodPageDataExpanderPlugin) {
            $conditionalAvailabilityPeriodPageSearchTransfer = $conditionalAvailabilityPeriodPageDataExpanderPlugin
                ->expand($conditionalAvailabilityPeriodPageSearchTransfer);
        }

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
            '%s - %s - %s',
            $conditionalAvailabilityPeriodPageSearchTransfer->getStartAt(),
            $conditionalAvailabilityPeriodPageSearchTransfer->getEndAt(),
            $this->currentDateTime->format('Y-m-d H:i:s'),
        );

        $conditionalAvailabilityPeriodKey = implode(static::KEY_SEPARATOR, [
            $conditionalAvailabilityPeriodPageSearchTransfer->getFkConditionalAvailability(),
            $this->storeFacade->getCurrentStore()->getName(),
            sha1($concatenatedStartAndEndDate),
        ]);

        return $conditionalAvailabilityPeriodPageSearchTransfer->setConditionalAvailabilityPeriodKey(
            $conditionalAvailabilityPeriodKey,
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
            $this->storeFacade->getCurrentStore()->getName(),
        );
    }
}
