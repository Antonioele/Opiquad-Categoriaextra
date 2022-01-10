<?php

namespace Opiquad\Categoriaextra\ViewModel;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra\CollectionFactory;

class Immaginetop implements ArgumentInterface
{
    protected $storeManager;
    public $categoriaexcoll;
    private $layerResolver;
    protected $categoriaextra;
    public $categoriarepo;
    private $categoryId;
    public function __construct(
        CollectionFactory                     $collectionFactory,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        CategoryextraFactory                  $categoriaextra,
        Categoryextra                         $repocategoria,
        StoreManagerInterface                   $storeManager


    )
    {
        $this->categoriaexcoll = $collectionFactory;
        $this->layerResolver = $layerResolver;
        $this->categoriaextra = $categoriaextra;
        $this->categoriarepo = $repocategoria;
        $this->storeManager = $storeManager;

    }

    public function getCategoryId()
    {
        if (!$this->categoryId) {
            $currentCategoryId = $this->layerResolver->get()->getCurrentCategory()->getId();
            // $currentCategoryId = $this->catalogSession->getData('last_viewed_category_id');
            //var_dump($currentCategoryId);
            //$currentCategoryId = $this->_registry->registry('current_category')->getId();
            //var_dump($this->_registry);
            if ($currentCategoryId) {
                $this->categoryId = (int)$currentCategoryId;
            }
        }
        return $this->categoryId;
    }

    public function trovapathimg()
    {
        $catid = $this->getCategoryId();
        $categoriaextra = $this->categoriaextra->create();
        $colleextra = $this->categoriaexcoll->create();
        $catexgoriaid = $colleextra->addFieldToFilter('category_id', ['eq'=>$catid]);
        foreach ($catexgoriaid as $cate) {
            $img = $cate->getData('image');
        }

        return $this ->storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'codextblog/feature/'.$img;

    }
}