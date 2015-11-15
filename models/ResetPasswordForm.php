<?php
namespace app\models;

use app\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password2;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 6,'max' => 20,'message' => '密码要求6-20位'],
            ['password2', 'required','message' => '确认密码不能为空'],
            ['password2', 'string', 'min' => 6,'max' => 20,'message' => '密码要求6-20位'],
            //验证密码和确认密码  
            ['password2','compare','compareAttribute'=>'password','message'=>'两次密码不一致'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => '新密码',
            'password2' => '确认密码',
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->password = md5($this->password);
        $user->removePasswordResetToken();

        return $user->save();
    }
}