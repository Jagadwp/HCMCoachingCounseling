<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $superior_id
 * @property string $name
 * @property string $email
 * @property string $nik
 * @property string $password
 * @property string|null $role
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $username
 *
 * @property SuperiorWorklist[] $superiorWorklists
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superior_id'], 'default', 'value' => null],
            [['superior_id'], 'integer'],
            [['name', 'email', 'nik', 'password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 55],
            [['nik'], 'string', 'max' => 16],
            [['password', 'role', 'auth_key', 'access_token', 'username'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'superior_id' => 'Superior ID',
            'name' => 'Name',
            'email' => 'Email',
            'nik' => 'Nik',
            'password' => 'Password',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
        ];
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
