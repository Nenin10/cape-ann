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
        <div class="icon">
            <a href="../main/home"><span class="glyphicon glyphicon-th-list"></span></a><br>
            <p>LIBRARY</p>
        </div>
        <div class="icon" id="active">
            <a href="profile"><span class="text-danger glyphicon glyphicon-credit-card"></span></a><br>
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
            <a href="logout"><span class="glyphicon glyphicon-log-out"></span></a><br>
            <p>LOGOUT</p>
        </div>
    </div>
</div>

<div class="container">
<div class="panel panel-default">
    <div class="panel-heading resume-heading">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-xs-12 col-sm-4">
                    <figure>
                        <img class="img-circle img-responsive" alt="" src="http://placehold.it/300x300">
                    </figure>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <ul class="list-group">
                        <li class="list-group-item">Username: <?php echo $session['user_id']; ?></li>
                        <li class="list-group-item">Password: <?php echo $session['user_password']; ?></li>
                        <li class="list-group-item">E-mail: <?php echo $session['user_email']; ?></li>
                    </ul>
                    <h4 class="info-head">More Info</h4>
                    <ul class="list-group">
                        <li class="list-group-item">Full Name: <?php echo $session['user_name']; ?></li>
                        <li class="list-group-item">Birth Date: <?php echo $session['user_birth']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bs-callout bs-callout-primary">
        <h4>Favorites</h4>
        <p>
            Fav Author
        </p>
        <p>
            Fav Books
        </p>
    </div>
</div>
</div>


