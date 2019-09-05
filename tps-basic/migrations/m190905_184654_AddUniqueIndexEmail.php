<?php

use yii\db\Migration;

/**
 * Class m190905_184654_AddUniqueIndexEmail
 */
class m190905_184654_AddUniqueIndexEmail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('UserEmailUniq','users','email',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_184654_AddUniqueIndexEmail cannot be reverted.\n";

        return false;
    }
    */
}
