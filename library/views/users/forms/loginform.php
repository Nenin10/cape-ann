<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ])
?>

<?= $form->errorSummary($model, ['header' => 'ERROR:']); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary fixedbtn']) ?>
    </div>
<?php ActiveForm::end() ?>