<?php

use yii\db\Migration;

/**
 * Class m171229_132303_creata_table_activity
 */
class m171229_132303_creata_table_activity extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('activity', [
			'id' => $this->bigPrimaryKey(),
            'type' => $this->string(100)->notNull(),
            'action' => $this->string(100)->notNull(),
            'note' => $this->text(),
        ], $tableOptions);
        $this->addCommentOnColumn('activity', 'type', '类别');
        $this->addCommentOnTable('activity', '活动');
        /*
        $this->addForeignKey(
            'fk-visit-interaction',
            '{{%visit}}', 'id',
            '{{%interaction}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        */

    }

    public function safeDown()
    {
		//$this->dropForeignKey('fk-visit-interaction', '{{%visit}}');
		$this->dropTable('activity');
    }
}
