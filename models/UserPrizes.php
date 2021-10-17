<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
 * @property Item $item
 * @property User $user
 */
class UserPrizes extends \yii\db\ActiveRecord
{
//  the prize is active so it can be claimed by the user
    const S_ACTIVE = 'active';
//  the user denied the prize, so it cannot be claimed by the user    
    const S_REFUSED = 'refused';
//  the prize was sent or transfered to the user.
    const S_SENT = 'sent';
//  for future enhancements - user confirmed that he have received the gift
//    const S_RECEIVED = '';
    
    const CURRENCY = 'USD';
    
    const T_MONEY = 'money';
    const T_BONUS = 'bonus';
    const T_GIFT = 'gift';
    
    const ACTIONS = [
        self::T_MONEY => ['help' => 'Transfer money to your bank account', 'msg' => 'Transfer was successful. Check your bank account.'],
        self::T_BONUS => ['command' => 'Transfer bonuses to your loyalty account', 'msg' => 'Transfer was successful.'],
        self::T_GIFT => ['command' => 'Send the giftby post to this address', 'msg' => 'The gift was sent.'],
    ];
    
    const MONEY_TO_BONUSES_KOEFF = 10;
            
        
    public static function tableName()
    {
        return 't_user_prizes';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


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
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
            
    
    public function showButton($action){
        if ($this->status != self::S_ACTIVE) {
            return false;
        }
        if (($action == 'convert') && ($this->type != self::T_MONEY)) {
            return false;
        }
        return true;
    }
    
    public static function eMin($type){
        if ($type == self::T_MONEY) return 1;
        if ($type == self::T_BONUS) return 1;
        return 1;
    }
    
    public static function eMax($type){
        if ($type == self::T_MONEY) return 10;
        if ($type == self::T_BONUS) return 100;
        return 1;        
    }
    
    public static function eLimit($type){
        if ($type == self::T_MONEY) return 70;
        if ($type == self::T_BONUS) return PHP_INT_MAX;
        if ($type == self::T_GIFT) return 14;
        return 1;
    }
    
    public function getDescr() {
        if ($this->type == self::T_MONEY) return "{$this->value} " . self::CURRENCY;
        if ($this->type == self::T_BONUS) return "{$this->value} bonuses";
        if ($this->type == self::T_GIFT) return $this->item->name;
        return null;        
    }
    
    /**
     * could be done only when STATUS = ACTIVE, and for any type     
     */
    
    public function transfer(){
        $stat = $this->user->statistics;
        $transaction = \Yii::$app->db->beginTransaction();
        try {            
            switch ($this->type) {
                case self::T_MONEY:
                    $stat->money_transferred += $this->value;
                    $text = 'Your money was transferred! Check your bank account.';
                    break;
                case self::T_BONUS:
                    $stat->bonuses_transferred += $this->value;
                    $text = 'Your bonuses was transferred! Check your loyalty account.';
                    break;
                case self::T_GIFT:
                    $stat->items_sent += 1;
                    $text = 'Your gift was sent! Check your mailbox in 2-3 days.';
                    break;
                default:
            }
            $this->status = self::S_SENT;
            $this->save(false);  
            $stat->save(false);  
            $transaction->commit();            
        }
        catch (Exception $e) {
            $transaction->rollBack();
        }
        Yii::$app->session->setFlash('actionDone', $text);
    }
    /**
     * could be done only when STATUS = ACTIVE     
     */
    
    public function refuse(){   
        $this->status = self::S_REFUSED;
        $this->save(false);  
        $text = 'Your have refused your prize.';
        Yii::$app->session->setFlash('actionDone', $text);
    }

    /**
     * could be done only when STATUS = ACTIVE and TYPE=Money
     * The change money => bonuses change the type of prize and the amount of it. The status remains Active.     
     */
   
    public function convert(){
        $transaction = \Yii::$app->db->beginTransaction();
        $stat = $this->user->statistics;        
        $this->type = self::T_BONUS;
        $ex_money = $this->value;
        $this->value = $ex_money * self::MONEY_TO_BONUSES_KOEFF;
        $this->comment = 'Money were changed to bonuses';
        $text = $this->comment;
        $this->save(false);
        $stat->money_converted_to_bonuses += $ex_money;
        $stat->bonuses_converted_from_money += $this->value;
        $stat->save(false);        
        $transaction->commit();                            
        Yii::$app->session->setFlash('actionDone', $text);

    }
    
    /** 
     * *****************************************************************************************************************************
     * get random prize taking into account all limitations. 
     * If limit for money or gift is exceeded, then money or gift cannot be given as prize.
     * The change money => bonuses change the type of prize and the amount of it. The status remain Active.     
     */
    
    
    public static function getRandomPrize(){
        $transaction = \Yii::$app->db->beginTransaction();
        $user = User::findOne(['id' => Yii::$app->user->getId()]);
        $stat = $user->statistics;
        $prize = new UserPrizes();
        $prize->user_id = $user->id;
        $text = '';
        $i = 1;
//  bonuses have no limits        
        $arr[1] = self::T_BONUS;
        if ($user->getActiveMoney() < self::eLimit(self::T_MONEY)) {
            $i ++;
            $arr[$i] = self::T_MONEY;
        }
        else {
            $text .= "Limit of money reached. ";
        }
        if ($user->getActiveGifts() < self::eLimit(self::T_GIFT)) {
            $i ++;
            $arr[$i] = self::T_GIFT;
        }
        else {
            $text .= "Limit of gifts reached. ";
        }
        $type = $arr[random_int(1, count($arr))];
        $prize->type = $type;
        if ($type == self::T_GIFT) {
//  chose random item as gift            
            $arr = Item::find()->asArray()->all();
            $rand_key = array_rand($arr);
            $prize->item_id = $arr[$rand_key]['id']; 
            $prize->value = 1;
            $stat->items_received += 1;            
        }
        else {            
            $prize->value = random_int(self::eMin($type), self::eMax($type));
            if ($type == self::T_MONEY) {
                $stat->money_received += $prize->value;
            }
            else {
                $stat->bonuses_received += $prize->value;
            }
                
        }
        $prize->save(false);
        $stat->save(false);        
        $transaction->commit();              
        if ($text != '') {
            Yii::$app->session->setFlash('message', $text);
        }
        return $prize;
    }
    
    
}
