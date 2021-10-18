<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_statistics".
 *
 * @property int $user_id
 * @property int $money_received
 * @property int $money_transferred
 * @property int $money_converted_to_bonuses
 * @property int $bonuses_received
 * @property int $money_converted_from_money
 * @property int $bonuses_transferred
 * @property string|null $items_received
 * @property string|null $items_sent
 *
 * @property TUser $user
 */
class Statistics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_statistics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'money_received', 'money_transferred', 'money_converted_to_bonuses', 'bonuses_received', 'money_converted_from_money', 'bonuses_transferred'], 'integer'],
            [['items_received', 'items_sent'], 'string', 'max' => 5000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'money_received' => 'Total Money Received',
            'money_transferred' => 'Total Money Transferred',
            'money_converted_to_bonuses' => 'Total Money Converted To Bonuses',
            'bonuses_converted_from_money' => 'Total Bonuses Converted From Money',
            'bonuses_received' => 'Total Bonuses Received',
            'money_converted_from_money' => 'Total Money Converted From Money',
            'bonuses_transferred' => 'Total Bonuses Transferred',
            'items_received' => 'Items Received',
            'items_sent' => 'Items Sent',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
