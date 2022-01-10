<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml\Index;



class Nuovo extends \Opiquad\Categoriaextra\Controller\Adminhtml\Nuovo
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Opiquad_Categoriaextra::manage';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }
    public function execute()
    {
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Aggiungi Categoria Extra'));
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
    }
}
