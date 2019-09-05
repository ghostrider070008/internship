<?php

use yii\db\Migration;

/**
 * Class m190905_081411_createTableUsers
 */
class m190905_081411_createTableUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(150)->notNull(),
            'email'=>$this->string(150)->notNull(),
            'confirm_email_token'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(150)->notNull(),
            'status'=>$this->smallInteger()->defaultValue(0)->notNull(),
            'createAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updateAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_081411_createTableUsers cannot be reverted.\n";

        return false;
    }
    */
}
