<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapper;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapperInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpander;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpanderInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisher;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisherInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisher;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisherInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchRepositoryInterface getRepository()
 */
class ConditionalAvailabilityPageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisherInterface
     */
    public function createConditionalAvailabilityPeriodPageSearchPublisher(): ConditionalAvailabilityPeriodPageSearchPublisherInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchPublisher(
            $this->getQueryContainer(),
            $this->getEntityManager(),
            $this->createConditionalAvailabilityPeriodPageSearchExpander(),
            $this->getUtilEncodingService(),
            $this->createConditionalAvailabilityPeriodPageSearchDataMapper(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisherInterface
     */
    public function createConditionalAvailabilityPeriodPageSearchUnpublisher(): ConditionalAvailabilityPeriodPageSearchUnpublisherInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchUnpublisher($this->getEntityManager());
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapperInterface
     */
    protected function createConditionalAvailabilityPeriodPageSearchDataMapper(): ConditionalAvailabilityPeriodPageSearchDataMapperInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchDataMapper(
            $this->getStoreFacade(),
            $this->getConditionalAvailabilityPeriodPageSearchDataExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpanderInterface
     */
    protected function createConditionalAvailabilityPeriodPageSearchExpander(): ConditionalAvailabilityPeriodPageSearchExpanderInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchExpander(
            $this->getStoreFacade(),
            $this->getConditionalAvailabilityPeriodPageDataExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected function getStoreFacade(): ConditionalAvailabilityPageSearchToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return array<\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface>
     */
    protected function getConditionalAvailabilityPeriodPageDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_DATA_EXPANDER);
    }

    /**
     * @return array<\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageSearchDataExpanderPluginInterface>
     */
    protected function getConditionalAvailabilityPeriodPageSearchDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_SEARCH_DATA_EXPANDER);
    }
}
