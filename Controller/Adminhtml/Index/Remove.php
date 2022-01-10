<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page  as Pagina;
use \Magento\Catalog\Model\CategoryFactory;
use \Magento\Catalog\Model\ResourceModel\Category;

class Remove extends Action implements HttpGetActionInterface
{
    public $category;
    public $repocategory;
    public $resultRedirectFactory;
    protected  $categoriaextra;
    public $categoriarepo;
public function __construct(
    CategoryFactory $category,Category $repocategory,
    PageFactory $page, Pagina $repopage,
    RedirectFactory $redirect,CategoryextraFactory $categoriaextra, Categoryextra $repocategoria,Context $context)
{
    $this->category=$category;
    $this->repocategory=$repocategory;
    $this->page=$page;
    $this->repopage=$repopage;
    $this->resultRedirectFactory=$redirect;
    $this->categoriaextra = $categoriaextra;
    $this->categoriarepo = $repocategoria;
    parent::__construct($context);
}


    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Opiquad_Categoriaextra::listing';

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
       $entita= $this->_request->getParam('id');
        $categoria = $this->categoriaextra->create();
        $pagina=$this->page->create();
$categoriaestesa=$this->category->create();
        $this->categoriarepo->load($categoria,$entita);
        $categoriapadre=$categoria->getData('category_id');
        $this->repocategory->load($categoriaestesa,$categoriapadre);
        $this->repocategory->delete($categoriaestesa);
         //   $this->repopage->load($pagina,$categoria->getData('title'));
        //    $this->repopage->delete($pagina);
        $title=$categoria->getData('title');
        $this->categoriarepo->delete($categoria);
        $this->messageManager->addNoticeMessage(__('Categoria Estesa  Eliminata'));
        return $resultRedirect->setPath('*/*/');

    }
}
