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
     * @return  Form
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();

        $review     = $this->_coreRegistry->registry('review_data');
        $form       = $this->getForm();
        $fieldset   = $form->getElement('review_details');

        $fieldset->addField(
            'consideration_pros',
            'textarea',
            ['label' => __('Pros'), 'required' => false, 'name' => 'consideration_pros', 'style' => 'height:6em;', 'note' => 'comment']
        );

        $fieldset->addField(
            'consideration_cons',
            'textarea',
            ['label' => __('Cons'), 'required' => false, 'name' => 'consideration_cons', 'style' => 'height:6em;', 'note' => 'comment']
        );

        $form->addValues(['consideration_pros' => implode("\n", $review->getConsiderationPros())]);
        $form->addValues(['consideration_cons' => implode("\n", $review->getConsiderationCons())]);

        $this->setForm($form);

        return $this;
    }
}
