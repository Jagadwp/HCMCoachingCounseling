<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Cc[] $ccs
 * @property SubordinateWorklist[] $subordinateWorklists
 * @property SuperiorWorklist[] $superiorWorklists
 */
class CcCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Ccs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcs()
    {
        return $this->hasMany(Cc::class, ['cc_category_id' => 'id']);
    }

    /**
     * Gets query for [[SubordinateWorklists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubordinateWorklists()
    {
        return $this->hasMany(SubordinateWorklist::class, ['cc_category_id' => 'id']);
    }

    /**
     * Gets query for [[SuperiorWorklists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuperiorWorklists()
    {
        return $this->hasMany(SuperiorWorklist::class, ['cc_category_id' => 'id']);
    }
}
