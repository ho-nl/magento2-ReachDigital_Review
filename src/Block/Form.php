<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Block;

class Form extends \Magento\Review\Block\Form
{
    /**
     * Initialize review form.
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setTemplate('form.phtml');
    }
}
