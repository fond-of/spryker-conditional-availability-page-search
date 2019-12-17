<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface ConditionalAvailabilityPageSearchToSearchFacadeInterface
{
    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param string $mapperName
     *
     * @return array
     */
    public function transformPageMapToDocumentByMapperName(
        array $data,
        LocaleTransfer $localeTransfer,
        string $mapperName
    ): array;
}
