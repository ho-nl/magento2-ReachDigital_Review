<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Api;

use Ho\Review\Api\Data\ConsiderationInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface RatingConsiderationRepositoryInterface
{
    /**
     * Create or update a Considerations.
     *
     * @param ConsiderationInterface $object
     *
     * @throws CouldNotSaveException
     *
     * @return ConsiderationInterface
     */
    public function save(ConsiderationInterface $object): ConsiderationInterface;

    /**
     * Get Considerations by ID.
     *
     * @param $id
     *
     * @throws NoSuchEntityException
     *
     * @return ConsiderationInterface
     */
    public function getById($id): ConsiderationInterface;

    /**
     * Retrieve all Considerations for entity type.
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResultsInterface;

    /**
     * Delete Consideration.
     *
     * @param ConsiderationInterface $object
     *
     * @throws CouldNotDeleteException
     *
     * @return bool
     */
    public function delete(ConsiderationInterface $object): bool;

    /**
     * Delete Consideration by ID.
     *
     * @param $id
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     *
     * @return bool
     */
    public function deleteById($id): bool;
}
