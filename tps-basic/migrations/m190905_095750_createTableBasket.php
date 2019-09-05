<?php

use yii\db\Migration;

/**
 * Class m190905_095750_createTableBasket
 */
class m190905_095750_createTableBasket extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('basket',[
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'count'=>$this->integer()->notNull(),
            'amount'=>$this->decimal(8,2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('basket');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_095750_createTableBasket cannot be reverted.\n";

        return false;
    }
    */
}
