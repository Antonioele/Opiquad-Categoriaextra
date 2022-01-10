<?php

namespace Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Opiquad\Categoriaextra\Model\Categoryextra as Model;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'categoryextra_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
