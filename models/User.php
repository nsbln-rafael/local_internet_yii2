<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpMissingReturnTypeInspection */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int    $id
 * @property string $username
 * @property string $email
 * @property string $password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return 'user';
    }

    public static function findIdentity($id): ?IdentityInterface
    {
        return static::findOne($id);
    }

    public static function findByEmail($email): ?IdentityInterface
    {
        return static::findOne(['email' => $email]);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setPassword(string $password): void
    {
        $security = Yii::$app->security;

        $this->password = $security->generatePasswordHash($password);
    }

    public function validatePassword(string $password): bool
    {
        $security = Yii::$app->security;

        return $security->validatePassword($password, $this->password);
    }

    public function getAuthKey() {}

    public function validateAuthKey($authKey) {}

    public static function findIdentityByAccessToken($token, $type = null) {}
}
