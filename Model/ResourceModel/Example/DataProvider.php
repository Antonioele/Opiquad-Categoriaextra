<?php

namespace Opiquad\Categoriaextra\Model\ResourceModel\Example;
use Opiquad\Categoriaextra\Model\ResourceModel\Cate\CollectionFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Opiquad\Categoriaextra\Model\CategoryextraFactory;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    public $request;
    protected $categoriaextra;
    public $categoriarepo;
    public $collection;
    /**
     * @var array
     */
    protected $loadedData;

    protected $storeManager;

    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        CategoryextraFactory                    $categoriaextra, Categoryextra $categoriarepo,
                                                $name,
                                                $primaryFieldName,
                                                $requestFieldName,
        CollectionFactory                       $exampleCollectionFactory,
        StoreManagerInterface                   $storeManager,
        ScopeConfigInterface                    $scopeConfig,
        array                                   $meta = [],
        array                                   $data = []
    )
    {
        $this->request = $request;
        $this->categoriaextra = $categoriaextra;
        $this->categoriarepo = $categoriarepo;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->collection = $exampleCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }


    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $data = $item->getData();
            if (isset($data['image'])) {
                $name = $data['image'];
                unset($data['image']);
                $data['image'][0] = [
                    'name' => $name,
                    'url' => $this ->storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'codextblog/feature/'.$name
                ];
            }


            $data['category_ids'] = explode(',', $data['category_ids']);
            $final_data['details'] = $data;
            $this->loadedData[$item->getId()] = $final_data['details'];
        }
        return $this->loadedData;



        }

}
