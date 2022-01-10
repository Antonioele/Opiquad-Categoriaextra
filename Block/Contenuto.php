<?php

namespace Opiquad\Categoriaextra\Block;


use Magento\Framework\View\Element\Template;
use magento\Framework\UrlInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use magento\Framework\Escaper;
class Contenuto extends Template
{
    public $escaper;
    public $_productCollectionFactory;
    protected $UrlInterface ;
    protected $_storeManager;
    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager ,CollectionFactory $_productCollectionFactory,Escaper $escaper,
                                UrlInterface $UrlInterface,Template\Context $context, array $data = [])
    {
        $this->escaper = $escaper;
        $this->_productCollectionFactory=$_productCollectionFactory;
        $this->UrlInterface=$UrlInterface;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }
    public function getMediaBaseUrl(){
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_LINK);

    }
    public function getCategoryProductByIds($categoryIds)
    {
        /** @var $collection \Magento\Catalog\Model\ResourceModel\Product\Collection */
        $collection = $this->_productCollectionFactory->create();
        //  $collection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());

        if($categoryIds!=''){
            $categoryIdArray = explode(',',$categoryIds);
            if(count($categoryIdArray)>0){
                $categoryFilter = ['eq'=>$categoryIdArray];
                $collection->addCategoriesFilter($categoryFilter);
            }
        }



        return $collection;
    }

    public function getCategoryMinPrice($categoryIds)
    {
        /** @var $collection \Magento\Catalog\Model\ResourceModel\Product\Collection */
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $categoryIds]);

        return $collection->getMinPrice();
    }


    public function getAllProductCount(){
        //return $this->_count;
    }

    public function getCurrentPage(){
        if ($this->getCurPage()) {
            return $this->getCurPage();
        }
        return 1;
    }

    public function getProductsPerRow(){
        if ($this->hasData('per_row')) {
            return $this->getData('per_row');
        }
        return false;
    }

    public function getCustomClass(){
        if ($this->hasData('custom_class')) {
            return $this->getData('custom_class');
        }
    }

    public function getCategoryByIds()
    {
        $result = [];
        if ($this->hasData('category_ids')) {
            $categoryIds = $this->getData('category_ids');
            $categoryArray = explode(',', $categoryIds);
            if (count($categoryArray) > 0) {
                foreach ($categoryArray as $categoryId) {
                    $category = $this->getModel('Magento\Catalog\Model\Category')->load($categoryId);
                    if ($category->getId()) {
                        $result[] = $category;
                    }

                }
            }
        }
        return $result;
    }

}
