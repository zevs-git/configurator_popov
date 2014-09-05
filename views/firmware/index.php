<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\firmwareSearch $searchModel
 */
$this->title = 'Прошивки';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn {
        padding: 5px 12px;
        font-size: 12px;
    }
    .btn-min {
        padding: 2px 5px;
        font-size: 12px;
        line-height: 1;
        border-radius: 3px;
    }
</style>
</style>
<div class="device-index panel panel-default">
    <div class="panel-heading"  style="height: 48px">
        <div class="col-lg-5 col-sm-5">
            <?=
            Html:: a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i> Добавить прошивку'), ['create'], ['class' => 'btn btn-small btn-success'])
            ?>
        </div>
        <div class="col-lg-3 col-sm-1">
            <?= $this->render('/html/loading-balls.php'); ?>
        </div>
        <div align="right" class="col-lg-4 col-sm-6">
        </div>
    </div>
    <div class="panel-body" style="padding: 0px;">

        <?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
        <?=
        kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'export' => false,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
            'columns' => [
                ['attribute' => 'deviceTypeID',
                    'value' => 'deviceType.name',
                    'filter' => \yii\helpers\ArrayHelper::map(\app\models\DeviceType::find()->asArray()->all(), 'id', 'name'),
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'width' => '150px',
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => '...']
                ],
                ['class' => 'yii\grid\DataColumn', 'attribute' => 'version', 'value' => 'versionval'],
                'description',
                'regDate',
                ['class' => \kartik\grid\BooleanColumn::className(),
                    'attribute' => 'isDefault',
                ],
                ['class' => \kartik\grid\BooleanColumn::className(),
                    'attribute' => 'isRelease',
                ],
                ['class' => \kartik\grid\BooleanColumn::className(),
                    'attribute' => 'isActive',
                ],
                ['class' => \kartik\grid\ActionColumn::className(),
                    'template' => '{update}',
                    'width' => '30px',
                    'header' => '',
                    'viewOptions' => ['class' => 'btn btn-min btn-primary']
                ],
            ],
        ]);
        ?>
        <?php \yii\widgets\Pjax::end(); ?>

    </div>
