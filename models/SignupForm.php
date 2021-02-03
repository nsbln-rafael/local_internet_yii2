<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules(): array
    {
        return [
            ['username', 'required'],
            ['username', 'string', 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email    = $this->email;
            $user->setPassword($this->password);

            return $user->save();
        }

        return false;
    }
}
