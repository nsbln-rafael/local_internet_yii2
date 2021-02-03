<?php

use yii\db\Migration;

class m210202_055556_create_post_table extends Migration
{
    private const TABLE_NAME = 'post';

    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id'                => $this->primaryKey(),
            'title'             => $this->string()->notNull(),
            'description'       => $this->text()->notNull(),
            'description_short' => $this->string()->notNull(),
            'image'             => $this->string()->null(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
