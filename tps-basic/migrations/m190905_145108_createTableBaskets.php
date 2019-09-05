<?php

use yii\db\Migration;

/**
 * Class m190905_145108_createTableBaskets
 */
class m190905_145108_createTableBaskets extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('baskets', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'count' => $this->integer(11)->notNull(),
            'total_price' => $this->decimal(8, 2)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updateAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('baskets');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_145108_createTableBaskets cannot be reverted.\n";

        return false;
    }
    */
}
