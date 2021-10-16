<?php
namespace app\models;
use yii\base\Model;
 
class SignupForm extends Model{
    
    public $username;
    public $password;
    public $email;
    
    
    public function rules() {
        return [
            [['username', 'password', 'email'], 'required', 'message' => 'This field is mandatory'],
            ['email', 'email'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'This login is already used'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'username' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
        ];
    }
    
}