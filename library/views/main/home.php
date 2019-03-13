<?php

namespace app\models;

use Yii;
use yii\helpers\url;

?>
<?php
    $session = Yii::$app->session;
    if(!isset($session['user_id']))
    {
        return Yii::$app->response->redirect(Url::to('../main'));
    }
?>

<div id="nav-menu">
    <div class="container">
        <div class="icon" id="active">
            <a href="home"><span class="glyphicon glyphicon-th-list"></span></a><br>
            <p>LIBRARY</p>
        </div>
        <div class="icon">
            <a href="../users/profile"><span class="text-danger glyphicon glyphicon-credit-card"></span></a><br>
            <p>PROFILE</p>
        </div>
        <?php if($session['user_rank'] === 'admin'){ ?>
            <div class="icon">
                <a href="../users/index"><span class="glyphicon glyphicon-user"></span></a><br>
                <p>USERS</p>
            </div>
            <div class="icon">
                <a href="../books/index"><span class="glyphicon glyphicon-book"></span></a><br>
                <p>BOOKS</p>
            </div>
        <?php } ?>
        <div class="icon">
            <a href="../users/logout"><span class="glyphicon glyphicon-log-out"></span></a><br>
            <p>LOGOUT</p>
        </div>
    </div>
</div>
<div id="main-part">
    <h1> LIBRARY HOME! </h1>
</div>

