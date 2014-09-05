<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 */

$this->title = 'Настройки SIM карты';
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
        <?=getSIMSettings($set_model1,1)?>
    </div>
    <div class="col-lg-6">
        <?=getSIMSettings($set_model2,2)?>
    </div>
    
</div>
<?php 

function getSIMSettings($set_model,$counter) {
   return DetailView::widget([
            'model' => $set_model,
            'labelColOptions'=>['style'=>'width: 60%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-collapse-up"></span> Настройки SIM карты #'.$counter.'</b>',
                 'type' => ($counter == 1?Html::TYPE_INFO : Html::TYPE_PRIMARY),
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
            'enableEditMode'=>$counter == 1,
                'attributes' => [
                    "APN",
                    "login",
                    "password",
                    "PIN",
                    "USSD",
                    ['attribute'=>"is_rouming" , 
                        'type'=>DetailView::INPUT_SWITCH,
                        'format'=>'raw',
                        'value'=> $set_model->is_rouming ? 
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
