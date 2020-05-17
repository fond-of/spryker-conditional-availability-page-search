<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Search;

use DateTime;
use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;
use Spryker\Zed\Search\Dependency\Plugin\NamedPageMapInterface;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory getFactory()
 */
class ConditionalAvailabilityPeriodPageMapPlugin extends AbstractPlugin implements NamedPageMapInterface
{
    protected const TYPE_CONDITIONAL_AVAILABILITY_PERIOD = 'conditional_availability_period';

    protected const DATA_KEY_SKU = 'sku';
    protected const DATA_KEY_QUANTITY = 'quantity';
    protected const DATA_KEY_WAREHOUSE_GROUP = 'warehouse_group';
    protected const DATA_KEY_START_AT = 'start_at';
    protected const DATA_KEY_END_AT = 'end_at';
    protected const DATA_KEY_IS_ACCESSIBLE = 'is_accessible';

    protected const KEY_SKU = 'sku';
    protected const KEY_QUANTITY = 'quantity';
    protected const KEY_WAREHOUSE_GROUP = 'warehouse_group';
    protected const KEY_START_AT = 'start_at';
    protected const KEY_END_AT = 'end_at';
    protected const KEY_IS_ACCESSIBLE = 'is_accessible';

    /**
     * @return string
     */
    public function getName(): string
    {
        return ConditionalAvailabilityPageSearchConstants::CONDITIONAL_AVAILABILITY_PERIOD_RESOURCE_NAME;
    }

    /**
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function buildPageMap(PageMapBuilderInterface $pageMapBuilder, array $data, LocaleTransfer $locale): PageMapTransfer
    {
        $store = $this->getFactory()->getStoreFacade()->getCurrentStore()->getName();

        if (isset($data[ConditionalAvailabilityPeriodPageSearchTransfer::STORE_NAME])) {
            $store = $data[ConditionalAvailabilityPeriodPageSearchTransfer::STORE_NAME];
        }

        $pageMapTransfer = (new PageMapTransfer())
            ->setStore($store)
            ->setLocale($locale->getLocaleName())
            ->setType(static::TYPE_CONDITIONAL_AVAILABILITY_PERIOD)
            ->setIsActive(true)
            ->setSku($data[static::DATA_KEY_SKU])
            ->setStartAt((new DateTime($data[static::DATA_KEY_START_AT]))->format('Y-m-d H:i:s'))
            ->setEndAt((new DateTime($data[static::DATA_KEY_END_AT]))->format('Y-m-d H:i:s'))
            ->setQuantity($data[static::DATA_KEY_QUANTITY])
            ->setWarehouseGroup($data[static::DATA_KEY_WAREHOUSE_GROUP])
            ->setIsAccessible($data[static::DATA_KEY_IS_ACCESSIBLE]);

        $pageMapBuilder->addSearchResultData($pageMapTransfer, static::KEY_SKU, $data[static::DATA_KEY_SKU])
            ->addSearchResultData($pageMapTransfer, static::KEY_QUANTITY, $data[static::DATA_KEY_QUANTITY])
            ->addSearchResultData($pageMapTransfer, static::KEY_WAREHOUSE_GROUP, $data[static::DATA_KEY_WAREHOUSE_GROUP])
            ->addSearchResultData($pageMapTransfer, static::KEY_IS_ACCESSIBLE, $data[static::DATA_KEY_IS_ACCESSIBLE])
            ->addSearchResultData($pageMapTransfer, static::KEY_START_AT, $data[static::DATA_KEY_START_AT])
            ->addSearchResultData($pageMapTransfer, static::KEY_END_AT, $data[static::DATA_KEY_END_AT])
            ->addFullTextBoosted($pageMapTransfer, $data[static::DATA_KEY_SKU])
            ->addFullTextBoosted($pageMapTransfer, $data[static::DATA_KEY_WAREHOUSE_GROUP]);

        $pageMapTransfer = $this->expandPageMap($pageMapTransfer, $pageMapBuilder, $data, $locale);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    protected function expandPageMap(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $data,
        LocaleTransfer $locale
    ): PageMapTransfer {
        $conditionalAvailabilityPeriodPageMapExpanderPlugins = $this->getFactory()
            ->getConditionalAvailabilityPeriodPageMapExpanderPlugins();

        foreach ($conditionalAvailabilityPeriodPageMapExpanderPlugins as $conditionalAvailabilityPeriodPageMapExpanderPlugin) {
            $pageMapTransfer = $conditionalAvailabilityPeriodPageMapExpanderPlugin
                ->expand($pageMapTransfer, $pageMapBuilder, $data, $locale);
        }

        return $pageMapTransfer;
    }
}
