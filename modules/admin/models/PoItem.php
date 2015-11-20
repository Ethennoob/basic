<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "po_item".
 *
 * @property integer $id
 * @property string $po_item_no
 * @property double $quanitity
 * @property integer $po_id
 *
 * @property Po $po
 */
class Poitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quanitity'], 'number'],
            [['po_item_no'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_item_no' => 'Po Item No',
            'quanitity' => 'Quanitity',
            'po_id' => 'Po ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return $this->hasOne(Po::className(), ['id' => 'po_id']);
    }
}
