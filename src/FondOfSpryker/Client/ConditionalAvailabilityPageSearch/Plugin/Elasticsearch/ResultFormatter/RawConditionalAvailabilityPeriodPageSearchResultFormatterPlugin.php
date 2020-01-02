<?php

namespace FondOfSpryker\Client\ConditionalAvailabilityPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawConditionalAvailabilityPeriodPageSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'periods';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return array
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): array
    {
        $pages = [];
        $results = $searchResult->getResults();

        foreach ($results as $document) {
            $pages[] = $document->getSource()[PageIndexMap::SEARCH_RESULT_DATA];
        }

        return $pages;
    }
}
