<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * SignupForm is the model behind the Signup form.
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password2;
    public $email;
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
            ['username', 'string', 'min' => 6, 'max' => 20,'message' => '用户名要求6-20位'],
            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 6,'max' => 20,'message' => '密码要求6-20位'],
            ['password2', 'required','message' => '确认密码不能为空'],
            ['password2', 'string', 'min' => 6,'max' => 20,'message' => '密码要求6-20位'],
            //验证密码和确认密码  
            ['password2','compare','compareAttribute'=>'password','message'=>'两次密码不一致'],
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
            'password' => '密码',
            'password2' => '确认密码',
            'email' => 'E-mail',
            'verifyCode' => '验证码',
        ];
    }

    /**
     * 注册方法 
     */
    public function signup()
    {
    $request = Yii::$app->request;
    if ($this->validate()) {
        $user = new User();
        $user->attributes = $_POST['SignupForm'];//待处理，密码加密
        $user->save();
        echo "<script>alert('注册成功');window.location.href='index.php?r=site/login';</script>";
        }
    }
}
