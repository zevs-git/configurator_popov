<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\firmware $model
 */

$this->title = 'Редактировать настройки прошивки';
$this->params['breadcrumbs'][] = ['label' => 'Прошивки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="firmware-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
