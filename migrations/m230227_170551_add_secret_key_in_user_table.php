<?php

use yii\db\Migration;

/**
 * Class m230227_170551_add_secret_key_in_user_table
 */
class m230227_170551_add_secret_key_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'secret_key', Scema::TYPE_STRING);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'secret_key');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230227_170551_add_secret_key_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
