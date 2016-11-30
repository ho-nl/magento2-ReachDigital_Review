<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Observer;

use Ho\Review\Api\Data\ConsiderationInterface;
use Ho\Review\Api\RatingConsiderationRepositoryInterface;
use Ho\Review\Model\Rating\ConsiderationFactory;
use Ho\Review\Model\ResourceModel\Rating\Consideration\CollectionFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ReviewSaveBefore implements ObserverInterface
{
    /**
     * @var RatingConsiderationRepositoryInterface
     */
    private $considerationRepository;

    /**
     * @var ConsiderationFactory
     */
    private $ratingConsiderationFactory;

    /**
     * @var CollectionFactory
     */
    private $considerationCollectionFactory;

    /**
     * ReviewSaveBefore constructor.
     *
     * @param RatingConsiderationRepositoryInterface $considerationRepository
     * @param CollectionFactory                      $considerationCollectionFactory
     * @param ConsiderationFactory                   $ratingConsiderationFactory
     */
    public function __construct(
        RatingConsiderationRepositoryInterface $considerationRepository,
        CollectionFactory $considerationCollectionFactory,
        ConsiderationFactory $ratingConsiderationFactory
    ) {
        $this->considerationRepository          = $considerationRepository;
        $this->ratingConsiderationFactory       = $ratingConsiderationFactory;
        $this->considerationCollectionFactory   = $considerationCollectionFactory;
    }

    /**
     * @param Observer $observer
     *
     * @return ReviewSaveBefore
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Review\Model\Review $review */
        $review = $observer->getObject();

        /** Process pros */
        $collection = $this->considerationCollectionFactory->create();
        $collection
            ->addFieldToFilter(ConsiderationInterface::REVIEW_ID, $review->getId())
            ->addFieldToFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_PROS)
            ->walk('delete');

        $considerationProsArray = explode("\n",$review->getConsiderationPros());
        foreach ($considerationProsArray as $pro) {
            $consideration = $this->ratingConsiderationFactory->create();

            $consideration->setData([
                'review_id' => $review->getId(),
                'type'      => ConsiderationInterface::CONSIDERATION_PROS,
                'value'     => str_replace("\r", '', $pro),
            ]);

            $this->considerationRepository->save($consideration);
        }

        /** Process cons */
        $collection = $this->considerationCollectionFactory->create();
        $collection
            ->addFieldToFilter(ConsiderationInterface::REVIEW_ID, $review->getId())
            ->addFieldToFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_CONS)
            ->walk('delete');

        $considerationConsArray = explode("\n",$review->getConsiderationCons());
        foreach ($considerationConsArray as $con) {
            $consideration = $this->ratingConsiderationFactory->create();

            $consideration->setData([
                'review_id' => $review->getId(),
                'type'      => ConsiderationInterface::CONSIDERATION_PROS,
                'value'     => str_replace("\r", '', $con),
            ]);

            $this->considerationRepository->save($consideration);
        }

        return $this;
    }
}
