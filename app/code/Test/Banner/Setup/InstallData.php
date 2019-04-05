<?php
namespace Test\Banner\Setup;
use Test\Banner\Model\Demo;
use Test\Banner\Model\DemoFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
    * Demo factory
    *
    * @var DemoFactory
    */
    private $demoFactory;
    /**
    * Init
    *
    * @param DemoFactory $demoFactory
    */
    public function __construct(DemoFactory $demoFactory)
    {
        $this->demoFactory = $demoFactory;
    }
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(ModuleDataSetupInterface $setup,
    ModuleContextInterface $context)
    {
        $initData = [
        'title' => 'Default banner',
        'banner' => '<img src="http://violetcakehouse.com/wp-content/uploads/2018/08/9F86D081884C7D659A2FEAA0C55AD015A3BF4F1B2B0B822CD15D6C15B0F00A08-1139x300.png" style="width:100%;" />',
        'is_active' => 1,
        ];
        /**
        * Insert data
        */
        $this->createDemo()->setData($initData)->save();
    }
    /**
    * Create demo
    *
    * @return Demo
    */
    public function createDemo()
    {
        return $this->demoFactory->create();
    }
}