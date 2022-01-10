<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra\CollectionFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Opiquad_Categoriaextra::listing';
    public $collection_categorieextra;
    protected $categoriaextra;
    public $categoriarepo;

    /**
     * Authorization level of a basic admin session
     */
    public function __construct(CategoryextraFactory $categoriaextra, Categoryextra $categoriarepo, CollectionFactory $coll, Context $context)
    {

        $this->categoriaextra = $categoriaextra;
        $this->categoriarepo = $categoriarepo;
        $this->collection_categorieextra = $coll;

        parent::__construct($context);
    }


    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {

$categoria= $this->categoriaextra->create();

        $entityId = $this->getRequest()->getParam('id');

        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Opiquad_Categoriaextra::entita')
            ->addBreadcrumb(__('Gestione Categoria Estesa'), __('Gestione Categoria Estesa'))
            ->addBreadcrumb(__(' Gestione Categoria estesa'), __(' Gestione Categoria estesa'));
        if ($entityId === null) {
            $resultPage->addBreadcrumb(__('New Entity'), __('Nuova Categoria Extra'));
            $resultPage->getConfig()->getTitle()->prepend(__('Nuova Categoria Extra'));
        } else {
            //Todo gestire il caso di entity passata ma non valida
            $this->categoriarepo->load($categoria, $entityId);
            $resultPage->addBreadcrumb(__('Edit Categoria'), __('Edit Categoria'));
            $resultPage->getConfig()->getTitle()->prepend(
                $categoria->getData('title')

            );

        }
            return $resultPage;
        }

}
