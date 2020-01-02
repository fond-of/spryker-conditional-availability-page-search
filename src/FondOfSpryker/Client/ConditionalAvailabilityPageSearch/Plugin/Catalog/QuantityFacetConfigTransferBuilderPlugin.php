<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Catalog;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Catalog\Dependency\Plugin\FacetConfigTransferBuilderPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Shared\Search\SearchConfig;

class QuantityFacetConfigTransferBuilderPlugin extends AbstractPlugin implements FacetConfigTransferBuilderPluginInterface
{
    public const NAME = 'quantity';
    public const PARAMETER_NAME = 'qty';

    /**
     * @return \Generated\Shared\Transfer\FacetConfigTransfer
     */
    public function build(): FacetConfigTransfer
    {
        return (new FacetConfigTransfer())
            ->setName(static::NAME)
            ->setParameterName(static::PARAMETER_NAME)
            ->setFieldName(PageIndexMap::INTEGER_FACET)
            ->setType(SearchConfig::FACET_TYPE_RANGE);
    }
}
