<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .orange_brand {
            width: 250px;
            background-position: center;
            background-size: 80%;
            background-repeat: no-repeat;
            background-image: url("/images/logo.png");
            padding: 14px 20px 16px;
            font-size: 20px;
            color: #f6b75e !important;
            font-weight: bold;
            text-shadow: 0 -1px 0 rgba(0,0,0,.5);
        }
    </style>
    <?php echo yii\helpers\BaseHtml::cssFile('/css/loading_balls.css');?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        if (!Yii::$app->user->isGuest) {
            NavBar::begin([
                'brandLabel' => '',
                //'brandOptions' => ['class'=>"orange_brand"],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    //['label' => 'Главня', 'url' => ['/site/index']],
                    ['label' => 'Устройства', 'url' => [yii\helpers\Url::to('device')],'active'=> Yii::$app->controller->id == 'device'],
                    ['label' => 'Прошивки', 'url' => [yii\helpers\Url::to('firmware')],'active'=> Yii::$app->controller->id == 'firmware'],
                    ['label' => 'Конфигурации', 'url' => [yii\helpers\Url::to('configuration')],'active'=> Yii::$app->controller->id == 'configuration'],
                    ['label' => 'Пользователи', 'url' => ['#']],
                    ['label' => 'Организации', 'url' => ['#']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Вход', 'url' => ['/site/login']] :
                        ['label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        }
        ?>

        <div class="container" style="width: 100%">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="col-lg-6">&copy; <?= date('Y') ?>. Все права защищены <a href="http://www.teletracking.ru">ООО "Телетрекинг"</a></p>
            <p class="col-lg-6 text-right">тел. <a href="tel:+74957402234">+7 ( 495 ) 740 22 34, <a href="mailto:support@teletracking.ru">support@teletracking.ru</a></p>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
