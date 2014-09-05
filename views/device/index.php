<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ViewDevicesSerach $searchModel
 */
$this->title = Yii::t('app', 'Устройства');
//$this->params['breadcrumbs'][] = $this->title;
//$ii = new yii\web\View();
?>
<div class="device-index panel panel-default">
    <div class="panel-heading"  style="height: 48px">
        <div class="col-lg-5 col-sm-5">
            <?=
            \yii\bootstrap\Tabs::widget([
                'items' => [
                    ['label' => 'Все устройтва',
                        'content' => '',
                        'active' => true,
                        'options' => ['id' => 'all_label']],
                    ['label' => 'В обработке',
                        'options' => ['id' => 'favirite_label'],
                        'content' => '']
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-3 col-sm-1">
            <?= $this->render('/html/loading-balls.php'); ?>
        </div>
        <div align="right" class="col-lg-4 col-sm-6">
            <?=
             Html:: a(Yii::t('app', '<i class="glyphicon glyphicon-save"></i> Прошивка'), ['#'], ['class' => 'btn btn-small btn-success']) .
             Html::a(Yii::t('app', '<i class="glyphicon glyphicon-cog"></i> Конфигурация'), ['#'], ['class' => 'btn btn-mini btn-warning']) .
             Html::a(Yii::t('app', '<i class="glyphicon glyphicon-retweet"></i> Организация'), ['#'], ['class' => 'btn btn-info']);
             //Html::a(Yii::t('app', '<i class="glyphicon glyphicon-cog"></i>'), ['#'], ['class' => 'btn btn-info', 'data-toggle' => "modal", 'data-target' => "#cVisible"])
             ?>
        </div>
    </div>
    <div class="panel-body" style="padding: 0px;">
        <style>
            .btn {
                padding: 5px 12px;
                font-size: 12px;
            }
            .form-control, .input-group .date, .select2-container .select2-choice {
                height: 30px;
                padding: 3px;
            }
            .select2-container.form-control {
                height: 30px;
            }
            .table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
                padding: 4px;
            }
            .sortable.connected {
                padding-left: 10px !important;
            }
            #favirie-grid {
                display: none;
            }
            .btn-min {
                padding: 2px 5px;
                font-size: 12px;
                line-height: 1;
                border-radius: 3px;
            }
        </style>
        <?/*==========Главная таблица==========*/?>
        <div id="main-grid">
            <?php \yii\widgets\Pjax::begin(['timeout' => 5000, 'id' => 'device_grid_p']); ?>
            <?=
            DynaGrid::widget([
                'columns' 		=> $searchModel->getGridViewColumns(),
                'storage' 		=> DynaGrid::TYPE_COOKIE,
                'theme' 		=> 'panel-primary',
				'options'=>['id'=>'devices-gri'],
                'gridOptions' 	=> [
                    'id'                => 'devices-grid',
                    'dataProvider'      => $dataProvider,
                    'filterModel'       => $searchModel,
                    'class'             => 'table table-striped table-bordered table-hover min-heigth',
                    'tableOptions'      => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                    'headerRowOptions'  => ['class' => 'breadcrumb'],
                    'summary'           => false,
                    'export'            => false,
                    'panel' => [
                        //'heading' => false,
                        'type' => GridView::TYPE_PRIMARY,
                        'after'         => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сброс ', ['index'], ['class' => 'btn btn-info', 'id' => 'reload-grid']),
                        'showFooter'    => TRUE,
                        'showHeader'    => TRUE,
                        'layout'        =>GridView::TEMPLATE_2
                    ],
                ]
            ]);
            ?>    
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
        <?/*-------------Главная таблица---------------*/?>
        
        <div id="favirie-grid">
            <?php \yii\widgets\Pjax::begin(['timeout' => 5000, 'id' => 'device_grid_2']); ?>
            <?=
            GridView::widget([
                'dataProvider' => $favoriteDivices,
                'id' => 'fav-grid',
                'class' => 'table table-striped table-bordered table-hover min-heigth main-grid',
                'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                'headerRowOptions' => ['class' => 'breadcrumb'],
                //'responsive'=>true,
                'summary' => false,
                'columns' => $searchModel->getGridViewColumnsWS(false),
                'panel' => [
                    'heading' => false,
                    'type' => GridView::TYPE_PRIMARY,
                    //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                    'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сброс ', ['index'], ['class' => 'btn btn-info', 'id' => 'reload-fav-grid']),
                    'showFooter' => false,
                    'showHeader' => false
                ],
            ]);
            ?> 
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
        
    </div>
</div>

<?php

function getSortItems($gridColumns, $visible) {
    $res = [];
    $labels = app\models\ViewDevices::attributeLabels();
    foreach ($gridColumns as $col) {
        if (!empty($col['attribute'])) {
            $label = !empty($labels[$col['attribute']]) ? $labels[$col['attribute']] : $col['attribute'];
            $res[] = ['content' => $label, 'options' => ['id' => $col['attribute']]];
        }
    }
    return $res;
}

$this->registerJs("
        initCheckboxes();
        
        $(document).on('pjax:complete', function(event) {
            initCheckboxes();
        });
        
        $('a[href=\"#favirite_label\"]').click(ShowFavGrid);
        $('a[href=\"#all_label\"]').click(ShowMainGrid);
        ");
?>
<script>
    function addDeviceToFavorite(id) {
        $.ajax('<?= \yii\helpers\Url::toRoute('device/addfavorite') ?>/' + id)
                .done(function(data) {
                    var cont = $('#device_favorite_count');
                    $('a[href="#favirite_label"]').html('В обработке <span id=device_favorite_count class="badge btn-success">' + data + '</span>');
                });
    }
    function removeDeviceFromFavorite(id) {
        $.ajax('<?= \yii\helpers\Url::toRoute('device/removefavorite') ?>/' + id)
                .done(function(data) {
                    $('a[href="#favirite_label"]').html('В обработке <span id=device_favorite_count class="badge btn-success">' + data + '</span>');
                });
    }

    function initCheckboxes() {
        $.ajax('<?= \yii\helpers\Url::toRoute('device/getfavoritecount') ?>')
                .done(function(data) {
                    $('a[href="#favirite_label"]').html('В обработке <span id=device_favorite_count class="badge btn-success">' + data + '</span>');
                });


        $('.dev_select').change(function() {
            var tr = $('#devices-grid tr[data-key=' + this.value + ']');
            if (tr) {
                if (this.checked)
                    tr.addClass('info');
                else
                    tr.removeClass('info');
            }
            if (this.checked)
                addDeviceToFavorite(this.value);
            else
                removeDeviceFromFavorite(this.value);
        });
        $('.d_select_all').change(function() {
            var checked = this.checked;
            $('#devices-grid input[name=d_select]').each(function() {
                this.checked = checked;
                $(this).trigger('change');
            });
        });
    }
    function ShowMainGrid() {
        $('#favirie-grid').hide();
        $('#main-grid').show();
        $('#reload-grid').trigger('click');
    }
    function ShowFavGrid() {
        $('#main-grid').hide();
        $('#favirie-grid').show();
        $('#reload-fav-grid').trigger('click');
    }
</script>
