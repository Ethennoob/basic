<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '调查表管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Survey', ['value'=>Url::to('index.php?r=admin/survey/create'),'class' => 'btn btn-success','id'=>'modalButton']) ?>

    </p>
    <?php 
    Modal::begin([
            'header' => '<h4>用户</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
     ?>

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


</div>