<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\DeviceSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="device-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'imei') ?>

    <?= $form->field($model, 'typeID') ?>

    <?= $form->field($model, 'firmwareID') ?>

    <?= $form->field($model, 'customID') ?>

    <?php // echo $form->field($model, 'object_id') ?>

    <?php // echo $form->field($model, 'distributorID') ?>

    <?php // echo $form->field($model, 'regDate') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <?php // echo $form->field($model, 'firmwareUpdateTime') ?>

    <?php // echo $form->field($model, 'settingsUpdateTime') ?>

    <?php // echo $form->field($model, 'lastContactTime') ?>

    <?php // echo $form->field($model, 'lastContactID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
