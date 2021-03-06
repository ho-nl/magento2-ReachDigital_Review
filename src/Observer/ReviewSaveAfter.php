<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Observer;

use Ho\Review\Api\Data\ConsiderationInterface;
use Ho\Review\Api\RatingConsiderationRepositoryInterface;
use Ho\Review\Helper\Data;
use Ho\Review\Model\Rating\ConsiderationFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ReviewSaveAfter implements ObserverInterface
{
    /** @var RatingConsiderationRepositoryInterface $considerationRepository */
    private $considerationRepository;

    /** @var ConsiderationFactory $ratingConsiderationFactory */
    private $ratingConsiderationFactory;

    /** @var Data $helper */
    private $helper;

    /**
     * @param RatingConsiderationRepositoryInterface $considerationRepository
     * @param ConsiderationFactory                   $ratingConsiderationFactory
     * @param Data                                   $helper
     */
    public function __construct(
        RatingConsiderationRepositoryInterface $considerationRepository,
        ConsiderationFactory $ratingConsiderationFactory,
        Data $helper
    ) {

        $this->considerationRepository = $considerationRepository;
        $this->ratingConsiderationFactory = $ratingConsiderationFactory;
        $this->helper = $helper;
    }

    /**
     * @event review_save_after
     * @param Observer $observer
     *
     * @return ReviewSaveAfter
     */
    public function execute(Observer $observer)
    {
        if (! $this->helper->isEnabled()) {
            return $this;
        }

        /** @var \Magento\Review\Model\Review $review */
        $review = $observer->getData('object');

        foreach ($review->getData('consideration') as $type => $considerations) {
            foreach ($considerations as $status => $consideration) {
                if ($status === 'exists') {
                    foreach ($consideration as $entity_id => $value) {
                        $value = trim($value);

                        // Delete entry if field is made empty.
                        if (empty($value)) {
                            $this->considerationRepository->deleteById($entity_id);
                            continue;
                        }

                        $entity = $this->considerationRepository->getById($entity_id);

                        if ($entity->getData('value') === $value) {
                            continue; // Skip if value hasn't changed.
                        }

                        $entity->setData('value', $value);

                        $this->considerationRepository->save($entity);
                    }
                } elseif ($status === 'new') {
                    foreach ($consideration as $entity_id => $value) {
                        $value = trim($value);

                        if (empty($value)) {
                            continue; // Don't save empty entry.
                        }

                        $entity = $this->ratingConsiderationFactory->create();

                        $entity->setData([
                            'review_id' => $review->getId(),
                            'type'      => $type === 'pros'
                                                ? ConsiderationInterface::CONSIDERATION_PROS
                                                : ConsiderationInterface::CONSIDERATION_CONS,
                            'value'     => $value,
                        ]);

                        $this->considerationRepository->save($entity);
                    }
                }
            }
        }

        return $this;
    }
}
