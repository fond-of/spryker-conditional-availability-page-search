<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ConditionalAvailabilityPageSearchConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getConditionalAvailabilityPeriodSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;

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
