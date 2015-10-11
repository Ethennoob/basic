<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\models\FindpwdForm;
use yii\captcha\Captcha;

$this->title = '找回密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-findpwd">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to Find password:</p>
    <?php 
    if (Yii::$app->session->hasFlash('sendmail')) {
        echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('sendmail')."</div>"; 
    }elseif (Yii::$app->session->hasFlash('emailerror')) {
        echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('emailerror')."</div>";
    }
     ?>
    <?php $form = ActiveForm::begin([
        'id' => 'findpwd-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'email') ?>

       <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-7 pull-right">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('发送邮件', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>