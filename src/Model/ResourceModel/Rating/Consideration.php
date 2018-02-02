<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
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
