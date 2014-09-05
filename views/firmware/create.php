<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\firmware $model
 */

$this->title = 'Добавить прошивку';
$this->params['breadcrumbs'][] = ['label' => 'Firmwares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="firmware-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
