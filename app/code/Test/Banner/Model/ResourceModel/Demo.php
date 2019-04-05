<?php

namespace Test\Banner\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Demo extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('banners', 'demo_id');
    }
}