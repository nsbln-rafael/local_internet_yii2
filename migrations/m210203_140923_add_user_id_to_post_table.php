<?php

use yii\db\Migration;

class m210203_140923_add_user_id_to_post_table extends Migration
{
    private const TABLE_NAME = 'post';

    public function safeUp()
    {
        $this->addColumn(self::TABLE_NAME, 'user_id', $this->integer());
        $this->addForeignKey('fk_' . self::TABLE_NAME . "_user",
            self::TABLE_NAME,
            'user_id',
            'user',
            'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_' . self::TABLE_NAME . "_user", self::TABLE_NAME);
        $this->dropColumn(self::TABLE_NAME, 'user_id');
    }
}
