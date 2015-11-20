<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Po Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Po Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'po_item_no',
            'quanitity',
            'po_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
