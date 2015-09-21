<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\modules\admin\models\Survey;
/**
 * This is the model class for table "survey".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property string $sex
 * @property string $edu
 * @property string $hobby
 * @property string $info
 * @property string $creat_time
 */
class SurveyForm extends Model
{
    public $name;
    public $age;
    public $sex;
    public $edu;
    public $hobby;
    public $info;
    public $creat_time;
    public $verifyCode;
    /**
     *  
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age'], 'integer','message'=>'注意填写格式,填写数字'],
            [['age'], 'integer','max' => 100,'message' => '注意填写格式'],
            [['name', 'age', 'sex', 'edu'], 'required','message'=>'必填'],
            [['info'], 'string'],
            [['creat_time'], 'safe'],
            [['name', 'edu'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 2],
            //[['hobby'], 'string', 'max' => 100],
            ['verifyCode', 'captcha','message' => '验证码有误'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'age' => '年龄',
            'sex' => '性别',
            'edu' => '教育',
            'hobby' => '爱好',
            'info' => '信息',
            'creat_time' => 'Creat Time',
            'verifyCode' => '验证码',
        ];
    } 
    /**
     * 调查表单提交 
     */
    public function surveysub()
    {
    if ($this->validate()) {
        $survey = new Survey();//save错误源：以前是 new SurveyForm()
        //$survey->attributes = $_POST['SurveyForm'];
        $survey->create_time = date('Y-m-d H:i:s',time());
        $survey->name = $_POST['SurveyForm']['name'];
        $survey->age = $_POST['SurveyForm']['age'];
        $survey->sex = $_POST['SurveyForm']['sex'];
        $survey->edu = $_POST['SurveyForm']['edu'];
        $survey->info = $_POST['SurveyForm']['info'];
        $survey->hobby = implode('/',$_POST['SurveyForm']['hobby']);
        if($survey->hasErrors()){
           Yii::$app->session->setFlash('haserror','数据有问题 :(');
        }
        if($survey->save()){
            return $survey;
            }
        } 
        return null;
    }
}

