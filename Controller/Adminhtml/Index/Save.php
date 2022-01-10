<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml\Index;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra\CollectionFactory;
use Opiquad\Categoriaextra\Helper\Categoriecrea;
use \Magento\Catalog\Model\CategoryFactory;
use \Magento\Catalog\Model\ResourceModel\Category;
use \Magento\Catalog\Api\CategoryRepositoryInterfaceFactory;
use \Magento\Catalog\Api\Data\CategoryInterface;
use \Opiquad\Categoriaextra\Model\Imageuploader;

class Save  extends \Magento\Backend\App\Action
{
    public $categoryrepository;
    public $categoryinterface;
    public $category;
    public $repocategory;
    public $resultRedirectFactory;
public $page;
   public $categoriacollection;
protected  $categoriaextra;
public $categoriarepo;
    public $imageUploader;
public function __construct(
    Imageuploader $uploader,
    CategoryRepositoryInterfaceFactory $categoryRepositoryInterfaceFactory,
    CategoryInterface  $categoryinterface,
    CategoryFactory $category,Category $repocategory,
    RedirectFactory $redirect,Categoriecrea $categoriecrea,
    CollectionFactory $categoriacollection,
    CategoryextraFactory $categoriaextra,
    Categoryextra $repocategoria,
    Context $context
)
{
     $this->imageUploader =$uploader;
    $this->categoryrepository = $categoryRepositoryInterfaceFactory;
    $this->categoryinterface;
    $this->category=$category;
    $this->repocategory=$repocategory;
    $this->resultRedirectFactory=$redirect;
    $this->categoriecrea=$categoriecrea;
    $this->categoriacollection = $categoriacollection;
    $this->categoriaextra = $categoriaextra;
    $this->categoriarepo = $repocategoria;
    parent::__construct($context);
}

    public function execute()
    {
$categoriarepository= $this->categoryrepository->create();
        $categoriaestesa=$this->category->create();


        $collection= $this->categoriacollection->create();
       $collezionetitolo= $collection->getColumnValues('title');
        // TODO: Implement execute() method.

        $resultRedirect = $this->resultRedirectFactory->create();

        // check if data sent
      $data = $this->getRequest()->getPostValue();


        if ($data) {
            $id = $data['entity_id'];
            /** @var \Opiquad\Categoriaextra\Api\Data\CategoriaextraInterface $model */
if (!$id){
//TODO insert page identificatore se siamo in nuova pagina
$categoria = $this->categoriaextra->create();
    foreach ($collezionetitolo as $titolo)
    {
        if($titolo == $data['title']) {
            
            return $resultRedirect->setPath('*/*/');
        }
    }
//$this->page->Creopagina($data['title']);
$data['category_id']= $this->categoriecrea->Creacategoriaestesa($data['title']);
    $this->categoriecrea->Creasottocategorie($data['category_ids'],$data['category_id']);
}
// fase di edit ....................
    else       // $model = $this->_objectManager->create('MGS\Mmegamenu\Model\Mmegamenu')->load($id);
    {

        $categoria = $this->categoriaextra->create();
         $this->categoriarepo->load($categoria,$id);
         $categoria->setEntityId($id);
         //cambio categoria titolo in categorie se  nell'edit è stato cambiato
        $this->repocategory->load($categoriaestesa,$categoria->getData('category_id'));
      $this->categoryinterface = $categoriarepository->get($categoria->getData('category_id'),0);
      $this->categoryinterface->setName($data['title']);
      $categoriarepository->save($this->categoryinterface);
       // $categoriaestesa->setData('name',$data['title']);

      //  $this->repocategory->save($categoriaestesa);
        if (!$categoria->getId() && $id) {
            $this->messageManager->addError(__('This item no longer exists.'));
            return $resultRedirect->setPath('*/*/');
        }
    }

    $title=$data['title'];
            if(isset($data['category_ids'])){
                $data['category_ids'] = implode(',', $data['category_ids']);
            }

//immagine
            if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
                $data['image'] = $data['image'][0]['name'];
                $this->imageUploader->moveFileFromTmp($data['image']);
            } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
                $data['image'] = $data['image'][0]['name'];
            } else {
                $data['image'] = '';
            }


            if(!isset($data['stores'])){
                $data['stores'] = NULL;
            }


          // init model and set data

 //$data1=array('title'=>$data['title']);
$categoria->setData($data);

           // $model->setData($data);







            // try to save it
            try {
                // save the data
                $this->categoriarepo->save($categoria);
                // display success message
                $this->messageManager->addSuccess(__('You saved the item.'));
                // clear previously saved data from session
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
                }
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // save data in session
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                // redirect to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Opiquad_Categoriaextra::listing');
    }
}
