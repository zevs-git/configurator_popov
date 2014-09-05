<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 */

$this->title = 'Паспорт изделия';
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
        <div class="col-lg-4">
        <?=getImage($model)?>
    </div>
    <div class="col-lg-8">
        <?=getPassView($model)?>
    </div>
    
    <div class="col-lg-12">
        <?=getFormView($passport)?>
    </div>


</div>
<?php 
function getImage() {
        $img = Html::img('/images/autolink3.png',['class'=>'pass-image']);
    
        return Html::panel([
        'heading' => '<span class="glyphicon glyphicon-camera"></span> Изображение',
        'body' => $img
        ], Html::TYPE_INFO
    );
}
function getPassView($model) {
   return DetailView::widget([
            'model' => $model,
            'labelColOptions'=>['style'=>'width: 40%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<span class="glyphicon glyphicon-list-alt"></span> <b>Инофрмация об устройстве # ' . $model->id . "</b>",
                 'type' => Html::TYPE_INFO,
             ],
             'enableEditMode'=>false,
                'attributes' => [
                    'id',
                    'imei',
                    'type.name',
                    'firmware.versionval',
                    'devicePassport.made_date',
                    'devicePassport.sale_date',
                    'distributor.name'
                ],
        ]);
}
function getFormView($passport) {
   return DetailView::widget([
            'model' => $passport,
            'labelColOptions'=>['style'=>'width: 40%'],
            'hAlign'=>  DetailView::ALIGN_LEFT,
            'condensed' => true,
             'hover' => true,
             'mode' => DetailView::MODE_VIEW,
             'panel' => [
                 'heading' => '<b><span class="glyphicon glyphicon-list"></span> Дополнительная информация</b>',
                 'type' => Html::TYPE_INFO,
             ],
            'buttons1'=>'{update}',
            'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
            'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
            'saveOptions'=>['label'=>'<span class="btn-success glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
             'enableEditMode'=>true,
                'attributes' => [
                    ['attribute'=>'sim1', 'type'=>DetailView::INPUT_WIDGET, 'widgetOptions'=>['class'=>  yii\widgets\MaskedInput::className(), 'mask' => '+99999999999?9999']],
                    ['attribute'=>'sim2', 'type'=>DetailView::INPUT_TEXT],
                    'carmodel',
                    'gosnomer',
                    'object',
                    ['attribute'=>'comment', 'type'=>DetailView::INPUT_TEXTAREA],
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
