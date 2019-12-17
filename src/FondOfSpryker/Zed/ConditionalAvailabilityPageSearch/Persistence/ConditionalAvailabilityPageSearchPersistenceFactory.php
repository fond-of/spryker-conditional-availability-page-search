<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodPageSearchMapper;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodPageSearchMapperInterface;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery;
use Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosConditionalAvailabilityPeriodPageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchRepositoryInterface getRepository()
 */
class ConditionalAvailabilityPageSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosConditionalAvailabilityPeriodPageSearchQuery
     */
    public function createConditionalAvailabilityPeriodPageSearchQuery(): FosConditionalAvailabilityPeriodPageSearchQuery
    {
        return FosConditionalAvailabilityPeriodPageSearchQuery::create();
    }

    /**
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityPeriodQuery
     */
    public function getConditionalAvailabilityPeriodPropelQuery(): FosConditionalAvailabilityPeriodQuery
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::PROPEL_QUERY_CONDITIONAL_AVAILABILITY_PERIOD);
    }

    /**
     * @return \Orm\Zed\ConditionalAvailability\Persistence\FosConditionalAvailabilityQuery
     */
    public function getConditionalAvailabilityPropelQuery(): FosConditionalAvailabilityQuery
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::PROPEL_QUERY_CONDITIONAL_AVAILABILITY);
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\Propel\Mapper\ConditionalAvailabilityPeriodPageSearchMapperInterface
     */
    public function createConditionalAvailabilityPeriodPageSearchMapper(): ConditionalAvailabilityPeriodPageSearchMapperInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchMapper();
    }
}
