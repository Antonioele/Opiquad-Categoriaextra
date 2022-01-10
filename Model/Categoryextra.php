<?php

namespace Opiquad\Categoriaextra\Model;

use Magento\Framework\Model\AbstractModel;
use Opiquad\Categoriaextra\Model\ResourceModel\Categoryextra as ResourceModel;

class Categoryextra extends AbstractModel 
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'categoryextra_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
public function getDefaultValues()
{
$values=[];
return $values;
}

}
