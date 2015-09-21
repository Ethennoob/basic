<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '调查';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="row">
 <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to Survey:</p>
        <div class="col-lg-5">
    <?php 
    if (Yii::$app->session->hasFlash('subsuccess')){
        echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('subsuccess')."</div>";
    }else
    if(Yii::$app->session->hasFlash('suberror')){
        echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('suberror')."</div>";
    }else
    if (Yii::$app->session->hasFlash('haserror')) {
        echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('haserror')."</div>";
    }
     ?>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 4]) ?>
            <?= $form->field($model, 'age')->textInput(['maxlength' => 2]) ?>           
            <?= $form->field($model, 'sex')->radioList(['男'=>'男','女'=>'女']) ?>
            <?= $form->field($model, 'edu')->dropDownList(['大学'=>'大学','中学'=>'中学','小学'=>'小学']) ?>
            <?= $form->field($model, 'hobby')->checkBoxList(['篮球'=>'篮球','足球'=>'足球','排球'=>'排球','跑步'=>'跑步']) ?>
            <?= $form->field($model, 'info')->textarea(['row'=>3]) ?>
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
