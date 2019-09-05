<?php

use yii\db\Migration;

/**
 * Class m190905_084144_createTableProducts
 */
class m190905_084144_createTableProducts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'descriptioin'=>$this->string(255)->notNull(),
            'price'=>$this->decimal(8,2),
        ]);
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
        echo "m190905_084144_createTableProducts cannot be reverted.\n";

        return false;
    }
    */
}
