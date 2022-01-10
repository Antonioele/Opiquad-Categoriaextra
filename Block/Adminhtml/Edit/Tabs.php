<?php

namespace Opiquad\Categoriaextra\Block\Adminhtml\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('mmegamenu_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Categoria Extra'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'main_section',
            [
                'label' => __('Informazioni Categoria Extra'),
                'content' => $this->getLayout()->createBlock('Opiquad\Categoriaextra\Block\Adminhtml\Edit\Tab\Main')->toHtml(),
            ]
        );


        $this->addTab(
            'category',
            [
                'label' => __('Categorie'),
                'content' => $this->getLayout()->createBlock('Opiquad\Categoriaextra\Block\Adminhtml\Edit\Tab\Category')->toHtml(),
            ]
        );





        return parent::_beforeToHtml();
    }
}
