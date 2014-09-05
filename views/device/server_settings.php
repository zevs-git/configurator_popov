<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 */

$this->title = 'Настройки сервера';
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
        <?=getFormView($set_model,1)?>
    </div>
    <div class="col-lg-6">
        <?=getFormView($set_model,2)?>
    </div>
</div>
<?php 

function getFormView($set_model,$serv_id) {
   return DetailView::widget([
            'model' => $set_model,
            'labelColOptions'=>['style'=>'width: 40%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-list"></span> Сервер мониторинга ' . $serv_id .'</b>',
                 'type' => ($serv_id == 1?Html::TYPE_INFO : Html::TYPE_PRIMARY),
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
             'enableEditMode'=>$serv_id == 1,
                'attributes' => [
                    ['attribute'=>"dns_ip$serv_id" , 'type'=>DetailView::INPUT_TEXT],
                    ['attribute'=>"port$serv_id", 'type'=>DetailView::INPUT_SPIN],
                    ['attribute'=>"protocol_id$serv_id", 'type'=>DetailView::INPUT_SELECT2,'widgetOptions'=>['data'=>[1=>'Протокол1',2=>'Протокол2']]],
                   "login$serv_id",
                   "password$serv_id"
                ],
        ]);
}
function getAlert($type = 'success') {
    return \kartik\widgets\Growl::widget([
    'type' => $type,
    'title' => 'Данные успешно сохранены!',
    'icon' => 'glyphicon glyphicon-ok-sign',
    //'body' => 'Данные успешно сохранены',
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
