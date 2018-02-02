<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @return  bool
     */
    public function isEnabled()
    {
        return (bool) $this->scopeConfig->getValue('ho_review/general/enabled');
    }

    /**
     * @return  int
     */
    public function getMaxConsiderations()
    {
        return (int) $this->scopeConfig->getValue('ho_review/general/max_considerations');
    }
}
