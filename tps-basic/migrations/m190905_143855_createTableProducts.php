<?php

use yii\db\Migration;

/**
 * Class m190905_143855_createTableProducts
 */
class m190905_143855_createTableProducts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string(150)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'img' => $this->string(150)->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->decimal(8, 2)->notNull(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        //$this->addForeignKey('FK_products_category_id', 'products', 'category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_143855_createTableProducts cannot be reverted.\n";

        return false;
    }
    */
}
