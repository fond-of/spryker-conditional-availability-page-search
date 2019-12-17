<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence;

use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery;
use Orm\Zed\ConditionalAvailability\Persistence\Map\FosConditionalAvailabilityTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchPersistenceFactory getFactory()
 */
class ConditionalAvailabilityPageSearchQueryContainer extends AbstractQueryContainer implements ConditionalAvailabilityPageSearchQueryContainerInterface
{
    public const VIRTUAL_COLUMN_SKU = 'sku';
    public const VIRTUAL_COLUMN_FK_PRODUCT = 'fk_product';
    public const VIRTUAL_COLUMN_WAREHOUSE_GROUP = 'warehouse_group';
    public const VIRTUAL_COLUMN_IS_ACCESSIBLE = 'is_accessible';

    /**
     * @param int[] $conditionalAvailabilityIds
     *
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery
     */
    public function queryConditionalAvailabilityPeriodsByConditionalAvailabilityIds(
        array $conditionalAvailabilityIds
    ): FosConditionalAvailabilityPeriodQuery {
        $fosConditionalAvailabilityPeriodQuery = $this->getFactory()
            ->getConditionalAvailabilityPeriodPropelQuery()
            ->clear()
            ->useFosConditionalAvailabilityQuery()
                ->innerJoinSpyProduct()
            ->endUse()
            ->withColumn(
                SpyProductTableMap::COL_SKU,
                static::VIRTUAL_COLUMN_SKU
            )
            ->withColumn(
                FosConditionalAvailabilityTableMap::COL_FK_PRODUCT,
                static::VIRTUAL_COLUMN_FK_PRODUCT
            )
            ->withColumn(
                FosConditionalAvailabilityTableMap::COL_WAREHOUSE_GROUP,
                static::VIRTUAL_COLUMN_WAREHOUSE_GROUP
            )
            ->withColumn(
                FosConditionalAvailabilityTableMap::COL_IS_ACCESSIBLE,
                static::VIRTUAL_COLUMN_IS_ACCESSIBLE
            );

        if (empty($conditionalAvailabilityIds)) {
            return $fosConditionalAvailabilityPeriodQuery;
        }

        return $fosConditionalAvailabilityPeriodQuery->filterByFkConditionalAvailability_In(
            $conditionalAvailabilityIds
        );
    }

    /**
     * @param int[] $conditionalAvailabilityIds
     *
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery
     */
    public function queryConditionalAvailabilitiesByConditionalAvailabilityIds(
        array $conditionalAvailabilityIds
    ): FosConditionalAvailabilityQuery {
        $fosConditionalAvailabilityQuery = $this->getFactory()->getConditionalAvailabilityPropelQuery()
            ->clear();

        if (empty($conditionalAvailabilityIds)) {
            return $fosConditionalAvailabilityQuery;
        }

        return $fosConditionalAvailabilityQuery->filterByIdConditionalAvailability_In(
            $conditionalAvailabilityIds
        );
    }
}
