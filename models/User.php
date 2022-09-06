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
     * Gets query for [[User (superior)]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuperior()
    {
        return $this->hasOne(User::class, ['id' => 'superior_id'])
            ->select(["id", "name", "email"]);
    }

    /**
     * Gets query for [[User (superior)]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubordinates()
    {
        return $this->hasMany(User::class, ['superior_id' => 'id'])
            ->select(["id", "name", "email"]);
    }

    /**
     * Gets query for [[Ccs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuperiorCcs()
    {
        return $this->hasMany(Cc::class, ['superior_id' => 'id']);
    }

    /**
     * Gets query for [[Ccs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubordinateCcs()
    {
        return $this->hasMany(Cc::class, ['subordinate_id' => 'id']);
    }

    /**
     * Gets query for [[SubordinateWorklists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubordinateWorklists()
    {
        return $this->hasMany(SubordinateWorklist::class, ['subordinate_id' => 'id']);
    }

    /**
     * Gets query for [[SuperiorWorklists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuperiorWorklists()
    {
        return $this->hasMany(SuperiorWorklist::class, ['superior_id' => 'id']);
    }
}
