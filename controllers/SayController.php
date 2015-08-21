<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Cookie;
use app\models\Test1;

class SayController extends Controller
{
    public $layout='common';

    public function actionSay()
    {
        $res = \Yii::$app->response;
        echo "hello world";
        //$res->statusCode ="404";
        //$res->headers->add('prama');
        //跳转
        //$res->headers->add('location','http://www.baidu.com');
        //$this->redirect('http://www.baidu.com');
        //文件下载
        //$res->headers->add('content-disposition','attachment;filename="a.jpg"');
        //$res->sendFile('./robots.txt');    
    }
    public function actionSession(){
    	$session = \Yii::$app->session;//调用session组件
    	$session->open();//打开session

    	$session->set('user','张三');//设定session
       echo $session->get('user'); //取数据
       //$session->remove('user');//删数据
       // $session['user']='张三';
       // unset($session['user']);
       
    }
    public function actionCookie(){
        $cookies=\Yii::$app->response->cookies;

        $cookie_date=array('name'=>'user','value'=>'zhangsan');
        $cookies->add(new Cookie($cookie_date));
        // $cookies->remove('user');

         $cookies=\Yii::$app->request->cookies;
         echo $cookies->getValue('user');

    }
    public function actionView(){

        $hello_str='hello god!<script>alert(3);</script>';
        $test_arr=array(1,2);
        //创建一个数组
        $date=array();

        //把需要传递给视图的数据，放到数组当中
        $date['view_hello_str']=$hello_str;
        $date['view_test_arr']=$test_arr;


        return $this->render('index',$date);//$content
    }
    public function actionTest1(){
        //查询数据
        //$id='1 or 1=1';
        //$sql='select * from test1 where id=:id';
        //$results=Test1::findBySql($sql,array(':id'=>'1 or 1=1'))->all();
        //print_r($results);

        $res=Test1::find()->where(['id'=>1])->all();//id=1
        
        $res=Test1::find()->where(['>','id',0])->all();//id>0
        
        $res=Test1::find()->where(['between','id',1,2])->all();//id>=1并且id<=2

        $res=Test1::find()->where(['like','title','title2'])->all();//title like %title2%
        

        //查询结果转换成数组
        $res=Test1::find()->where(['between','id',1,2])->asArray()->all();
        

        //批量查询
        /*foreach (Test1::find()->asArray()->batch(1) as $tests) {
          echo $tests;

        }*/
        //删除单数据
        //Test1::deleteAll('id=:id',array(':id'=>2));
        
        //插入单数据
        $test=new Test1;
        /*$test->id='';
        $test->title='dadsada@dasda.com';
        $test->validate();//验证数据格式
        if($test->hasErrors()){//判定是否出现错误
            echo "data is error!"; die; 
        }else{
            echo "data is successful!"; 
            $test->save(); 
        }*/

        //修改单数据
        $test=Test1::find()->where(['id'=>4])->one();
        $test->title='title4';
        $test->save();
        print_r($test);
        //$this->render('index',$res);
    }
}