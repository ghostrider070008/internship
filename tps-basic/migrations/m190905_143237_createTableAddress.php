<?php

use yii\db\Migration;

/**
 * Class m190905_143237_createTableAddress
 */
class m190905_143237_createTableAddress extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'country' => $this->string(150)->notNull(),
            'region' => $this->string(150)->notNull(),
            'city' => $this->string(150)->notNull(),
            'street' => $this->string(150)->notNull(),
            'building' => $this->string(10)->notNull(),
            'apartment' => $this->string(10)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        //$this->addForeignKey('FK_addresses_user_id', 'address', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('address');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_143237_createTableAddress cannot be reverted.\n";

        return false;
    }
    */
}
