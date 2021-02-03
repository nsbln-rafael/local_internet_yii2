<?php

use yii\db\Migration;

class m210203_112820_create_user_table extends Migration
{
    private const TABLE_NAME = 'user';

    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id'       => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email'    => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
