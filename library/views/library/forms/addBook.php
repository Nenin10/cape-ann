<?php

namespace app\models;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
    <?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
    ]) ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'author') ?>
    <?= $form->field($model, 'year') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary fixedbtn', 'target' => '_blank']) ?>
    </div>
    <?php ActiveForm::end() ?>
