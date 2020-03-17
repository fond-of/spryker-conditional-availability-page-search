<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Search\Business\SearchFacadeInterface;

class ConditionalAvailabilityPageSearchToSearchFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeBridge
     */
    protected $conditionalAvailabilityPageSearchToSearchFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Search\Business\SearchFacadeInterface
     */
    protected $searchFacadeInterfaceMock;

    /**
     * @var array
     */
    protected $documentData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var string
     */
    protected $mapperName;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->searchFacadeInterfaceMock = $this->getMockBuilder(SearchFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->documentData = [];

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapperName = 'mapper-name';

        $this->conditionalAvailabilityPageSearchToSearchFacadeBridge = new ConditionalAvailabilityPageSearchToSearchFacadeBridge(
            $this->searchFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testTransformPageMapToDocumentByMapperName(): void
    {
        $this->searchFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('transformPageMapToDocumentByMapperName')
            ->with($this->documentData, $this->localeTransferMock, $this->mapperName)
            ->willReturn([]);

        $this->assertIsArray(
            $this->conditionalAvailabilityPageSearchToSearchFacadeBridge->transformPageMapToDocumentByMapperName(
                $this->documentData,
                $this->localeTransferMock,
                $this->mapperName
            )
        );
    }
}
