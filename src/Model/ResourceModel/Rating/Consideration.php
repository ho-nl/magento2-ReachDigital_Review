<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Model\ResourceModel\Rating;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Consideration extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('rating_consideration', 'consideration_id');
    }
}
