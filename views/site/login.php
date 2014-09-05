<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Форма входа';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .site-login {
        background-image: url("/images/logo_big.png");
        background-repeat: no-repeat;
        background-position: 90%;
        padding: 30px;
        //color: black;
    }
    .login-panel {
        background: rgba(255,112,15,1);
        background: -moz-linear-gradient(left, rgba(255,112,15,1) 0%, rgba(250,222,203,1) 55%, rgba(255,255,255,1) 67%, rgba(255,255,255,1) 100%);
        background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,112,15,1)), color-stop(55%, rgba(250,222,203,1)), color-stop(67%, rgba(255,255,255,1)), color-stop(100%, rgba(255,255,255,1)));
        background: -webkit-linear-gradient(left, rgba(255,112,15,1) 0%, rgba(250,222,203,1) 55%, rgba(255,255,255,1) 67%, rgba(255,255,255,1) 100%);
        background: -o-linear-gradient(left, rgba(255,112,15,1) 0%, rgba(250,222,203,1) 55%, rgba(255,255,255,1) 67%, rgba(255,255,255,1));
    }
    .form-control {
        max-width: 300px;
    }
    .login-in {
        max-width: 600px;
        padding-left: 50px;
    }
    .login-in .btn-enter {
        height: 90px;
        float: right;
        margin-top: -4px;
        margin-right: 80px;
    }
    .login-in .form-control {
        height: 35px;
    }
</style>
<div class="device-index panel panel-default login-panel">
    <div class="site-login">
        <div class="device-index panel panel-default  login-in">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Введите Ваши учетные данные для входа:</p>

            <?php
            $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-horizonal'],
                            /* 'fieldConfig' => [
                              'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                              'labelOptions' => ['class' => 'col-lg-1 control-label'],
                              ], */
            ]);
            
            ?>
            <?= Html::submitButton(' Войти', ['class' => 'btn btn-warning btn-lg icon-next glyphicon glyphicon-chevron-right btn-enter','name' => 'login-button']) ?>
            <?=
            $form->field($model, 'username', 
                ['inputOptions' =>
                    ['placeholder' => $model->getAttributeLabel('username'),
                    'class' => 'form-control'],
            ])->label(false);
            ?>

            <?= $form->field($model, 'password',
                     ['inputOptions' =>
                    ['placeholder' => $model->getAttributeLabel('password'),
                    'class' => 'form-control'],
                    ])->passwordInput()->label(false) ?>

            <?=
            $form->field($model, 'rememberMe', [
                //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox()
            ?>

<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
