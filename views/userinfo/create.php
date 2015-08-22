<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Userinfo */

$this->title = 'Create Userinfo';
$this->params['breadcrumbs'][] = ['label' => 'Userinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
