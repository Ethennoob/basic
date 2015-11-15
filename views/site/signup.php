<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use dosamigos\datepicker\DatePicker;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="row">
 <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to Sign up:</p>
        <div class="col-lg-5">
    <?php 
    if (Yii::$app->session->hasFlash('success')) {
        echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success'); 
        echo Html::a('前去登录', ['site/login'], ['class' => 'btn btn-primary'])."</div>";
    }elseif (Yii::$app->session->hasFlash('emailerror')) {
        echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('emailerror')."</div>";
    }
     ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'brithday')->widget(
                DatePicker::className(), [
                // inline too, not bad
                //'inline' => true, 
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]]);?>
            <?= $form->field($model, 'password')->input('password') ?>
            <?= $form->field($model, 'password2')->input('password')  ?>
            <?= $form->field($model, 'file')->fileInput();  ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
           ]) ?>
        </div>
</div>
    <div class="form-group">
        <?= Html::submitButton('注册', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
    </div>
<?php ActiveForm::end(); ?>