<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user !== null) {
                return Yii::$app->user->login($user);
            }
        }
        return false;
    }
    

    protected function getUser()
    {
        return User::findOne(['username' => $this->username]);
    }
}
