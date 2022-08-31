<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "superior_worklist".
 *
 * @property int $id
 * @property int|null $superior_id
 * @property int|null $subordinate_id
 * @property int|null $cc_category_id
 * @property int|null $cc__id
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['superior_id', 'subordinate_id', 'cc_category_id', 'cc__id'], 'default', 'value' => null],
            [['superior_id', 'subordinate_id', 'cc_category_id', 'cc__id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['superior_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['superior_id' => 'id']],
            // [['cc_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CcCategory::className(), 'targetAttribute' => ['cc_category_id' => 'id']],
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
            'cc__id' => 'Cc  ID',
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
        return $this->hasOne(User::class(), ['id' => 'superior_id']);
    }
}
