<?php

namespace Test\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        //create table
        $table = $installer->getConnection()->newTable($installer->getTable('banners')
        )->addColumn(
            'demo_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Demo ID'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nnullable' => false],
            'Title'
            )->addColumn(
                'banner',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Banner'
            )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Is Active'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable('banners'),
                ['title'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['title'],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Demo Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}