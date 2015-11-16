<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '调查表管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Survey', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'age',
            'sex',
            'edu',
            'hobby',
             'info:ntext',
             'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Book # ' . $model->id,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
        'code',
        'name',
        ['attribute'=>'publish_date', 'type'=>DetailView::INPUT_DATE],
    ]
]);?>

</div>