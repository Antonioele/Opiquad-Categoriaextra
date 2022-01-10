<?php

namespace Opiquad\Categoriaextra\Api;

interface CategoriaextraRepositoryInterface
{ /**
 * Interface CategoriaextraRepositoryinterface
 * @author Aiello Antonio
 */

    /**
     * @param int $id
     * @return \Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface $categoriaextra
     * @return \Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface $categoriaextra);

    /**
     * @param \Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface $categoriaextra
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface $categoriaextra);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Opiquad\Categoriaextra\Api\Data\CategoriaextraSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}
