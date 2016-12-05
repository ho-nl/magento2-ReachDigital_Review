<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
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
