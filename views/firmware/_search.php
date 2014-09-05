<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\firmwareSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="firmware-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'isDefault') ?>

    <?= $form->field($model, 'version') ?>

    <?= $form->field($model, 'deviceTypeID') ?>

    <?= $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'regDate') ?>

    <?php // echo $form->field($model, 'isRelease') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
