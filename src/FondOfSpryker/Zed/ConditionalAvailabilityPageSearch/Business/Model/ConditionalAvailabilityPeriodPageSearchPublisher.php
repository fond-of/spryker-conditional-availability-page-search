<?php

namespace FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model;

use FondOfSpryker\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface;
use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface;
use Generated\Shared\Transfer\ConditionalAvailabilityPeriodPageSearchTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\ConditionalAvailability\Persistence\Base\FosConditionalAvailabilityPeriod;

class ConditionalAvailabilityPeriodPageSearchPublisher implements ConditionalAvailabilityPeriodPageSearchPublisherInterface
{
    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpanderInterface
     */
    protected $conditionalAvailabilityPeriodPageSearchExpander;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeInterface
     */
    protected $searchFacade;

    /**
     * @var \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface $entityManager
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpanderInterface $conditionalAvailabilityPeriodPageSearchExpander
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToSearchFacadeInterface $searchFacade
     * @param \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(
        ConditionalAvailabilityPageSearchQueryContainerInterface $queryContainer,
        ConditionalAvailabilityPageSearchEntityManagerInterface $entityManager,
        ConditionalAvailabilityPeriodPageSearchExpanderInterface $conditionalAvailabilityPeriodPageSearchExpander,
        ConditionalAvailabilityPageSearchToSearchFacadeInterface $searchFacade,
        ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface $utilEncodingService
    ) {
        $this->queryContainer = $queryContainer;
        $this->entityManager = $entityManager;
        $this->conditionalAvailabilityPeriodPageSearchExpander = $conditionalAvailabilityPeriodPageSearchExpander;
        $this->searchFacade = $searchFacade;
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param int[] $conditionalAvailabilityIds
     *
     * @return void
     */
    public function publish(array $conditionalAvailabilityIds): void
    {
        $fosConditionalAvailabilityPeriodEntities = $this->queryContainer
            ->queryConditionalAvailabilityPeriodsByConditionalAvailabilityIds($conditionalAvailabilityIds)
            ->find()
            ->getData();

        if (count($fosConditionalAvailabilityPeriodEntities) > 0) {
            $this->entityManager->deleteConditionalAvailabilityPeriodSearchPagesByConditionalAvailabilityIds(
                $conditionalAvailabilityIds
            );
        }

        $this->storeData($fosConditionalAvailabilityPeriodEntities);
    }

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\Base\FosConditionalAvailabilityPeriod[] $fosConditionalAvailabilityPeriodEntities
     *
     * @return void
     */
    protected function storeData(array $fosConditionalAvailabilityPeriodEntities): void
    {
        foreach ($fosConditionalAvailabilityPeriodEntities as $fosConditionalAvailabilityPeriodEntity) {
            $this->storeDataSet($fosConditionalAvailabilityPeriodEntity);
        }
    }

    /**
     * @param \Orm\Zed\ConditionalAvailability\Persistence\Base\FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriodEntity
     *
     * @return void
     */
    protected function storeDataSet(FosConditionalAvailabilityPeriod $fosConditionalAvailabilityPeriodEntity): void
    {
        $conditionalAvailabilityPeriodPageSearchTransfer = (new ConditionalAvailabilityPeriodPageSearchTransfer())
            ->fromArray($fosConditionalAvailabilityPeriodEntity->toArray(), true);

        $conditionalAvailabilityPeriodPageSearchTransfer = $this->conditionalAvailabilityPeriodPageSearchExpander
            ->expand($conditionalAvailabilityPeriodPageSearchTransfer);

        $structuredData = $fosConditionalAvailabilityPeriodEntity->toArray();
        $data = $this->mapStructuredDataTohData($structuredData);

        $conditionalAvailabilityPeriodPageSearchTransfer->setData($data)
            ->setStructuredData($this->utilEncodingService->encodeJson($structuredData));

        $this->entityManager->createConditionalAvailabilityPeriodPageSearch(
            $conditionalAvailabilityPeriodPageSearchTransfer
        );
    }

    /**
     * @param array $structuredData
     *
     * @return array
     */
    protected function mapStructuredDataTohData(array $structuredData): array
    {
        return $this->searchFacade->transformPageMapToDocumentByMapperName(
            $structuredData,
            new LocaleTransfer(),
            ConditionalAvailabilityPageSearchConstants::CONDITIONAL_AVAILABILITY_PERIOD_RESOURCE_NAME
        );
    }
}
