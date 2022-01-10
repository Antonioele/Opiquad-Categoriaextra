<?php

namespace Opiquad\Categoriaextra\Helper;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page  as Pagina;




class Page  extends \Magento\Framework\App\Helper\AbstractHelper
{
public $page;
public $repopage;

public function __construct( \Magento\Framework\App\Helper\Context $context,
PageFactory $page, Pagina $repopage




){
    $this->page=$page;
    $this->repopage=$repopage;


 parent::__construct($context);
}
// creo pagina
public function Creopagina($title){
   $pagina=$this->page->create();
    $pageData = [
        'title' => $title,
        'page_layout' => '1column',
        'meta_keywords' => 'Page keywords',
        'meta_description' => 'Page description',
        'identifier' => $title,
        'content_heading' => $title,
        'content' => '<div class="main-cms-content">Content goes here for My cms page. CMS Page create using Programmatically</div>',
        'layout_update_xml' => '<referenceContainer name="main"><block name="pagina-collezione44" class="Opiquad\Categoriaextra\Block\Contenuto" template="Opiquad_Categoriaextra::paginacategoriaextra.phtml"> 

    <arguments>
        <argument name ="view_model"  xsi:type="object">
            Opiquad\Categoriaextra\ViewModel\Contenuto
        </argument>
    </arguments>
            </block>
            </referenceContainer>',
        'url_key' => $title,
        'is_active' => 1,
        'stores' => [0], // store_id comma separated
        'sort_order' => 0
    ];
$pagina->setData($pageData);
$this->repopage->save($pagina);
}

}