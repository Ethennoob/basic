<?php 

namespace app\models;

use yii\db\ActiveRecord;
/**
* test1的数据库models
*/
class Test1 extends ActiveRecord
{
	//http://www.yiichina.com/doc/guide/2.0/tutorial-core-validators
	public function rules(){
		return[
		['id','integer'],
		//['title','string','length'=>[0,5]],//核心验证器
		[['title'], 'trim'],
		['title', 'email'],// trim 掉 "username" 和 "email" 两侧的多余空格
		// 检查 "username" 是否由字母开头，且只包含单词字符
		//['username', 'match', 'pattern' => '/^[a-z]\w*$/i']//正则
		
		];
	}
}
 ?>