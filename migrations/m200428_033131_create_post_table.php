<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m200428_033131_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            "title"=>\yii\db\Schema::TYPE_STRING." NOT NULL",
            "content"=>\yii\db\Schema::TYPE_TEXT,
            "created"=>\yii\db\Schema::TYPE_DATETIME,
            "updated"=>\yii\db\Schema::TYPE_DATETIME
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
