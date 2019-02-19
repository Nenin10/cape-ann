<?php

namespace app\models;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
]) ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'rank')->dropDownList([
        'user' => 'User',
        'admin' => 'Admin'
    ],
        ['prompt'=>'Select user rank.']
) ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary fixedbtn', 'target' => '_blank']) ?>
    </div>
    <?php ActiveForm::end() ?>