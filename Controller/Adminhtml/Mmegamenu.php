<?php

namespace Opiquad\Categoriaextra\Controller\Adminhtml;

abstract  class Mmegamenu extends \Magento\Backend\App\Action
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
            'MGS_Mmegamenu::mmegamenu_manage'
        )->_addBreadcrumb(
            __('Mmegamenu'),
            __('Mmegamenu')
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
        return $this->_authorization->isAllowed('MGS_Mmegamenu::megamenu');
    }
}
{

}
