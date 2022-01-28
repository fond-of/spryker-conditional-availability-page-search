<?php

namespace FondOfSpryker\Shared\ConditionalAvailabilityPageSearch;

interface ConditionalAvailabilityPageSearchConstants
{
    public const CONDITIONAL_AVAILABILITY_SEARCH_QUEUE = 'sync.search.conditional_availability';
    public const CONDITIONAL_AVAILABILITY_SEARCH_ERROR_QUEUE = 'sync.search.conditional_availability.error';
    public const CONDITIONAL_AVAILABILITY_PERIOD_RESOURCE_NAME = 'conditional_availability_period';

    public const PARAMETER_SKU = 'sku';
    public const PARAMETER_END_AT = 'end-at';
    public const PARAMETER_START_AT = 'start-at';
    public const PARAMETER_WAREHOUSE_GROUP = 'warehouse-group';
    public const PARAMETER_ONE_PER_SKU = 'one-per-sku';
    public const PARAMETER_MIN_QTY = 'min-qty';
}
