<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml;

abstract class Nuovo extends \Magento\Backend\App\Action
{
    /**
     * Init actions
     *
     * @return $this
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Opiquad_Categoriaextra::categoriaextra_manage'
        )->_addBreadcrumb(
            __('Categoriaextra'),
            __('Categoriaextra')
        );
        return $this;
    }

    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Opiquad_Categoriaextra::manage');
    }
}
