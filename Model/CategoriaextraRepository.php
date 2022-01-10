<?php

namespace Opiquad\Categoriaextra\Model;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface;
use Opiquad\Categoriaextra\Api\Data\CategoriaextraSearchResultInterfaceFactory;
use Opiquad\Categoriaextra\Api\CategoriaextraRepositoryInterface;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra\CollectionFactory;


class CategoriaextraRepository implements CategoriaextraRepositoryInterface
{

    /**
     * @var CategoryextraFactory
     */
    private $categoriaextraFactory;

    /**
     * @var Categoriaextra
     */
    private $categoriaextraResource;

    /**
     * @var CategoriaextraCollectionFactory
     */
    private $categoriaextraCollectionFactory;

    /**
     * @var CategoriaextraSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;


    public function __construct(
        CategoryextraFactory $categoriaFactory,
        Categoryextra $categoriaextraResource,
        CollectionFactory $categoriaextraCollectionFactory,
        CategoriaextraSearchResultInterfaceFactory $categoriaextraSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->categoriaextraFactory = $categoriaFactory;
        $this->categoriaextraResource = $categoriaextraResource;
        $this->categoriaextraCollectionFactory = $categoriaextraCollectionFactory;
        $this->searchResultFactory = $categoriaextraSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }



    public function getById($id)
    {

        $categoriaextra = $this->categoriaextraFactory->create();
        $this->categoriaextraResource->load($categoriaextra, $id);
        if (!$categoriaextra->getId()) {
            throw new NoSuchEntityException(__('Unable to find Student with ID "%1"', $id));
        }
        return $categoriaextra;
    }

    public function save(CategoriaextraInterface $categoriaextra)
    {
        $this->categoriaextraResource->save($categoriaextra);
        return $categoriaextra;
    }

    public function delete(CategoriaextraInterface $categoriaextra)
    {
        try {
            $this->categoriaextraResource->delete($categoriaextra);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->categoriaextraCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        echo "</br>";
        echo $collection->getSelect()->__toString();
        echo "</br>";

        return $searchResults;

    }
}
