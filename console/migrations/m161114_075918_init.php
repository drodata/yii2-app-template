<?php

use yii\db\Migration;

class m161114_075918_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'slug' => $this->string(50)->notNull()->unique(),
            'parent_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'screen_name' => $this->string(30)->notNull(),
            'group_id' => $this->integer()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->boolean()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'last_logined_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%lookup}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->smallInteger()->notNull(),
            'type' => $this->string(128)->notNull(),
            'position' => $this->smallInteger()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user_option}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%lookup}}');
    }
}
