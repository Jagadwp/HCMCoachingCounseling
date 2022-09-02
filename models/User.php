<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends Account implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return TRUE;
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByName($name)
    {
        return User::findOne(['name'=> $name]);
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return User::findOne(['email'=> $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Gets query for [[SuperiorWorklists]].
     *
     * @return \yii\db\ActiveQuery
     */
}
