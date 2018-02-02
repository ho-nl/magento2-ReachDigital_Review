<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Model\Rating;

use Ho\Review\Api\Data\ConsiderationInterface;
use \Magento\Framework\Model\AbstractModel;

class Consideration extends AbstractModel implements ConsiderationInterface
{
    protected function _construct()
    {
        $this->_init(\Ho\Review\Model\ResourceModel\Rating\Consideration::class);
    }
}
