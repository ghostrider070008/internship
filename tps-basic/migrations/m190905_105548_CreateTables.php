<?php

use yii\db\Migration;

/**
 * Class m190905_105548_CreateTables
 */
class m190905_105548_CreateTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //таблица users
        $this->createTable('users', [
            'id' => $this->integer(11)->notNull(),
            'username' => $this->string(45)->notNull(),
            'email' => $this->string(150)->notNull(),
            'password_hash' => $this->string(300)->notNull(),
            'token' => $this->string(150),
            'firstname' => $this->string(45)->notNull(),
            'secondname' => $this->string(45),
            'surname' => $this->string(45)->notNull(),
            'phonenumber' => $this->integer(11)->notNull(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->createIndex('email_id', 'users', 'email', true);
        $this->createIndex('phone_id', 'users', 'phonenumber', true);
        $this->addPrimaryKey('PK_id', 'users', 'id' );

        //таблица addresses
        $this->createTable('addresses', [
            'id' => $this->integer(11)->notNull(),
            'country' => $this->string(150)->notNull(),
            'region' => $this->string(150),
            'city' => $this->string(150)->notNull(),
            'street' => $this->string(150)->notNull(),
            'building' => $this->string(10)->notNull(),
            'apartment' => $this->string(10),
            'user_id' => $this->integer(11),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->addPrimaryKey('PK_id', 'addresses', 'id' );
        $this->addForeignKey('FK_addresses_user_id', 'addresses', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        //categories
        $this->createTable('categories', [
            'id' => $this->integer(11)->notNull(),
            'category_name' => $this->string(150)->notNull(),
            'parent_category_id' => $this->integer(11)->notNull(),
            'img' => $this->string(150),
            'descr' => $this->text(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->createIndex('category_name_id', 'categories', 'category_name', true);
        $this->addPrimaryKey('PK_id', 'categories', 'id' );

        //products
        $this->createTable('products', [
            'id' => $this->integer(11)->notNull(),
            'product_name' => $this->string(150)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'img' => $this->string(150),
            'descr' => $this->text(),
            'price' => $this->integer(11)->notNull(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->addPrimaryKey('PK_id', 'products', 'id' );
        $this->addForeignKey('FK_products_category_id', 'products', 'category_id', 'categories', 'id', 'CASCADE', 'CASCADE');

        //baskets
        $this->createTable('baskets', [
            'id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'count' => $this->integer(11)->notNull(),
            'total_price' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->addPrimaryKey('PK_id', 'baskets', 'id' );
        $this->addForeignKey('FK_baskets_product_id', 'baskets', 'product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_baskets_user_id', 'baskets', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        //orders
        $this->createTable('orders', [
            'id' => $this->integer(11)->notNull(),
            'products_ids' => $this-> string(150)->notNull(),
            'total_price' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11),
            'status' => $this->string(150),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->addPrimaryKey('PK_id', 'orders', 'id' );
        $this->addForeignKey('FK_orders_user_id', 'orders', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //users
        $this->dropPrimaryKey('PK_id', 'users', 'id');
        $this->dropTable('users');
        //addresses
        $this->dropPrimaryKey('PK_id', 'addresses', 'id');
        $this->dropForeignKey('FK_addresses_user_id', 'addresses');
        $this->dropTable('addresses');
        //categories
        $this->dropPrimaryKey('PK_id', 'categories', 'id');
        $this->dropTable('categories');
        //products
        $this->dropPrimaryKey('PK_id', 'products', 'id');
        $this->dropForeignKey('FK_products_category_id', 'products');
        $this->dropTable('categories');
        //baskets
        $this->dropPrimaryKey('PK_id', 'baskets', 'id');
        $this->dropForeignKey('FK_baskets_product_id', 'baskets');
        $this->dropForeignKey('FK_baskets_user_id', 'baskets');
        $this->dropTable('baskets');
        //orders
        $this->dropPrimaryKey('PK_id', 'orders', 'id');
        $this->dropForeignKey('FK_orders_user_id', 'baskets');
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_105548_CreateTables cannot be reverted.\n";

        return false;
    }
    */
}
