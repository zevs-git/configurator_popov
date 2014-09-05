<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\configuration $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Configuration',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configurations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
