<?php

namespace Opiquad\Categoriaextra\Api\Data;
use Magento\Framework\Api\SearchResultsInterface;


interface CategoriaextraSearchResultInterface extends SearchResultsInterface
{
    public function getItems();


    public function setItems(array $items);

}
