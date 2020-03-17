<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use Spryker\Zed\Kernel\Container;

class ConditionalAvailabilityPageSearchCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory
     */
    protected $conditionalAvailabilityPageSearchCommunicationFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected $conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface
     */
    protected $conditionalAvailabilityPageSearchToEventBehaviorFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchToEventBehaviorFacadeInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchCommunicationFactory = new ConditionalAvailabilityPageSearchCommunicationFactory();
        $this->conditionalAvailabilityPageSearchCommunicationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilityPeriodPageMapExpanderPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_MAP_EXPANDER)
            ->willReturn([]);

        $this->assertIsArray(
            $this->conditionalAvailabilityPageSearchCommunicationFactory->getConditionalAvailabilityPeriodPageMapExpanderPlugins()
        );
    }

    /**
     * @return void
     */
    public function testGetStoreFacade(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityPageSearchDependencyProvider::FACADE_STORE)
            ->willReturn($this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock);

        $this->assertInstanceOf(
            ConditionalAvailabilityPageSearchToStoreFacadeInterface::class,
            $this->conditionalAvailabilityPageSearchCommunicationFactory->getStoreFacade()
        );
    }

    /**
     * @return void
     */
    public function testGetEventBehaviorFacade(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn($this->conditionalAvailabilityPageSearchToEventBehaviorFacadeInterfaceMock);

        $this->assertInstanceOf(
            ConditionalAvailabilityPageSearchToEventBehaviorFacadeInterface::class,
            $this->conditionalAvailabilityPageSearchCommunicationFactory->getEventBehaviorFacade()
        );
    }
}
