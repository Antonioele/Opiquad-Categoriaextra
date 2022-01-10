<?php

namespace Opiquad\Categoriaextra\ViewModel;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra\CollectionFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as Categorycollection;

class Contenuto implements ArgumentInterface

{
    public $categoryRepository;
    protected $categoriecollezione;
    protected  $categoriaextra;
    public $categoriarepo;
    protected $_request; //only if this is not a controller
    protected $pageRepository;
    public $collection_categorieextra;
    public function  __construct(
        CategoryRepositoryInterface $categoryRepository,
        Categorycollection $categoriecollezione,
        CollectionFactory $coll,
        \Magento\Framework\App\RequestInterface $request,
                                  \Magento\Cms\Api\PageRepositoryInterface $pageRepository,
                                  CategoryextraFactory $categoriaextra,Categoryextra $categoriarepo){
        $this->categoryRepository = $categoryRepository;
        $this->categoriecollezione= $categoriecollezione;
        $this->categoriaextra = $categoriaextra;
        $this->categoriarepo = $categoriarepo;
$this->_request = $request;
        $this->pageRepository = $pageRepository;
        $this->collection_categorieextra=$coll;
    }
    public function getCurrentPageUrlKey()
    {
        try {
            $pageId = $this->_request->getParam('page_id', $this->_request->getParam('id', false));
            $page = $this->pageRepository->getById($pageId);
            return $page->getIdentifier();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }
    public function getCategoriestringa()
    {
        $page_identifier=$this->getCurrentPageUrlKey();
        $collezioneextra=$this->collection_categorieextra->create();
        $collezioneextra->addFieldToFilter('title',$page_identifier);
        foreach ($collezioneextra as $value){
          $id=$value->getEntityId();
        }
        $categoria= $this->categoriaextra->create();
        if($id){
        $this->categoriarepo->load($categoria,$id);
        $categorie=$categoria->getData('sub_category_ids');
        return $categorie;
    }
    }

public function getCategorie(){
        //stringa categorie
        $catst =$this->getCategoriestringa();
        $vectcategorie=array();
        $vectcategorie=explode(",",$catst);
        $categoriecollezione= $this->categoriecollezione->create();
        $categoriecollezione->addAttributeToSelect('*')->addFieldToFilter('entity_id',['in'=>$vectcategorie]);
        return $categoriecollezione;
}
    public function getImmaginecategoria($id)
    {
        $categoria= $this->categoryRepository->get($id);
        return $categoria->getData("immagine_categoria");

    }
    public function getDescription($id)
    {
        $categoria= $this->categoryRepository->get($id);
        return $categoria->getData("description");

    }
}
