<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Opiquad\Categoriaextra\Block\Adminhtml\Edit\Tab;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
/**
 * Sitemap edit form
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected  $categoriaextra;
    public $categoriarepo;
	/**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        CategoryextraFactory $categoriaextra, Categoryextra $repocategoria,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
		\Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        $this->categoriaextra = $categoriaextra;
        $this->categoriarepo = $repocategoria;
        $this->_systemStore = $systemStore;
		$this->_objectManager = $objectManager;
        parent::__construct($context, $registry, $formFactory, $data);
    }

	protected function _prepareForm()
    {
     //  $model = $this->_coreRegistry->registry('mmegamenu_mmegamenu');
        $categoria = $this->categoriaextra->create();

        $id = $this->getRequest()->getParam('id');

        $this->categoriarepo->load($categoria,$id);
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('mmegamenu_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Informazioni')]);

		//$data = $model->getData();
        $data= $categoria->getData();

        $model=$data;

        if ($categoria->getEntityId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
            $data['entity_id']=$id;
        }

		$fieldset->addField('store', 'hidden', ['name' => 'store']);

		$data['store'] = 0;
		if($this->getRequest()->getParam('store')){
			$data['store'] = $this->getRequest()->getParam('store');
		}





        $fieldset->addField(
            'title',
            'text',
            [
                'label' => __('Nome  Gruppo Categorie'),
                'name' => 'title',
                'required' => true,
                'value' => $categoria->getTitle()
            ]
        );



		$fieldset->addField(
            'url',
            'text',
            [
                'label' => __('Link'),
                'name' => 'url',
                'value' => $categoria->getUrl(),
				'note' => __('Bianco il link verra assegnato in autamatico.')
            ]
        );

		$fieldset->addField(
            'position',
            'text',
            [
                'label' => __('Position'),
                'name' => 'position',
                'value' => $categoria->getPosition(),
				'class' => 'validate-number'
            ]
        );



		$fieldset->addField(
            'special_class',
            'text',
            [
                'label' => __('Custom Class'),
                'name' => 'special_class',
                'value' => $categoria->getSpecialClass()
            ]
        );



		$fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'name' => 'status',
                'required' => false,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );


		/* Check is single store mode */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true)
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
           $data['store_id'] = 0;
        }

        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

	/**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Informazione  Categoria');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Informazioni Generali');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
