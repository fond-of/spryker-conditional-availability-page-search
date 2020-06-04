<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Event\Listener;

use FondOfSpryker\Zed\ConditionalAvailability\Dependency\ConditionalAvailabilityEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory getFactory()
 */
class ConditionalAvailabilityPageSearchListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

    /**
     * @param array $eventTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName): void
    {
        $this->preventTransaction();

        $conditionalAvailabilityIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventTransfers);

        if (
            $eventName === ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_DELETE ||
            $eventName === ConditionalAvailabilityEvents::CONDITIONAL_AVAILABILITY_UNPUBLISH
        ) {
            $this->getFacade()->unpublish($conditionalAvailabilityIds);

            return;
        }

        $this->getFacade()->publish($conditionalAvailabilityIds);
    }
}
