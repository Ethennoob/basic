<?php

use yii\helpers\Html;
/*use yii\widgets\DetailView;*/
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'email:email',
            'brithday',
            'authKey',
            'accessToken',
        ],
    ]) */?>
    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Survey # ' . $model->id,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
            'username',
            'email:email',
            'brithday',
            'authKey',
            'accessToken',
        /*['attribute'=>'brithday', 'type'=>DetailView::INPUT_DATE],*/
    ]
]);?>

</div>