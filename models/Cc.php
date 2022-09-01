<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "cc".
 *
 * @property int $id
 * @property int|null $superior_id
 * @property int|null $subordinate_id
 * @property int|null $cc_category_id
 * @property string|null $link
 * @property string|null $location
 * @property string|null $date
 * @property string|null $time
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CcCategory $ccCategory
 * @property CcResult[] $ccResults
 * @property User $subordinate
 * @property User $superior
 */
class Cc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
            // superior_id auto keisi sama logged user
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'superior_id',
                'updatedByAttribute' => 'superior_id'
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superior_id', 'subordinate_id', 'cc_category_id'], 'default', 'value' => null],
            [['superior_id', 'subordinate_id', 'cc_category_id'], 'integer'],
            [['date', 'time', 'created_at', 'updated_at'], 'safe'],
            [['link', 'location'], 'string', 'max' => 255],
            [['superior_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['superior_id' => 'id']],
            [['subordinate_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['subordinate_id' => 'id']],
            // [['cc_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CcCategory::class, 'targetAttribute' => ['cc_category_id' => 'id']],
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
            'subordinate_id' => 'Subordinate ID',
            'cc_category_id' => 'Cc Category ID',
            'link' => 'Link',
            'location' => 'Location',
            'date' => 'Date',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CcResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcResult()
    {
        return $this->hasOne(CcResult::class, ['cc_id' => 'id']);
    }

    /**
     * Gets query for [[Subordinate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubordinate()
    {
        return $this->hasOne(User::class, ['id' => 'subordinate_id']);
    }

    /**
     * Gets query for [[Superior]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuperior()
    {
        return $this->hasOne(User::class, ['id' => 'superior_id']);
    }
}
