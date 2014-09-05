<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\firmware $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<style>
    .kv-form-attribute {
        max-width: 500px;
    }
    .input-group-html5 input[type="color"], .input-group-html5 input[type="range"] {
        height: 12px !important;
    }
</style>
<?=DetailView::widget([
    'model' => $model,
    'condensed' => true,
    'hover' => true,
    'panel' => [
        'heading' => '<b><span class="glyphicon glyphicon-list"></span> ' . $this->title . '</b>',
        'type' => (kartik\helpers\Html::TYPE_PRIMARY),
    ],
    'mode' => $model->isNewRecord?DetailView::MODE_EDIT:DetailView::MODE_VIEW,
    'buttons1'=>'{update}',
    'updateOptions'=>['label'=>'<span class="glyphicon glyphicon-pencil"></span> Редактировать','class'=>'btn btn-sm btn-warning'],
    'viewOptions'=>['label'=>'<span class="glyphicon glyphicon-minus-sign"></span> Отмена','class'=>'btn btn-sm btn-primary'],
    'saveOptions'=>['label'=>'<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить','class'=>'btn btn-sm btn-success'],
    'attributes' => [
        ['attribute' => "deviceTypeID", 
            'type' => DetailView::INPUT_SELECT2, 
            'widgetOptions' => ['data' => \yii\helpers\ArrayHelper::map(\app\models\DeviceType::find()->asArray()->all(), 'id', 'name')],
            'value' => $model->deviceType->name],
        ['type' => DetailView::INPUT_SPIN ,
            'attribute' => 'version', 
            'value' => 'versionval',
            'pluginOptions' => [
                'min'=> 0,
                'max'=> 100,
                'step'=> 0.1,
                'decimals'=> 2,
                'boostat'=> 5,
                'maxboostedstep'=> 10,
        ]],
        'description',
        ['type' => DetailView::INPUT_SWITCH, 'attribute' =>'isDefault',
            'value' => $model->isDefault ? '<span class="label label-success">Да</span>' : 
            '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
        ['type' => DetailView::INPUT_SWITCH, 'attribute' =>'isRelease',
            'value' => $model->isRelease ? '<span class="label label-success">Да</span>' : 
            '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
        ['type' => DetailView::INPUT_SWITCH, 
            'attribute' =>'isActive',
            'value' => $model->isActive ? '<span class="label label-success">Да</span>' : 
            '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
        ['type' => DetailView::INPUT_TEXT, 'attribute' =>'regDate','visible'=>false],
        ['type' => DetailView::INPUT_FILEINPUT, 
            'attribute' =>'dataFile','visible'=>$model->isNewRecord],
    ]
]);?>
