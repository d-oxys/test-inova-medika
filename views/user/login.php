<?php
/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Please fill out the following fields to login:</p>

<div class="form">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'enableClientValidation' => true,
    ]); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>

    <div class="row buttons">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <p>Belum punya akun? <?= Html::a('Daftar di sini', ['user/register']) ?></p>
</div><!-- form -->
