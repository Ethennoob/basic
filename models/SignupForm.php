<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\base\Model;
use app\models\User;
use yii\web\UploadedFile;

/**
 * SignupForm is the model behind the Signup form.
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password2;
    public $email;
    public $brithday;
    public $file;
    public $avatar;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            // email has to be a valid email address
            ['email', 'email','message' => '按邮箱格式填写'],
            ['email','required','message' => '邮箱不能为空'],
            ['username', 'required','message' => '用户名不能为空'],
            ['username', 'unique','targetClass' => 'app\models\User', 'message' => '用户名已存在'],
            ['email', 'unique','targetClass' => 'app\models\User', 'message' => 'E-mail已存在'],
            ['username', 'string', 'min' => 6, 'max' => 20,'message' => '用户名要求6-20位'],
            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 6,'max' => 20,'message' => '密码要求6-20位'],
            ['password2', 'required','message' => '确认密码不能为空'],
            ['password2', 'string', 'min' => 6,'max' => 20,'message' => '密码要求6-20位'],
            ['brithday','required','message' => '生日不能为空'],
            //验证密码和确认密码  
            ['password2','compare','compareAttribute'=>'password','message'=>'两次密码不一致'],
            // verifyCode needs to be entered correctly
            [['file'],'file'],
            [['avatar'], 'string', 'max' => 255],
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
            'password' => '密码',
            'password2' => '确认密码',
            'email' => 'E-mail',
            'brithday' => '出生日期',
            'file' => '头像',
            'verifyCode' => '验证码',
        ];
    }

    /**
     * 注册方法 
     */
    public function signup()
    {
    if ($this->validate()) {
        $user = new User();
        $model = new SignupForm();
        //$user->attributes = $_POST['SignupForm'];//另一种POST方法
        $user->username = Html::encode($_POST['SignupForm']['username']);//待处理，md5密码加密完成
        $user->password =  Html::encode($this->password);
        $user->setPassword($user->password);
        $user->email = Html::encode($_POST['SignupForm']['email']);
        $user->brithday = Html::encode($_POST['SignupForm']['brithday']);
        $user->generateAuthKey();
        $model->file = UploadedFile::getInstance($model, 'file');
        $model->file->saveAs('uploads/avatar/' . $user->username. '.' . $model->file->extension);
        //保存图片路径在数据库*/
        $user->avatar = 'uploads/avatar/'.$user->username.'.'.$model->file->extension;
       
        //$hash = Yii::$app->getSecurity()->generatePasswordHash($password);//hash加密
        if ($user->save()) {
                return $user;
            }
        } return null;
    }

    public function sendEmail()
    {
        return \Yii::$app->mailer->compose()
                    //->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Congratulate sign up for Apple.Inc')   //发布纯文字文本
                    ->setHtmlBody('<br>您已经成功注册！成为XXX会员<br>您的用户名是：'.$this->username.'<br>此邮箱为找回密码绑定邮箱:)')    //发布可以带html标签的文本*/
                    ->send();
    }
}
