<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Block\Adminhtml\Edit;

class Form extends \Magento\Review\Block\Adminhtml\Edit\Form
{
    /**
     * Prepare edit review form.
     *
     * @return  $this
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();

        $this->getForm($form);

        // Do stuff.

        $this->setForm($form);

        return $this;
    }
}
