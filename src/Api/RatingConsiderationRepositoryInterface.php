<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Api;

use Ho\Review\Model\Rating\ConsiderationInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface RatingConsiderationRepositoryInterface
{
    public function save(ConsiderationInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(ConsiderationInterface $page);

    public function deleteById($id);
}
