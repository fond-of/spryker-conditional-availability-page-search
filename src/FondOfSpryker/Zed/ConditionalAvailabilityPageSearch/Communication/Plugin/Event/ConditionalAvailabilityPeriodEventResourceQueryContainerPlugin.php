<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Event;

use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use FondOfSpryker\Zed\ConditionalAvailability\Dependency\ConditionalAvailabilityEvents;
use Orm\Zed\ConditionalAvailability\Persistence\Map\FosConditionalAvailabilityPeriodTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory getFactory()
 */
class ConditionalAvailabilityPeriodEventResourceQueryContainerPlugin extends AbstractPlugin implements EventResourceQueryContainerPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ConditionalAvailabilityPageSearchConstants::CONDITIONAL_AVAILABILITY_PERIOD_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_PERIOD_CREATE;
    }

    /**
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        return FosConditionalAvailabilityPeriodTableMap::COL_FK_CONDITIONAL_AVAILABILITY;
    }

    /**
     * @param int[] $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData(array $ids = []): ?ModelCriteria
    {
        return $this->getQueryContainer()->queryConditionalAvailabilityPeriodsByConditionalAvailabilityIds($ids);
    }
}
