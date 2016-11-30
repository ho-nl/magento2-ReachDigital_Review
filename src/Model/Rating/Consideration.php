<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Model\Rating;

use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractModel;

class Consideration extends AbstractModel implements ConsiderationInterface, IdentityInterface
{
    /**
     * Cache tag.
     */
    const CACHE_TAG = 'ho_review_rating/consideration';

    /**
     * Event prefix for observer.
     *
     * @var string
     */
    protected $_eventPrefix = 'review_consideration';

    protected function _construct()
    {
        $this->_init('Ho\Review\Model\ResourceModel\Rating\Consideration');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
