<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Event\Subscriber;

use FondOfSpryker\Zed\ConditionalAvailability\Dependency\ConditionalAvailabilityEvents;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Event\Listener\ConditionalAvailabilityPageSearchListener;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Event\Listener\ConditionalAvailabilityPeriodPageSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory getFactory()
 */
class ConditionalAvailabilityPageSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface|void
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addConditionalAvailabilityUnPublishListener($eventCollection);
        $this->addConditionalAvailabilityDeleteListener($eventCollection);

        $this->addConditionalAvailabilityPeriodPublishListener($eventCollection);
        $this->addConditionalAvailabilityPeriodCreateListener($eventCollection);
        $this->addConditionalAvailabilityPeriodUpdateListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityUnPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::CONDITIONAL_AVAILABILITY_UNPUBLISH,
            new ConditionalAvailabilityPageSearchListener(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityDeleteListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_DELETE,
            new ConditionalAvailabilityPageSearchListener(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityPeriodPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::CONDITIONAL_AVAILABILITY_PERIOD_PUBLISH,
            new ConditionalAvailabilityPeriodPageSearchListener(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityPeriodCreateListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_PERIOD_CREATE,
            new ConditionalAvailabilityPeriodPageSearchListener(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityPeriodUpdateListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_PERIOD_UPDATE,
            new ConditionalAvailabilityPeriodPageSearchListener(),
        );
    }
}
