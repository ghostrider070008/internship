<?php

use yii\db\Migration;

/**
 * Class m190905_144155_createTableOrders
 */
class m190905_144155_createTableOrders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'order_number' => $this->integer(150)->notNull(),
            'total_price' => $this->decimal(8, 2)->notNull(),
            'order_item_id' => $this->integer(8)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'status' => $this->string(150)->notNull()->defaultValue('В обработке'),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updateAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_144155_createTableOrders cannot be reverted.\n";

        return false;
    }
    */
}
