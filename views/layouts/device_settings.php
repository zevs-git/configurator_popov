<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */
?>
<style>
    .input-group-html5 input[type="color"], .input-group-html5 input[type="range"] {
        height: 12px !important;
    }
</style>
<?php $this->registerJs(
    "   
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });"); ?>
</script>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?php //tabs..  echo getTabs(); echo $content; ?>
<div class="col-md-3 col-sm-4">
    <?php $icon = '<i class="glyphicon glyphicon-chevron-right"></i>'; ?>
    <?=
    \kartik\helpers\Html::listGroup(
        [
            ['content' => $icon . 'Паспорт изделия',        'url' => ['device' . '/'  . $this->params['model_id']],'active'=> isActiveAction('view')],
            ['content' => $icon . 'Настройи сервера',       'url' => ['device/settingsserver'. '/'  . $this->params['model_id']],'active'=> isActiveAction('settingsserver')],
            ['content' => $icon . 'Системные настройки',    'url' => ['device/settingssystem'. '/'  . $this->params['model_id']],'active'=> isActiveAction('settingssystem')],
            ['content' => $icon . 'Параметры трека',        'url' => ['device/settingstrack'. '/'   . $this->params['model_id']],'active'=> isActiveAction('settingstrack')],
            ['content' => $icon . 'Настройи SIM карты',      'url' => ['device/settingssim'. '/'    . $this->params['model_id']],'active'=> isActiveAction('settingssim')],
            ['content' => $icon . 'Дескретные входы/выходы', 'active' => false, 'url' => '#'],
            /*['content' => $icon . 'Входы/выходы', 'active' => false, 'url' => '#'],
            ['content' => $icon . 'Системные настройки', 'active' => false, 'url' => '#'],
            ['content' => $icon . 'Номера телефонов', 'active' => false, 'url' => '#'],*/
        ]
    );
    ?>
</div>
<div class="col-md-9 col-sm-8">
    <?= $content ?>
</div>
<a href="#top" id="backToTop" class="back-to-top btn btn-warning pull-right" title="Return to top"><i class="glyphicon glyphicon-circle-arrow-up"></i> Top</a>
<?php
$this->endContent();

function getTabs() {
    return \yii\bootstrap\Nav::widget([
                'options' => ['class' => 'nav-tabs'],
                'items' => [
                    ['label' => 'Паспорт изделия', 'content' => 'Паспорт изделия', 'active' => true, 'url' => '#'],
                    ['label' => 'Настройи сервера', 'content' => 'Настройи сервера', 'url' => '#'],
                    ['label' => 'Настройи SIM карты', 'content' => 'Настройи SIM карты'],
                    ['label' => 'Параметры трека', 'content' => 'Anim pariatur cliche...'],
                    ['label' => 'Системные настройки', 'content' => 'Anim pariatur cliche...'],
                    ['label' => 'Номера телефонов', 'content' => 'Anim pariatur cliche...', 'headerOptions' => []],
                    ['label' => 'Входы/выходы',
                        'items' => [
                            ['label' => 'Встроенные входы/выходы', 'content' => 'DropdownA, Anim pariatur cliche...',],
                            ['label' => 'Дескретные входы/выходы', 'content' => 'DropdownB, Anim pariatur cliche...',],
                        ],
                    ],
                ],
    ]);
}

function isActiveAction($action) {
    return Yii::$app->controller->action->id == $action;
}

