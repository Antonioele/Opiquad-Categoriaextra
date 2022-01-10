<?php

namespace Opiquad\Categoriaextra\Model\ResourceModel;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra\CollectionFactory;;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
class DataProviderl extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    protected $storeManager;

    protected $scopeConfig;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $exampleCollectionFactory,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        array $meta = [],
        array $data = []
    )
    {
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
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $data = $item->getData();
            $data['category_ids'] = explode(',', $data['sub_category_ids']);
            $result['example_details'] = $data;
            $this->_loadedData[$item->getId()] = $result;
        }
        return $this->_loadedData;
    }
}
