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
 */
class Survey extends \yii\db\ActiveRecord
{
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
            [['name', 'age', 'sex', 'edu', 'info'], 'required'],
            [['age'], 'integer'],
            [['info'], 'string'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 2],
            [['hobby'], 'string', 'max' => 100],
            [['edu'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'age' => '年龄',
            'sex' => '性别',
            'edu' => '教育',
            'hobby' => '爱好',
            'info' => '信息',
            'create_time' => 'Create Time',
        ];
    }
}
