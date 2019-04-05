<?php

namespace Test\Banner\Block;
use Magento\Framework\View\Element\Template;
use Test\Banner\Model\ResourceModel\Demo\Collection as DemoCollection;
use Magento\Store\Model\ScopeInterface;

class DemoBanner extends Template
{
    /**
    * Banner collection
    *
    * @var DemoCollection
    */
    protected $_demoCollection;
    /**
    * Demo resource model
    *
    * @var \Test\Banner\Model\ResourceModel\Demo\CollectionFactory
    */
    protected $_demoColFactory;
    /**
    * @param Template\Context $context
    * @param \Test\Banner\Model\ResourceModel\Demo\CollectionFactory $collectionFactory
    * @param array $data
    * @SuppressWarnings(PHPMD.ExcessiveParameterList)
    */
    public function __construct(
        Template\Context $context,
        \Test\Banner\Model\ResourceModel\Demo\CollectionFactory $collectionFactory,
        array $data = []
        ) {
        $this->_demoColFactory = $collectionFactory;
        parent::__construct(
            $context,
            $data
            );
        }
    /**
    * Get Demo Items Collection
    * @return DemoCollection
    */
    public function getDemoItems()
    {
        if (null === $this->_demoCollection) {
        $this->_demoCollection =
        $this->_demoColFactory->create();
        }
        return $this->_demoCollection;
    }
}