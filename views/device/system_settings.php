<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 */
$this->title = 'Системные настройки';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Устройтва'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['model_id'] = $model->id;
?>
<style>
    .pass-image {
        max-height: 200px;
    }
</style>
<?php if (!empty($is_save)) getAlert() ?>
<div class="device-view">
    <div class="col-lg-12">
        <?= getFormView($set_model) ?>
    </div>
    
</div>
<?php

function getFormView($set_model) {
    return DetailView::widget([
                'model' => $set_model,
                'labelColOptions' => ['style' => 'width: 80%'],
                'hAlign' => DetailView::ALIGN_LEFT,
                'condensed' => true,
                'hover' => true,
                'mode' => DetailView::MODE_VIEW,
                'panel' => [
                    'heading' => '<b><span class="glyphicon glyphicon-list"></span> Системные настройки</b>',
                    'type' => DetailView::TYPE_INFO,
                ],
                'buttons1' => '{update}',
                'updateOptions' => ['label' => '<span class="glyphicon glyphicon-pencil"></span> Редактировать', 'class' => 'btn btn-sm btn-warning'],
                'viewOptions' => ['label' => '<span class="glyphicon glyphicon-minus-sign"></span> Отмена', 'class' => 'btn btn-sm btn-primary'],
                'saveOptions' => ['label' => '<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить', 'class' => 'btn btn-sm btn-success'],
                'attributes' => [
                    ['attribute' => "flag_lat_long", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_lat_long ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_speed", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_speed ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_PVH", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_PVH ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_info_mess", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_info_mess ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_sates", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_sates ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_signal", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_signal ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_LAC_CID", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_LAC_CID ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_power", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_power ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "device_mode_id", 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => ['data' => [1 => 'Мониторинг']], 'value' => 'Мониторинг'],
                    ['attribute' => "flag_settingscheck", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_settingscheck ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "settings_check_time", 'type' => DetailView::INPUT_RANGE,
                        'value' => $set_model->settings_check_time . ' часов',
                        'label' => '<span class="pull-right">Каждые</span>',
                        'widgetOptions' => [
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'width' => '40%',
                            'addon' => ['append' => ['content' => 'часов']]
                        ],
                    ],
                    ['attribute' => "dinamic_volume", 'type' => DetailView::INPUT_RANGE,
                        'value' => $set_model->dinamic_volume,
                        'widgetOptions' => [
                            'html5Options' => ['min' => 0, 'max' => 100, 'step' => 1],
                            'width' => '40%'
                        ],
                    ],
                    ['attribute' => "mic_volume", 'type' => DetailView::INPUT_RANGE,
                        'value' => $set_model->mic_volume,
                        'widgetOptions' => [
                            'html5Options' => ['min' => 0, 'max' => 15, 'step' => 1],
                            'width' => '40%'
                        ],
                    ],
                    ['attribute' => "flag_sensor_filter", 'type' => DetailView::INPUT_SWITCH, 'value' => $set_model->flag_sensor_filter ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "power_save_id", 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => ['data' => [1 => 'Deep Sleep']], 'value' => 'Deep Sleep'],
                    ['attribute' => "power_save_id", 'type' => DetailView::INPUT_SWITCH, 'displayOnly' => true, 'label' => 'Переходить в режим DEEP SLEEP (выключаеться все) при:', 'value' => ''],
                    ['attribute' => "deep_power",
                        'type' => DetailView::INPUT_RANGE,
                        'label' => '<span class="pull-right">Напряжении притания меньше </span>',
                        'value' => $set_model->deep_power . ' мВ',
                        'widgetOptions' => [
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'addon' => ['append' => ['content' => 'мВ']],
                            'width' => '40%'
                        ],
                    ],
                    ['attribute' => "deep_interval",
                        'type' => DetailView::INPUT_RANGE,
                        'label' => '<span class="pull-right">Выходить на связь каждые </span>',
                        'value' => $set_model->deep_interval . ' мин',
                        'widgetOptions' => [
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'addon' => ['append' => ['content' => 'мин']],
                            'width' => '40%'
                        ],
                    ],
                    ['attribute' => "deep_timeout",
                        'type' => DetailView::INPUT_RANGE,
                        'label' => '<span class="pull-right">Время прибывания на связи </span>',
                        'value' => $set_model->deep_timeout . ' мин',
                        'widgetOptions' => [
                            'html5Options' => ['min' => 0, 'max' => 255, 'step' => 1],
                            'addon' => ['append' => ['content' => 'мин']],
                            'width' => '40%'
                        ],
                    ],
                    ['attribute' => "flag_deep_sensor", 'type' => DetailView::INPUT_SWITCH, 'displayOnly' => true, 'label' => 'Выходить из режима сна при:', 'value' => ''],
                    ['attribute' => "flag_deep_sensor", 
                        'type' => DetailView::INPUT_SWITCH, 'label' => '<span class="pull-right">Срабатывание датчика движения</span>', 'value' => $set_model->flag_deep_sensor ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_deep_in_out", 
                        'type' => DetailView::INPUT_SWITCH, 'label' => '<span class="pull-right">При изменении состояния дискретного входа (входов)</span>', 'value' => $set_model->flag_deep_in_out ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
                    ['attribute' => "flag_deep_move", 
                        'type' => DetailView::INPUT_SWITCH, 'label' => '<span class="pull-right">Не переходить в режим сна при движении (по датчику движения)</span>', 'value' => $set_model->flag_deep_move ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>', 'format' => 'raw'],
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
