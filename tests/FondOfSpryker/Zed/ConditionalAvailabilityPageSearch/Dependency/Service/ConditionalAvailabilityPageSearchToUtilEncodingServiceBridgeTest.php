<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ConditionalAvailabilityPageSearchToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceBridge
     */
    protected $conditionalAvailabilityPageSearchToUtilEncodingServiceBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingServiceInterfaceMock;

    /**
     * @var string
     */
    protected $encodedJsonString;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->utilEncodingServiceInterfaceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->encodedJsonString = 'encoded-json-string';

        $this->value = [];

        $this->conditionalAvailabilityPageSearchToUtilEncodingServiceBridge = new ConditionalAvailabilityPageSearchToUtilEncodingServiceBridge(
            $this->utilEncodingServiceInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $this->utilEncodingServiceInterfaceMock->expects($this->atLeastOnce())
            ->method('encodeJson')
            ->with($this->value)
            ->willReturn($this->encodedJsonString);

        $this->assertSame(
            $this->encodedJsonString,
            $this->conditionalAvailabilityPageSearchToUtilEncodingServiceBridge->encodeJson(
                $this->value,
            ),
        );
    }

    /**
     * @return void
     */
    public function testDecodeJson(): void
    {
        $this->utilEncodingServiceInterfaceMock->expects($this->atLeastOnce())
            ->method('decodeJson')
            ->with($this->encodedJsonString)
            ->willReturn($this->value);

        $this->assertIsArray(
            $this->conditionalAvailabilityPageSearchToUtilEncodingServiceBridge->decodeJson(
                $this->encodedJsonString,
            ),
        );
    }
}
