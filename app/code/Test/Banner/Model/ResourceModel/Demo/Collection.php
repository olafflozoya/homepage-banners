<?php

namespace Test\Banner\Model\ResourceModel\Demo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'demo_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Test\Banner\Model\Demo', 'Test\Banner\Model\ResourceModel\Demo');
    }

    /**
     * OptionArray for records in banners
     *
     * @return array
     */
    public function toOptionIdArray()
    {
        $res = [];
        $res[] = ['value'=>'', 'label'=>__('Please Select')];
        foreach ($this as $item) {
            $data['value'] = $item->getData('demo_id');;
            $data['label'] = $item->getData('title');

            $res[] = $data;
        }

        return $res;
    }
} 
