<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Block\Product\View;

use Ho\Review\Api\Data\ConsiderationInterface;
use Ho\Review\Model\ResourceModel\Rating\Consideration\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;

class ListView extends \Magento\Review\Block\Product\View\ListView
{
    /**
     * @var CollectionFactory
     */
    private $considerationCollectionFactory;

    /**
     * ListView constructor.
     *
     * @param \Magento\Catalog\Block\Product\Context                       $context
     * @param \Magento\Framework\Url\EncoderInterface                      $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface                     $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils                        $string
     * @param \Magento\Catalog\Helper\Product                              $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface          $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface                    $localeFormat
     * @param \Magento\Customer\Model\Session                              $customerSession
     * @param ProductRepositoryInterface                                   $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface            $priceCurrency
     * @param \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory
     * @param CollectionFactory                                            $considerationCollectionFactory
     * @param array                                                        $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory,
        CollectionFactory $considerationCollectionFactory,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $collectionFactory,
            $data
        );

        $this->considerationCollectionFactory= $considerationCollectionFactory;
    }

    /**
     * @param   int $reviewId
     *
     * @return  \Ho\Review\Model\ResourceModel\Rating\Consideration\Collection
     */
    public function getProsCollection($reviewId)
    {
        $collection = $this->considerationCollectionFactory->create();
        $collection
            ->addFieldToFilter(ConsiderationInterface::REVIEW_ID, $reviewId)
            ->addFieldToFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_PROS);

        return $collection;
    }

    /**
     * @param   int $reviewId
     *
     * @return  \Ho\Review\Model\ResourceModel\Rating\Consideration\Collection
     */
    public function getConsCollection($reviewId)
    {
        $collection = $this->considerationCollectionFactory->create();
        $collection
            ->addFieldToFilter(ConsiderationInterface::REVIEW_ID, $reviewId)
            ->addFieldToFilter(ConsiderationInterface::TYPE, ConsiderationInterface::CONSIDERATION_CONS);

        return $collection;
    }
}
