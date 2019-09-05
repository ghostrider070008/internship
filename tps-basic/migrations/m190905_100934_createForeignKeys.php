<?php

use yii\db\Migration;

/**
 * Class m190905_100934_createForeignKeys
 */
class m190905_100934_createForeignKeys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fkUsersOrders','orders','user_id','users','id','CASCADE');
        $this->addForeignKey('fkOrdersOrderItem','orders','order_item_id','order_item','id','CASCADE');
        $this->addForeignKey('fkOrderItemProducts','order_item','product_id','products','id','CASCADE');
        $this->addForeignKey('fkUsersOrderItem','order_item','user_id','users','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropForeignKey('fkUsersOrders','orders');
       $this->dropForeignKey('fkOrdersOrderItem','orders');
       $this->dropForeignKey('fkOrderItemProducts','order_item');
       $this->dropForeignKey('fkUsersOrderItem','order_item');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_100934_createForeignKeys cannot be reverted.\n";

        return false;
    }
    */
}
