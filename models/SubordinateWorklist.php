<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subordinate_worklist".
 *
 * @property int $id
 * @property int|null $subordinate_id
 * @property int|null $superior_id
 * @property string|null $title
 * @property int|null $cc_category_id
 * @property int|null $cc_id
 * @property bool|null $isValid
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CcCategory $ccCategory
 * @property User $subordinate
 */
class SubordinateWorklist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subordinate_worklist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subordinate_id', 'superior_id', 'cc_category_id', 'cc_id'], 'default', 'value' => null],
            [['subordinate_id', 'superior_id', 'cc_category_id', 'cc_id'], 'integer'],
            [['isValid'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'subordinate_id' => 'Subordinate ID',
            'superior_id' => 'Superior ID',
            'title' => 'Title',
            'cc_category_id' => 'Cc Category ID',
            'cc_id' => 'Cc ID',
            'isValid' => 'Is Valid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}
