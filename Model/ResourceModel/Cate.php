<?php

namespace Opiquad\Categoriaextra\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Cate extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'categoryextra_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('categoryextra', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
