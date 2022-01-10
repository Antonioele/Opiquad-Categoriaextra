<?php

namespace Opiquad\Categoriaextra\Block\Adminhtml\Edit;

/**
 * Sitemap edit form
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

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
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('categoriaextra_form');
        $this->setTitle(__('Categorie extra'));
       // $this->setTemplate('_Mmegamenu::category.phtml');

    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('categoriaextra_categoriaextra');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post', 'enctype' => 'multipart/form-data']]
        );

        $fieldset = $form->addFieldset('categoriacontextra_form', ['legend' => __('Categoria Extra')]);

        $fieldset->addField(
            'title',
            'text',
            [
                'label' => __('Nome Categoria'),
                'name' => 'title',
                'required' => true
            ]
        );
        $fieldset->addField(
            'entity_id',
            'text',
            [
                'label' => __('Identifier'),
                'name' => 'identifier',
                'required' => true,
                'class' => 'validate-xml-identifier'
            ]
        );



        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }



















    //inizio

    public function getTabLabel()
    {
        return __('Category');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Category');
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

    public function getRootCategoryId(){
        $store = $this->getStore();
        if($this->getRequest()->getParam('store')!='' && $this->getRequest()->getParam('store')!=0){
            $storeModel = $this->getModel('Magento\Store\Model\Store');
            $store = $storeModel->load($this->getRequest()->getParam('store'));
        }
      //  $categoryId = $store->getRootCategoryId();
        return 2;
    }

    public function getCategory(){
        $categoryId = $this->getRootCategoryId();
        $category = $this->getModel('Magento\Catalog\Model\Category')->load(3);
        return $category;
    }

    public function getIds(){
        return $this->_ids;
    }

    public function getTreeCategory($category, $parent, $ids = array()){
        if ($this->getRequest()->getParam('id')) {
            $megamenu = $this->getModel('MGS\Mmegamenu\Model\Mmegamenu')->load($this->getRequest()->getParam('id'));
            if($megamenu->getCategoryId()!=0){
                $categoryId = $megamenu->getCategoryId();
            }
            else{
                $categoryId = 0;
            }
        }
        else{
            $categoryId = 0;
        }

        $children = $category->getChildrenCategories();
        $childrenCount = count($children);

        $htmlLi = '<li>';
        $html[] = $htmlLi;
        //if($this->isCategoryActive($category)){
        $ids[] = $category->getId();
        $this->_ids = implode(",", $ids);
        //}

        $html[] = '<a id="node'.$category->getId().'">';

        $html[] = '<input lang="'.$category->getId().'" onclick="setCheckbox('.$category->getId().')" type="radio" id="radio'.$category->getId().'" name="category_id" value="'.$category->getId().'" class="radio checkbox'.$parent.'"';
        if($categoryId == $category->getId()){
            $html[] = ' checked="checked"';
        }
        $html[] = '/><label for="radio'.$category->getId().'">' . $category->getName() . '</label>';

        $html[] = '</a>';

        $htmlChildren = '';
        if($childrenCount>0){
            foreach ($children as $child) {

                $_child = $this->getModel('Magento\Catalog\Model\Category')->load($child->getId());
                $htmlChildren .= $this->getTreeCategory($_child, $category->getId(), $ids);
            }
        }
        if (!empty($htmlChildren)) {
            $html[] = '<ul id="container'.$category->getId().'">';
            $html[] = $htmlChildren;
            $html[] = '</ul>';
        }

        $html[] = '</li>';
        $html = implode("\n", $html);
        return $html;
    }
















}
