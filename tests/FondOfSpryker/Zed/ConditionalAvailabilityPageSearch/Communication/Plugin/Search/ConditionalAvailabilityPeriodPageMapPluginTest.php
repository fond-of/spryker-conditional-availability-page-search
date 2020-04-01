<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Search;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageMapExpanderPluginInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class ConditionalAvailabilityPeriodPageMapPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\Plugin\Search\ConditionalAvailabilityPeriodPageMapPlugin
     */
    protected $conditionalAvailabilityPeriodPageMapPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface
     */
    protected $pageMapBuilderInterfaceMock;

    /**
     * @var array
     */
    protected $pageMapData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Communication\ConditionalAvailabilityPageSearchCommunicationFactory
     */
    protected $conditionalAvailabilityPageSearchCommunicationFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface
     */
    protected $conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @var string
     */
    protected $storeName;

    /**
     * @var string
     */
    protected $localeName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageMapExpanderPluginInterface
     */
    protected $conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMock;

    /**
     * @var array|\FondOfSpryker\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageMapExpanderPluginInterface[]
     */
    protected $conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PageMapTransfer
     */
    protected $pageMapTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->pageMapBuilderInterfaceMock = $this->getMockBuilder(PageMapBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMapData = [
            ConditionalAvailabilityPeriodPageSearchTransfer::STORE_NAME => 'new-store-name',
            'sku' => 'sku',
            'start_at' => '2019-07-09 15:06:11.734023',
            'end_at' => '2019-07-11 15:06:11.734023',
            'quantity' => 1,
            'warehouse_group' => 'warehouse_group',
            'is_accessible' => 'is_accessible',
        ];

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchCommunicationFactoryMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeName = 'store-name';

        $this->localeName = 'locale-name';

        $this->conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPeriodPageMapExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMocks = [
            $this->conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMock,
        ];

        $this->conditionalAvailabilityPeriodPageMapPlugin = new ConditionalAvailabilityPeriodPageMapPlugin();
        $this->conditionalAvailabilityPeriodPageMapPlugin->setFactory($this->conditionalAvailabilityPageSearchCommunicationFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertSame(
            ConditionalAvailabilityPageSearchConstants::CONDITIONAL_AVAILABILITY_PERIOD_RESOURCE_NAME,
            $this->conditionalAvailabilityPeriodPageMapPlugin->getName()
        );
    }

    /**
     * @return void
     */
    public function testBuildPageMap(): void
    {
        $this->conditionalAvailabilityPageSearchCommunicationFactoryMock->expects($this->atLeastOnce())
            ->method('getStoreFacade')
            ->willReturn($this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock);

        $this->conditionalAvailabilityPageSearchToStoreFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($this->storeName);

        $this->localeTransferMock->expects($this->atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($this->localeName);

        $this->pageMapBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('addSearchResultData')
            ->willReturnSelf();

        $this->pageMapBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('addFullTextBoosted')
            ->willReturnSelf();

        $this->conditionalAvailabilityPageSearchCommunicationFactoryMock->expects($this->atLeastOnce())
            ->method('getConditionalAvailabilityPeriodPageMapExpanderPlugins')
            ->willReturn($this->conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMocks);

        $this->conditionalAvailabilityPeriodPageMapExpanderPluginInterfaceMock->expects($this->atLeastOnce())
            ->method('expand')
            ->willReturn($this->pageMapTransferMock);

        $this->assertInstanceOf(
            PageMapTransfer::class,
            $this->conditionalAvailabilityPeriodPageMapPlugin->buildPageMap(
                $this->pageMapBuilderInterfaceMock,
                $this->pageMapData,
                $this->localeTransferMock
            )
        );
    }
}
