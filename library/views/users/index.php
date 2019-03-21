<?php

namespace app\widgets;

use Yii;
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\GridView;

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
        <div class="icon">
            <a href="profile"><span class="glyphicon glyphicon-credit-card"></span></a><br>
            <p>PROFILE</p>
        </div>
        <?php if($session['user_rank'] === 'admin'){ ?>
            <div class="icon" id="active">
                <a href="index"><span class="glyphicon glyphicon-user"></span></a><br>
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
<div id="main-part">
    <div class="container-fluid" id="grid-table">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-condensed'],
            'columns' => [
                'rank',
                'username',
                'password',
                'email',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Options',
                    'template' => ' {update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            if($_SESSION['user_rank'] === 'admin')
                                return  Html::a('<span class="glyphicon glyphicon-edit"></span>', $url) ;
                        },
                        'delete' => function ($url, $model) {
                            if($_SESSION['user_rank'] === 'admin')
                                return  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url) ;
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if($action === 'update')
                        {
                            return  Url::to('update?id=' .$key);
                        }
                        else if($action === 'delete')
                        {
                            return  Url::to('delete?id=' .$key);
                        }
                    }
                ],
            ],
]);
        ?>

    </div>
    <div class="icon" id="add">
        <a href="adduser"><span class="glyphicon glyphicon-plus"></span></a><br>
        <p>Add User</p>
    </div>
</div>

