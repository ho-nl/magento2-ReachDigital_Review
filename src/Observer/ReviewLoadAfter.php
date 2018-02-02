<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Observer;

use Ho\Review\Api\Data\ConsiderationInterface;
use Ho\Review\Api\RatingConsiderationRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ReviewLoadAfter implements ObserverInterface
{
    /** @var RatingConsiderationRepositoryInterface $considerationRepository */
    private $considerationRepository;

    /** @var SearchCriteriaBuilder $searchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /**
     * @param RatingConsiderationRepositoryInterface $considerationRepository
     * @param SearchCriteriaBuilder                  $searchCriteriaBuilder
     */
    public function __construct(
        RatingConsiderationRepositoryInterface $considerationRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->considerationRepository = $considerationRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @event review_load_after
     * @param Observer $observer
     *
     * @return ReviewLoadAfter
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Review\Model\Review $review */
        $review = $observer->getObject();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(ConsiderationInterface::REVIEW_ID, $review->getId())
            ->addFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_PROS)
            ->create();

        $considerationProsCollection = $this->considerationRepository->getList($searchCriteria);
        $review->setData('consideration_pros', $considerationProsCollection);

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(ConsiderationInterface::REVIEW_ID, $review->getId())
            ->addFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_CONS)
            ->create();

        $considerationConsCollection = $this->considerationRepository->getList($searchCriteria);
        $review->setData('consideration_cons', $considerationConsCollection);

        return $this;
    }
}
