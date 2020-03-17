<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisherInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisherInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManager;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainer;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface;
use Spryker\Zed\Kernel\Container;

class ConditionalAvailabilityPageSearchBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\ConditionalAvailabilityPageSearchBusinessFactory
     */
    protected $conditionalAvailabilityPageSearchBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainer
     */
    protected $conditionalAvailabilityPageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManager
     */
    protected $conditionalAvailabilityPageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected $conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface
     */
    protected $conditionalAvailabilityPeriodPageDataExpanderPluginInterfaceMock;

    /**
     * @var array|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface[]
     */
    protected $conditionalAvailabilityPeriodPageDataExpanderPluginInterfaceMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeInterface
     */
    protected $conditionalAvailabilityPageSearchToSearchFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
     */
    protected $conditionalAvailabilityPageSearchToUtilEncodingServiceInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->conditionalAvailabilityPageSearchQueryContainerMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchEntityManagerMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPeriodPageDataExpanderPluginInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPeriodPageDataExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPeriodPageDataExpanderPluginInterfaceMocks = [
            $this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock,
        ];

        $this->conditionalAvailabilityPageSearchToSearchFacadeInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchToSearchFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchToUtilEncodingServiceInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchBusinessFactory = new ConditionalAvailabilityPageSearchBusinessFactory();
        $this->conditionalAvailabilityPageSearchBusinessFactory->setQueryContainer($this->conditionalAvailabilityPageSearchQueryContainerMock);
        $this->conditionalAvailabilityPageSearchBusinessFactory->setEntityManager($this->conditionalAvailabilityPageSearchEntityManagerMock);
        $this->conditionalAvailabilityPageSearchBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityPeriodPageSearchPublisher(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ConditionalAvailabilityPageSearchDependencyProvider::FACADE_STORE],
                [ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_DATA_EXPANDER],
                [ConditionalAvailabilityPageSearchDependencyProvider::FACADE_SEARCH],
                [ConditionalAvailabilityPageSearchDependencyProvider::SERVICE_UTIL_ENCODING]
            )->willReturnOnConsecutiveCalls(
                $this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock,
                $this->conditionalAvailabilityPeriodPageDataExpanderPluginInterfaceMocks,
                $this->conditionalAvailabilityPageSearchToSearchFacadeInterfaceMock,
                $this->conditionalAvailabilityPageSearchToUtilEncodingServiceInterfaceMock
            );

        $this->assertInstanceOf(
            ConditionalAvailabilityPeriodPageSearchPublisherInterface::class,
            $this->conditionalAvailabilityPageSearchBusinessFactory->createConditionalAvailabilityPeriodPageSearchPublisher()
        );
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityPeriodPageSearchUnpublisher(): void
    {
        $this->assertInstanceOf(
            ConditionalAvailabilityPeriodPageSearchUnpublisherInterface::class,
            $this->conditionalAvailabilityPageSearchBusinessFactory->createConditionalAvailabilityPeriodPageSearchUnpublisher()
        );
    }
}
