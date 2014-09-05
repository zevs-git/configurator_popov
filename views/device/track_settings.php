<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 */

$this->title = 'Параметры трека';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Устройтва'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['model_id'] = $model->id;
?>
<style>
    .pass-image {
        max-height: 200px;
    }
</style>
<?php if (!empty($is_save)) getAlert()?>
<div class="device-view">
    <div class="col-lg-6">
        <?=getFormIntervals($set_model)?>
    </div>
    <div class="col-lg-6">
        <?=getFormFlags($set_model)?>
    </div>
    
    <div class="col-lg-6">
        <?=getFormTrack($set_model)?>
    </div>
    <div class="col-lg-6">
        <?=getFormFlagsAddit($set_model)?>
    </div>
    
</div>
<?php 

function getFormIntervals($set_model) {
   return DetailView::widget([
            'model' => $set_model,
            'labelColOptions'=>['style'=>'width: 60%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-time"></span> Интервал передачи сообщений</b>',
                 'type' => Html::TYPE_INFO,
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
                'attributes' => [
                    ['attribute'=>"interval_stop" , 
                        'type'=>DetailView::INPUT_WIDGET,
                        'value'=> $set_model->interval_stop ? $set_model->interval_stop . " сек":NULL,
                        'widgetOptions' => [
                            'class'=>'\kartik\widgets\RangeInput',
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'width' => '50%',
                            'addon' => ['append' => ['content' => 'сек']],
                         ]   
                    ],
                    ['attribute'=>"interval_packets" , 
                        'type'=>DetailView::INPUT_WIDGET,
                        'value'=> $set_model->interval_packets ? $set_model->interval_packets . " сек":NULL,
                        'widgetOptions' => [
                            'class'=>'\kartik\widgets\RangeInput',
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'width' => '50%',
                            'addon' => ['append' => ['content' => 'сек']],
                         ]   
                    ],
                ],
        ]);
}
function getFormTrack($set_model) {
   return DetailView::widget([
            'model' => $set_model,
            'labelColOptions'=>['style'=>'width: 60%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-resize-full"></span> Отработка траектории движения</b>',
                 'type' => Html::TYPE_INFO,
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
                'attributes' => [
                    ['attribute'=>"curs" , 
                        'type'=>DetailView::INPUT_WIDGET,
                        'value'=> $set_model->curs ? $set_model->curs . " градусов":NULL,
                        'widgetOptions' => [
                            'class'=>'\kartik\widgets\RangeInput',
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'width' => '50%',
                            'addon' => ['append' => ['content' => '&deg;']],
                         ]   
                    ],
                    ['attribute'=>"speed" , 
                        'type'=>DetailView::INPUT_WIDGET,
                        'value'=> $set_model->speed ? $set_model->speed . " км/ч":NULL,
                        'widgetOptions' => [
                            'class'=>'\kartik\widgets\RangeInput',
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'width' => '50%',
                            'addon' => ['append' => ['content' => 'км/ч']],
                         ]   
                    ],
                ],
        ]);
}
function getFormFlags($set_model) {
   return DetailView::widget([
            'model' => $set_model,
            'labelColOptions'=>['style'=>'width: 60%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-ok-circle"></span> При стоянке фиксировать координаты</b>',
                 'type' => Html::TYPE_INFO,
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
                'attributes' => [
                    ['attribute'=>"flag_min_speed" , 
                        'type'=>DetailView::INPUT_SWITCH,
                        'format'=>'raw',
                        'value'=> $set_model->flag_min_speed ? 
                            '<span class="label label-success">Да</span>' : 
                            '<span class="label label-danger">Нет</span>',
                    ],
                    ['attribute'=>"flag_move" , 
                        'type'=>DetailView::INPUT_SWITCH,
                        'format'=>'raw',
                        'value'=> $set_model->flag_move ? 
                            '<span class="label label-success">Да</span>' : 
                            '<span class="label label-danger">Нет</span>',
                    ],
                    ['attribute'=>"flag_start" , 
                        'type'=>DetailView::INPUT_SWITCH,
                        'format'=>'raw',
                        'value'=> $set_model->flag_start ? 
                            '<span class="label label-success">Да</span>' : 
                            '<span class="label label-danger">Нет</span>',
                    ],
                ],
        ]);
}
function getFormFlagsAddit($set_model) {
   return DetailView::widget([
            'model' => $set_model,
            'labelColOptions'=>['style'=>'width: 60%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-ok-circle"></span> Дополнительно</b>',
                 'type' => Html::TYPE_INFO,
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
                'attributes' => [
                    ['attribute'=>"flag_nav_time" , 
                        'type'=>DetailView::INPUT_SWITCH,
                        'format'=>'raw',
                        'value'=> $set_model->flag_nav_time ? 
                            '<span class="label label-success">Да</span>' : 
                            '<span class="label label-danger">Нет</span>',
                    ]
                ],
        ]);
}
function getAlert($type = 'success') {
    return \kartik\widgets\Growl::widget([
    'type' => $type,
    'title' => 'Данные успешно сохранены!',
    'icon' => 'glyphicon glyphicon-ok-sign',
    'showSeparator' => true,
    'delay' => 0,
    'pluginOptions' => [
        'position' => [
            'from' => 'top',
            'align' => 'right',
        ]
    ]
]);
}
?>
