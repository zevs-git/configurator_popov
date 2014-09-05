<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\configuration $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="configuration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'deviceTypeID')->textInput() ?>

    <?= $form->field($model, 'regDate')->textInput() ?>

    <?= $form->field($model, 'json')->textInput() ?>

    <?= $form->field($model, 'isActive')->textInput() ?>

    <?= $form->field($model, 'isDefault')->textInput() ?>

    <?= $form->field($model, 'distributorID')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'isDelete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
