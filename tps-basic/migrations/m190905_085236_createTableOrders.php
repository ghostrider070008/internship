<?php

use yii\db\Migration;

/**
 * Class m190905_085236_createTableOrders
 */
class m190905_085236_createTableOrders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders',[
            'id'=>$this->primaryKey(),
            'order_number'=>$this->integer()->notNull(),
            'user_id'=>$this->integer(8)->notNull(),
            'order_item_id'=>$this->integer(8)->notNull(),
            'amount'=>$this->decimal(8,2),
            'status'=>$this->string()->notNull()->defaultValue('В обработке'),
            'createAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updateAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),


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
        echo "m190905_085236_createTableOrders cannot be reverted.\n";

        return false;
    }
    */
}
