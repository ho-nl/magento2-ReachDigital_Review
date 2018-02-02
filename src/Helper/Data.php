<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Helper;

use Ho\Review\Api\Data\ConsiderationInterface;
use Ho\Review\Model\ResourceModel\Rating\Consideration\Collection;
use Ho\Review\Model\ResourceModel\Rating\Consideration\CollectionFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Review\Model\Review;

class Data extends AbstractHelper
{
    /** @var CollectionFactory $considerationCollectionFactory */
    private $considerationCollectionFactory;

    /**
     * @param Context           $context
     * @param CollectionFactory $considerationCollectionFactory
     */
    public function __construct(Context $context, CollectionFactory $considerationCollectionFactory)
    {
        parent::__construct($context);

        $this->considerationCollectionFactory = $considerationCollectionFactory;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue('catalog/review/considerations_enabled');
    }

    /**
     * @return int
     */
    public function getMaxConsiderations(): int
    {
        return (int) $this->scopeConfig->getValue('catalog/review/max_considerations');
    }

    /**
     * @param Review $review
     *
     * @return Collection
     */
    public function getProsCollection(Review $review): Collection
    {
        $collection = $this->considerationCollectionFactory->create();
        $collection
            ->addFieldToFilter(ConsiderationInterface::REVIEW_ID, $review->getId())
            ->addFieldToFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_PROS);

        return $collection;
    }

    /**
     * @param Review $review
     *
     * @return Collection
     */
    public function getConsCollection(Review $review): Collection
    {
        $collection = $this->considerationCollectionFactory->create();
        $collection
            ->addFieldToFilter(ConsiderationInterface::REVIEW_ID, $review->getId())
            ->addFieldToFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_CONS);

        return $collection;
    }
}
