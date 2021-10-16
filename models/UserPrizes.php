<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user_prizes".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property int|null $value
 * @property int|null $item_id
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TItem $item
 * @property TUser $user
 */
class UserPrizes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_user_prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'value', 'item_id', 'created_at', 'updated_at'], 'integer'],
            [['type', 'status'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TUser::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => TItem::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'value' => 'Value',
            'item_id' => 'Item ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(TItem::className(), ['id' => 'item_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TUser::className(), ['id' => 'user_id']);
    }
}
