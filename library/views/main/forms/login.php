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
                            <h3 class="text-center text-dark">Login</h3>
                            <div class="form-group">
                                <?php
                                $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'options' => ['class' => 'form-horizontal'],
                                ])
                                ?>
                                <div class="text-danger">
                                    <?= $form->errorSummary($model, ['header' => 'ERROR:']); ?>
                                </div>

                                <?= $form->field($model, 'username') ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>

                                <?= Html::submitButton('Login', ['class' => 'btn btn-default btn-md']) ?>
                                <a href="register" class="btn text-dark">Register</a>

                                <?php ActiveForm::end() ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>