<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "cc_result".
 *
 * @property int $id
 * @property int|null $cc_id
 * @property string|null $condition
 * @property string|null $problem
 * @property string|null $note
 * @property string $result
 * @property boolean $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Cc $cc
 */
class CcResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_result';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cc_id'], 'default', 'value' => null],
            [['cc_id'], 'integer'],
            [['condition', 'problem', 'note', 'result'], 'string'],
            [['result'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'boolean'],
            [['cc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cc::class, 'targetAttribute' => ['cc_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cc_id' => 'Cc ID',
            'condition' => 'Condition',
            'problem' => 'Problem',
            'note' => 'Note',
            'result' => 'Result',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Cc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCc()
    {
        return $this->hasOne(Cc::class, ['id' => 'cc_id']);
    }
}
