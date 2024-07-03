<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'hak_akses'], 'required'],
            [['hak_akses'], 'string'],
            [['username', 'password'], 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Username ini sudah digunakan.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'hak_akses' => 'Hak Akses',
        ];
    }

    // Implementasi method dari IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Anda bisa mengabaikan method ini jika tidak menggunakan token
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // Anda bisa mengabaikan method ini jika tidak menggunakan auth key
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Anda bisa mengabaikan method ini jika tidak menggunakan auth key
        return null;
    }

    // Metode untuk validasi password
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getRole()
{
    return $this->hak_akses;
}

}
