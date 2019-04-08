<?php

namespace app\models;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<body id="loginform">
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" method="post">
                        <h3 class="text-center text-dark">Login Info</h3>
                        <div class="form-group">
                            <?php
                            $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'options' => ['class' => 'form-horizontal'],
                            ])
                            ?>

                            <?= $form->field($model, 'email') ?>
                            <?= $form->field($model, 'username') ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= Html::submitButton('Submit', ['class' => 'btn btn-default btn-md']) ?>

                            <?php ActiveForm::end() ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>