<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Model\ResourceModel\Rating\Consideration;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Ho\Review\Model\Rating\Consideration::class,
            \Ho\Review\Model\ResourceModel\Rating\Consideration::class
        );
    }
}
