<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Catalog;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Catalog\Dependency\Plugin\FacetConfigTransferBuilderPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Shared\Search\SearchConfig;

class WarehouseGroupFacetConfigTransferBuilderPlugin extends AbstractPlugin implements FacetConfigTransferBuilderPluginInterface
{
    public const NAME = 'warehouse_group';
    public const PARAMETER_NAME = 'warehouseGroup';

    /**
     * @return \Generated\Shared\Transfer\FacetConfigTransfer
     */
    public function build(): FacetConfigTransfer
    {
        return (new FacetConfigTransfer())
            ->setName(static::NAME)
            ->setParameterName(static::PARAMETER_NAME)
            ->setFieldName(PageIndexMap::STRING_FACET)
            ->setType(SearchConfig::FACET_TYPE_ENUMERATION);
    }
}
