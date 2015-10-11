<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use app\models\ResetPasswordForm;
use app\models\FindpwdForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFindpwd()
    {
    	$model = new FindpwdForm();

    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		    $connection = \Yii::$app->db;
    		    $command = $connection->createCommand("SELECT email FROM user where username ='".$model->username."'");  
    		    $email = $command->queryOne();
    		    if (empty($email)) {
    		    	Yii::$app->session->setFlash('emailerror','不存在此用户名 :(');
    		    } else {
    		    	foreach ($email as  $v) {
    				if ($v==$model->email) {
    					if ($model->sendEmail()) {
    						return $this->goHome();
    					} else {
    						Yii::$app->session->setFlash('emailerror','不存在此用户名 :(');
    					}   					
    				} else {
    					Yii::$app->session->setFlash('emailerror','邮箱和用户名不匹配，发送不成功 :(');
    				}
    			}
    		    }
    }
        return $this->render('findpwd',[
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
       try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'New password was saved.'));
            return $this->redirect(['/site/login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
