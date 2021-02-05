<?php

use yii\db\Migration;

class m210204_125740_seed_user_table extends Migration
{
    private const TABLE_NAME = "user";

    public function safeUp()
    {
        $password = Yii::$app->security->generatePasswordHash('password');

        $users = [
            [
                'id'       => 1,
                'username' => 'John',
                'email'    => 'john@example.com',
                'password' => $password
            ],
            [
                'id'       => 2,
                'username' => 'Alex',
                'email'    => 'alex@example.com',
                'password' => $password
            ],
            [
                'id'       => 3,
                'username' => 'Paul',
                'email'    => 'paul@example.com',
                'password' => $password
            ]
        ];

        $this->batchInsert(
            self::TABLE_NAME,
            ['id', 'username', 'email', 'password'],
            $users
        );
    }

    public function safeDown()
    {
        $this->delete(self::TABLE_NAME, ['id' => range(1,3)]);
    }
}
