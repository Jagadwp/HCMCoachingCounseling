<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "superior_worklist".
 *
 * @property int $id
 * @property int|null $superior_id
 * @property int|null $subordinate_id
 * @property string|null $title
 * @property int|null $cc_category_id
 * @property int|null $cc_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CcCategory $ccCategory
 * @property User $superior
 */
class SuperiorWorklist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'superior_worklist';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
            // subordinate auto keisi sama logged user
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'subordinate_id',
                'updatedByAttribute' => 'subordinate_id'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superior_id', 'subordinate_id', 'cc_category_id', 'cc_id'], 'default', 'value' => null],
            [['superior_id', 'subordinate_id', 'cc_category_id', 'cc_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['superior_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['superior_id' => 'id']],
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
            'title' => 'Title',
            'cc_category_id' => 'Cc Category ID',
            'cc_id' => 'Cc ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
