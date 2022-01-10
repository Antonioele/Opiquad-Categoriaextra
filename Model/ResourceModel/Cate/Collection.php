<?php

namespace Opiquad\Categoriaextra\Model\ResourceModel\Cate;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Opiquad\Categoriaextra\Model\Cate as Model;
use Opiquad\Categoriaextra\Model\ResourceModel\Cate as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'category_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
