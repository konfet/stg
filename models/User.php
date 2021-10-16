<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $bank_account
 * @property integer $bonus_account
 */
class User extends ActiveRecord implements IdentityInterface
{
 
    const S_DELETED = 'deleted';
    const S_ACTIVE = 'active';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::S_ACTIVE],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::S_ACTIVE]);
    }

    /**
     * @inheritdoc
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username if active
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::S_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getUserPrizes()
    {
        return $this->hasMany(UserPrizes::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    public function sendConfirmation($pass) {
        $text = "<h2>You were successfully registered on site SLOTEGRATOR.</h2>";
        $text .= "<p>Login: {$this->username} Pasword: $pass </p>";
        $text .= "<p>Do not answer to this mail.</p>";
        \Yii::$app->mailer->compose()
             ->setFrom(['konfet@email.cz' => 'SLOTEGRATOR'])
             ->setTo($this->email)
             ->setSubject('Registration on site')             
             ->setHtmlBody($text)
             ->send();
    }
}
