<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Model\ResourceModel\Rating\Consideration;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Ho\Review\Model\Rating\Consideration', 'Ho\Review\Model\ResourceModel\Rating\Consideration');
    }
}
