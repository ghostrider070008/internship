<?php

use yii\db\Migration;

/**
 * Class m190905_143515_createTableCategories
 */
class m190905_143515_createTableCategories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'category_name' => $this->string(150)->notNull(),
            'parent_category_id' => $this->integer(11)->notNull(),
            'img' => $this->string(150)->notNull(),
            'description' => $this->text()->notNull(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        //$this->createIndex('category_name_id', 'categories', 'category_name', true);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_143515_createTableCategories cannot be reverted.\n";

        return false;
    }
    */
}
