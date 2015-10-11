<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="glyphicon glyphicon-apple"></i>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
                ['label' => '<i class="glyphicon glyphicon-home"></i> ' . Yii::t('app', 'Home'), 'url' => ['/site/index']],
                ['label' => '<i class="glyphicon glyphicon-globe"></i> ' . Yii::t('app', 'About'), 'url' => ['/site/about']],
                ['label' => '<i class="glyphicon glyphicon-blackboard"></i> ' . Yii::t('app', 'Mac'), 'url' => ['/site/contact']],
                ['label' => '<i class="glyphicon glyphicon-edit"></i> ' . Yii::t('app', 'iPad'), 'url' => ['/site/contact']],
                ['label' => '<i class="glyphicon glyphicon-phone"></i> ' . Yii::t('app', 'iPhone'), 'url' => ['/site/contact']],
                ['label' => '<i class="glyphicon glyphicon-modal-window"></i> ' . Yii::t('app', 'Watch'), 'url' => ['/site/contact']]
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-plus-sign"></i> ' . Yii::t('app', 'Sign up'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-log-in"></i> ' . Yii::t('app', 'Log in'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-shopping-cart"></i> ' . Yii::t('app', ''), 'url' => ['/user/index']];
                $menuItems[] = [
                    'label' => '<i class="glyphicon glyphicon-log-out"></i> ' . Yii::t('app', 'Log out') . '(' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

 NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
