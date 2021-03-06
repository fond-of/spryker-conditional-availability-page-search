<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ConditionalAvailabilityPageSearchConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getConditionalAvailabilityPeriodSynchronizationPoolName(): ?string
    {
        return null;
    }

    /**
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }
}
