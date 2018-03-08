<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $connection = $setup->getConnection();
        $reviewConsideration = $connection->newTable('rating_consideration')
            ->addColumn(
                'consideration_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Review consideration id'
            )
            ->addColumn(
                'review_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_BIGINT,
                null,
                ['identity' => false, 'unsigned' => true, 'nullable' => false, 'primary' => false],
                'Review id'
            )
            ->addColumn(
                'type',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '0'],
                'Type'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false],
                'Value'
            )
            ->addIndex(
                $connection->getIndexName('review_detail', ['review_id', 'type']),
                ['review_id', 'type']
            )
            ->addForeignKey(
                $connection->getForeignKeyName('rating_consideration', 'review_id', 'review', 'review_id'),
                'review_id',
                $connection->getTableName('review'),
                'review_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Review considerations');

        $connection->createTable($reviewConsideration);

        $setup->endSetup();
    }
}
