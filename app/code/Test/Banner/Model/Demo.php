<?php

namespace Test\Banner\Model;
use Magento\Framework\Model\AbstractModel;

class Demo extends AbstractModel {
    protected function _construct() {
        $this->_init('Test\Banner\Model\ResourceModel\Demo');
    }
}