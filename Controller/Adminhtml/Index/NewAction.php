<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml\Index;

class NewAction extends \Opiquad\Categoriaextra\Controller\Adminhtml\Nuovo
{
    /**
     * Create new customer action
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        // stesso per creare e leggere
        $this->_forward('edit');
    }
}
