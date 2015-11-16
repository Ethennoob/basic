<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "survey".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property string $sex
 * @property string $edu
 * @property string $info
 * @property string $hobby
 * @property string $create_time
 * @property string $user
 */
class Survey extends \yii\db\ActiveRecord
{
    public $file;
    public $user;
    /**
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
            [['name', 'age', 'sex', 'edu', 'info','file','user'], 'required'],
            [['age'], 'integer'],
            [['info'], 'string'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 2],
            [['hobby','logo','user'], 'string', 'max' => 100],
            [['edu'], 'string', 'max' => 5],
            [['file'],'file'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user'=>'用户',
            'id' => 'ID',
            'name' => '姓名',
            'age' => '年龄',
            'sex' => '性别',
            'edu' => '教育',
            'hobby' => '爱好',
            'info' => '信息',
            'create_time' => 'Create Time',
            'file' => 'logo',
        ];
    }
}
