<?php

namespace Opiquad\Categoriaextra\Model;

use Magento\Framework\Model\AbstractModel;
use Opiquad\Categoriaextra\Model\ResourceModel\Cate as ResourceModel;

class Cate extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'category_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
