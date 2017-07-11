<?php

use yii\db\Migration;

class m170711_060732_create_table_warehousing extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        /**
         * Table 'om_warehousing'
         */
        $this->createTable('{{%warehousing}}', [
			'id' => $this->bigPrimaryKey(),
            'sender' => $this->boolean()->notNull(),
            'device' => $this->boolean()->notNull(),
            'number' => $this->string(16),
            'quantity' => $this->integer(),
            'status' => $this->boolean()->notNull(),
            'mv' => $this->decimal(4,2),
            'd10' => $this->decimal(4,2),
            'd50' => $this->decimal(4,2),
            'd90' => $this->decimal(4,2),
            'd95' => $this->decimal(4,2),
            'channel_max' => $this->decimal(4,2),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(5)->unsigned()->notNull(),
            'updated_by' => $this->integer(5)->unsigned()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        echo "m170711_060732_create_table_warehousing cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
