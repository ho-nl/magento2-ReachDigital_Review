<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Model\Rating;

use Ho\Review\Model\Rating\ConsiderationInterface;
use Ho\Review\Model\Rating\ConsiderationFactory;
use Ho\Review\Model\ResourceModel\Rating\Consideration\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

class ConsiderationRepository implements \Ho\Review\Api\RatingConsiderationRepositoryInterface
{
    protected $objectFactory;
    protected $collectionFactory;
    protected $searchResultsFactory;

    public function __construct(
        ConsiderationFactory $objectFactory,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory       
    ) {
        $this->objectFactory        = $objectFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }
    
    public function save(ConsiderationInterface $object)
    {
        try
        {
            $object->save();
        }
        catch(Exception $e)
        {
            throw new CouldNotSaveException($e->getMessage());
        }
        return $object;
    }

    public function getById($id)
    {
        $object = $this->objectFactory->create();
        $object->load($id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;        
    }       

    public function delete(ConsiderationInterface $object)
    {
        try {
            $object->delete();
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;    
    }    

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }    

    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);  
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }  
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];                                     
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel;
        }
        $searchResults->setItems($objects);
        return $searchResults;        
    }
}
