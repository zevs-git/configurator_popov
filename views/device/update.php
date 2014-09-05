<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 */
$this->title = Yii::t('app', 'Паспорт {modelClass} ', [
            'modelClass' => 'изделия',
        ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="device-update">

    <div class="col-lg-2">
        <div class="panle panel-default">
            <div class="panel panel-heading">fafads</div>
            <?php
            echo \kartik\helpers\Html::listGroup(
                    [
                        ['label' => 'Паспорт изделия', 'content' => '<i class="glyphicon glyphicon-chevron-right"></i>Паспорт изделия', 'active' => true, 'url' => '#'],
                        ['label' => 'Настройи сервера', 'content' => '<i class="glyphicon glyphicon-chevron-right"></i>Настройи сервера', 'url' => '#'],
                        ['label' => 'Настройи SIM карты', 'content' => 'Настройи SIM карты'],
                        ['label' => 'Дескретные входы/выходы', 'content' => 'Anim pariatur cliche...'],
                        ['label' => 'Параметры трека', 'content' => 'Anim pariatur cliche...'],
                        ['label' => 'Входы/выходы', 'content' => 'Anim pariatur cliche...'],
                        ['label' => 'Системные настройки', 'content' => 'Anim pariatur cliche...'],
                        ['label' => 'Номера телефонов', 'content' => 'Anim pariatur cliche...', 'headerOptions' => [], 'options' =>
                            ['id' => 'myveryownID'],], ['label' => 'Dropdown',
                            'items' => [
                                ['label' => 'DropdownA', 'content' => 'DropdownA, Anim pariatur cliche...',],
                                ['label' => 'DropdownB', 'content' => 'DropdownB, Anim pariatur cliche...',],
                            ],
                        ],
            ]);
            ?>
        </div>
    </div>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
