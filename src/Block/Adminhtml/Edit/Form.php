<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Block\Adminhtml\Edit;

use \Ho\Review\Helper\Data;

class Form extends \Magento\Review\Block\Adminhtml\Edit\Form
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * Form constructor.
     *
     * @param \Magento\Backend\Block\Template\Context           $context
     * @param \Magento\Framework\Registry                       $registry
     * @param \Magento\Framework\Data\FormFactory               $formFactory
     * @param \Magento\Store\Model\System\Store                 $systemStore
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Catalog\Model\ProductFactory             $productFactory
     * @param \Magento\Review\Helper\Data                       $reviewData
     * @param Data                                              $helper
     * @param array                                             $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Review\Helper\Data $reviewData,
        Data $helper,
        array $data
    ) {
        parent::__construct(
            $context,
            $registry,
            $formFactory,
            $systemStore,
            $customerRepository,
            $productFactory,
            $reviewData,
            $data
        );

        $this->helper = $helper;
    }

    /**
     * Prepare edit review form.
     *
     * @return  Form
     *
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();

        $review = $this->_coreRegistry->registry('review_data');
        $form   = $this->getForm();

        /** Pros */
        $fieldset = $form->addFieldset(
            'considerations_pro',
            ['legend' => __('Pros'), 'class' => 'fieldset-wide']
        );

        /** @var \Magento\Framework\Api\SearchResults $considerationPros */
        $considerationPros  = $review->getConsiderationPros();
        $pros               = $considerationPros->getItems();

        for ($i = 0; $i < $this->helper->getMaxConsiderations(); $i++) {
            $fieldset->addField('consideration_pro_'.$i, 'text', [
                'label'         => __('Pro'),
                'placeholder'   => __('Pro'),
                'required'      => false,
                'name'          => 'consideration[pros]'.($i < $considerationPros->getTotalCount()
                                    ? '[exists]['.$pros[$i]->getId().']'
                                    : '[new][]'),
                'value'         => isset($pros[$i]) ? $pros[$i]->getValue() : ''
            ]);
        }

        /** Cons */
        $fieldset = $form->addFieldset(
            'considerations_con',
            ['legend' => __('Cons'), 'class' => 'fieldset-wide']
        );

        /** @var \Magento\Framework\Api\SearchResults $considerationCons */
        $considerationCons  = $review->getConsiderationCons();
        $cons               = $considerationCons->getItems();

        for ($i = 0; $i < $this->helper->getMaxConsiderations(); $i++) {
            $fieldset->addField('consideration_con_'.$i, 'text', [
                'label'         => __('Con'),
                'placeholder'   => __('Con'),
                'required'      => false,
                'name'          => 'consideration[cons]'.($i < $considerationCons->getTotalCount()
                                    ? '[exists]['.$cons[$i]->getId().']'
                                    : '[new][]'),
                'value'         => isset($cons[$i]) ? $cons[$i]->getValue() : ''
            ]);
        }

        $this->setForm($form);

        return $this;
    }
}
