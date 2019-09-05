<?php

use yii\db\Migration;

/**
 * Class m190905_142055_createTableUsers
 */
class m190905_142055_createTableUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45),
            'email' => $this->string(150)->notNull(),
            'password_hash' => $this->string(300)->notNull(),
            'token' => $this->string(150)->notNull(),
            'firstname' => $this->string(45),
            'lastname' => $this->string(45),
            'surname' => $this->string(45),
            'phoneNumber' => $this->integer(11)->notNull(),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updateAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->integer()->notNull()->defaultValue(0),
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
        echo "m190905_142055_createTableUsers cannot be reverted.\n";

        return false;
    }
    */
}
