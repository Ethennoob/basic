<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = '用户中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <strong>待开发...</strong>
    </p>
    <p>
    	<?= Html::a('找回密码',['user/findpwd'], ['class'=>'btn btn-primary']) ?>
    </p>
    
    <code><?= __FILE__ ?></code>
</div>
