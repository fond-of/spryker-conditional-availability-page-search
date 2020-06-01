<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use Generated\Shared\Search\ConditionalAvailabilityPeriodIndexMap;

class ConditionalAvailabilityPeriodPageSearchDataMapper implements ConditionalAvailabilityPeriodPageSearchDataMapperInterface
{
    protected const DATA_KEY_SKU = 'sku';
    protected const DATA_KEY_QUANTITY = 'quantity';
    protected const DATA_KEY_WAREHOUSE_GROUP = 'warehouse_group';
    protected const DATA_KEY_START_AT = 'start_at';
    protected const DATA_KEY_END_AT = 'end_at';
    protected const DATA_KEY_IS_ACCESSIBLE = 'is_accessible';
    protected const DATA_KEY_STORE = 'store';

    protected const SEARCH_RESULT_DATA_KEY_SKU = 'sku';
    protected const SEARCH_RESULT_DATA_KEY_QUANTITY = 'quantity';
    protected const SEARCH_RESULT_DATA_KEY_WAREHOUSE_GROUP = 'warehouse_group';
    protected const SEARCH_RESULT_DATA_KEY_START_AT = 'start_at';
    protected const SEARCH_RESULT_DATA_KEY_END_AT = 'end_at';
    protected const SEARCH_RESULT_DATA_KEY_IS_ACCESSIBLE = 'is_accessible';

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageSearchDataExpanderPluginInterface[]
     */
    protected $conditionalAvailabilityPeriodPageSearchDataExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageSearchDataExpanderPluginInterface[] $conditionalAvailabilityPeriodPageSearchDataExpanderPlugins
     */
    public function __construct(
        ConditionalAvailabilityPageSearchToStoreFacadeInterface $storeFacade,
        array $conditionalAvailabilityPeriodPageSearchDataExpanderPlugins
    ) {
        $this->storeFacade = $storeFacade;
        $this->conditionalAvailabilityPeriodPageSearchDataExpanderPlugins = $conditionalAvailabilityPeriodPageSearchDataExpanderPlugins;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapConditionalAvailabilityPeriodDataToSearchData(
        array $data
    ): array {
        $store = $this->storeFacade->getCurrentStore()->getName();

        if (isset($data[static::DATA_KEY_STORE])) {
            $store = $data[static::DATA_KEY_STORE];
        }

        $searchData = [
            ConditionalAvailabilityPeriodIndexMap::STORE => $store,
            ConditionalAvailabilityPeriodIndexMap::LOCALE => null,
            ConditionalAvailabilityPeriodIndexMap::SKU => $data[static::DATA_KEY_SKU],
            ConditionalAvailabilityPeriodIndexMap::QUANTITY => $data[static::DATA_KEY_QUANTITY],
            ConditionalAvailabilityPeriodIndexMap::WAREHOUSE_GROUP => $data[static::DATA_KEY_WAREHOUSE_GROUP],
            ConditionalAvailabilityPeriodIndexMap::START_AT => $data[static::DATA_KEY_START_AT],
            ConditionalAvailabilityPeriodIndexMap::END_AT => $data[static::DATA_KEY_END_AT],
            ConditionalAvailabilityPeriodIndexMap::IS_ACCESSIBLE => $data[static::DATA_KEY_IS_ACCESSIBLE],
            ConditionalAvailabilityPeriodIndexMap::SEARCH_RESULT_DATA => $this->mapConditionalAvailabilityPeriodDataToSearchResultData($data),
        ];

        $searchData = $this->expandSearchData($data, $searchData);

        return $searchData;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapConditionalAvailabilityPeriodDataToSearchResultData(array $data): array
    {
        return [
            static::SEARCH_RESULT_DATA_KEY_SKU => $data[static::DATA_KEY_SKU],
            static::SEARCH_RESULT_DATA_KEY_QUANTITY => $data[static::DATA_KEY_QUANTITY],
            static::SEARCH_RESULT_DATA_KEY_WAREHOUSE_GROUP => $data[static::DATA_KEY_WAREHOUSE_GROUP],
            static::SEARCH_RESULT_DATA_KEY_START_AT => $data[static::DATA_KEY_START_AT],
            static::SEARCH_RESULT_DATA_KEY_END_AT => $data[static::DATA_KEY_END_AT],
            static::SEARCH_RESULT_DATA_KEY_IS_ACCESSIBLE => $data[static::DATA_KEY_IS_ACCESSIBLE],
        ];
    }

    /**
     * @param array $data
     * @param array $searchData
     *
     * @return array
     */
    protected function expandSearchData(array $data, array $searchData): array
    {
        foreach ($this->conditionalAvailabilityPeriodPageSearchDataExpanderPlugins as $conditionalAvailabilityPeriodPageSearchDataExpanderPlugin) {
            $searchData = $conditionalAvailabilityPeriodPageSearchDataExpanderPlugin->expand($data, $searchData);
        }

        return $searchData;
    }
}
