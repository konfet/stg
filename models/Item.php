<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_item".
 *
 * @property int $id
 * @property string $name
 *
 * @property TUserPrizes[] $tUserPrizes
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[TUserPrizes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTUserPrizes()
    {
        return $this->hasMany(TUserPrizes::className(), ['item_id' => 'id']);
    }
}
