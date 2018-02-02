<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
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
