<?php

namespace Opiquad\Categoriaextra\Helper;
use \Magento\Catalog\Model\CategoryFactory;
use \Magento\Catalog\Model\ResourceModel\Category;
use \Magento\Framework\App\State;
use \Magento\Store\Model\StoreManagerInterface;

class Categoriecrea
{
    const CATEGORIE_ESTESE_ID_PARENT = 286;
    public $category;
    public $repocategory;
    public $state;
    public $storemanager;
    public $categorylink;
    public function __construct(
        \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagementInterface,

        StoreManagerInterface $storeManager,
        State $state,
        CategoryFactory $category,Category $repocategory){
        $this->storemanager=$storeManager;
        $this->state=$state;
        $this->category=$category;
$this->repocategory=$repocategory;
$this->categorylink = $categoryLinkManagementInterface;
    }


    public function Creacategoriaestesa($title){

$categoriaroot=$this->category->create();
$categoriaroot->setName($title);
$categoriaroot->setParentId(self::CATEGORIE_ESTESE_ID_PARENT);
$categoriaroot->setCustomAttribute('page_layout','pagina-extra');
$categoriaroot->setCustomAttribute('custom_design',10);
$categoriaroot->setCustomAttribute('display_mode',\Magento\Catalog\Model\Category::DM_PAGE);
$categoriaroot->setPath('1/2/286');
$categoriaroot->setIsActive(true);
$this->repocategory->save($categoriaroot);
return $categoriaroot->getEntityId();


    }
    public function Creasottocategorie($sottocategorie,$padre)
            {
                foreach ($sottocategorie as $value){
                    $categoria=$this->category->create();
                    $categoriaclone= $this->category->create();
                    $this->repocategory->load($categoria,$value);
                    $categoriaclone->setName($categoria->getName());
                    $categoriaclone->setPath('1/2/286/'.$padre);
                    $categoriaclone->setParentId($padre);
                    $categoriaclone->setIsActive(true);
                    $categoriaclone->setData('immagine_categoria',$categoria->getData('immagine_categoria'));
                    $this->repocategory->save($categoriaclone);

                    $figli=$categoria->getProductCollection()->addAttributeToSelect('*');
                   // $prodotti =array();

                    $categoriaclone->setParentId($padre);
                  //  $figlidata =$figli->getData();

                    foreach ($figli as $product){
                        $categoryIds = [$categoriaclone->getEntityId()];

                        $categoryIds = array_unique(
                            array_merge(
                                $product->getCategoryIds(),
                                $categoryIds
                            )
                        );

                      $this->categorylink->assignProductToCategories($product->getSku(),$categoryIds);
                        //$product->setCategoryIds($categoryIdszz);


                    }



                    //$categoriaroot->setCustomAttribute('page_layout','pagina-extra');
                    //$categoriaclone->setCustomAttribute('custom_design',10);




                }


    }



}