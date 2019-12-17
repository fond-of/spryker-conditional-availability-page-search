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
        $this->addConditionalAvailabilityPublishListener($eventCollection);
        $this->addConditionalAvailabilityUnPublishListener($eventCollection);
        $this->addConditionalAvailabilityCreateListener($eventCollection);
        $this->addConditionalAvailabilityDeleteListener($eventCollection);
        $this->addConditionalAvailabilityUpdateListener($eventCollection);

        $this->addConditionalAvailabilityPeriodPublishListener($eventCollection);
        $this->addConditionalAvailabilityPeriodUnPublishListener($eventCollection);
        $this->addConditionalAvailabilityPeriodCreateListener($eventCollection);
        $this->addConditionalAvailabilityPeriodDeleteListener($eventCollection);
        $this->addConditionalAvailabilityPeriodUpdateListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::CONDITIONAL_AVAILABILITY_PUBLISH,
            new ConditionalAvailabilityPageSearchListener()
        );
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
            new ConditionalAvailabilityPageSearchListener()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityCreateListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_CREATE,
            new ConditionalAvailabilityPageSearchListener()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityUpdateListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_UPDATE,
            new ConditionalAvailabilityPageSearchListener()
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
            new ConditionalAvailabilityPageSearchListener()
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
            new ConditionalAvailabilityPeriodPageSearchListener()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityPeriodUnPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::CONDITIONAL_AVAILABILITY_PERIOD_UNPUBLISH,
            new ConditionalAvailabilityPeriodPageSearchListener()
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
            new ConditionalAvailabilityPeriodPageSearchListener()
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
            new ConditionalAvailabilityPeriodPageSearchListener()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addConditionalAvailabilityPeriodDeleteListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ConditionalAvailabilityEvents::ENTITY_FOS_CONDITIONAL_AVAILABILITY_PERIOD_DELETE,
            new ConditionalAvailabilityPeriodPageSearchListener()
        );
    }
}
