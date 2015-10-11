<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * FindpwdForm is the model behind the login form.
 */
class FindpwdForm extends Model
{
    public $username;
    public $email;
    public $verifyCode;

    //private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required','message' => '用户名不能为空'],
            // email has to be a valid email address
            ['email', 'email','message' => '按邮箱格式填写'],
            ['email','required','message' => '邮箱不能为空'],
           
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha','message' => '验证码有误'],
        ];
    }

    /**
     * 设置标签的显示名字 
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => '注册邮箱',
            'verifyCode' => '验证码',
        ];
    }
   /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                    $resetLink = "http://172.16.134.31/basic/web/index.php?r=user/reset-password&token=".$user->password_reset_token;
                return \Yii::$app->mailer->compose()
                    //->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)   //发布纯文字文本
                    ->setHtmlBody('<br>尊敬的用户:'.$user->username.'<br>点击此链接修改密码：<a href="'.$resetLink.'">'.$resetLink.'</a>')
                    ->send();
            }
        }
        return false;
    }
}
