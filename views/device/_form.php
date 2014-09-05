<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Device $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="col-lg-2">
    <?php
    
    $file =  kartik\widgets\FileInput::widget([
    'name' => 'attachments', 
    'options' => ['multiple' => true], 
    'pluginOptions' => ['previewFileType' => 'any']
    ]);
    
    
    $img_modal =  yii\bootstrap\Modal::widget([
      'header' => '<h2>Hello world</h2>',
      'footer' => $file,
      'toggleButton' => ['label' => 'click me','class'=>"btn  btn-primary"],
        
    ]);
 
    ?>
</div>
<div class="col-lg-5">
    <?php

    use kartik\detail\DetailView;

echo DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => 'Book # ' . $model->id,
            'type' => 'success',
        ],
            /* 'attributes'=>[
              'code',
              'name',
              ['attribute'=>'publish_date', 'type'=>DetailView::INPUT_DATE],
              ] */
    ]);
    ?>
    
</div>

<div class="col-lg-5">
    <?php

echo DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => 'Book # ' . $model->id,
            'type' => 'success',
        ],
            /* 'attributes'=>[
              'code',
              'name',
              ['attribute'=>'publish_date', 'type'=>DetailView::INPUT_DATE],
              ] */
    ]);
    ?>
    
</div>

