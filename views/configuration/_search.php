<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\configurationSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="configuration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'deviceTypeID') ?>

    <?= $form->field($model, 'isActive') ?>

    <?php // echo $form->field($model, 'regDate') ?>

    <?php // echo $form->field($model, 'json') ?>

    <?php // echo $form->field($model, 'isDefault') ?>

    <?php // echo $form->field($model, 'distributorID') ?>

    <?php // echo $form->field($model, 'isDelete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
