<?php
 
/*
 * 用户表
 */
 
namespace app\models;
 
use yii\db\ActiveRecord;
use Yii;
 
class Users extends \yii\db\ActiveRecord {
 
    /**
     * @return string 返回该AR类关联的数据表名
     */
    public static function user() {
        return 'user';
    }
 
}