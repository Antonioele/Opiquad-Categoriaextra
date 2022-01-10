<?php

namespace Opiquad\Categoriaextra\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
/**
 * Class Actions
 */
class Actions extends Column
{
    protected $urlHelper;
    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\Url $urlHelper,
        UrlInterface $urlBuilder,
                                ContextInterface $context,
                                UiComponentFactory $uiComponentFactory,
                                array $components = [],
                                array $data = [])
    {
$this->urlHelper= $urlHelper;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'cate/index/edit',
                        ['id' => $item['entity_id']]
                    ),
                    'label' => __('Edita'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['rimuovi'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'cate/index/remove',
                        ['id' => $item['entity_id']]
                    ),
                    'label' => __('Rimuovi'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['view'] = [
                    'href' => $this->urlHelper->getUrl('catalog/category/view',['id'=>  $item['category_id']]),
                                               

                    'label' => __('Vedi Pagina'),
                    'hidden' => false,
                ];
                            /*,
                    'remove' => [
                        'href' => '/remove',
                        'label' => __('Remove')
                    ],
                    'duplicate' => [
                        'href' => '/duplicate',
                        'label' => __('Duplicate')
                    ],
                ];**/
            }
        }

        return $dataSource;
    }
}
