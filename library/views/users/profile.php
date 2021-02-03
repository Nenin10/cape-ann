<?php

use yii\bootstrap\GridView;
use yii\bootstrap\Html;
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
                        <img class="img-circle" alt="" src="http://placehold.it/300x300">
                    </figure>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <ul class="list-group">
                        <li class="list-group-item edit-link"> </li>
                        <li class="list-group-item"> <?php echo $user['username']; ?> <span class="badge">Username</span> </li>
                        <li class="list-group-item"> •••••••• <span class="badge">Password</span> </li>
                        <li class="list-group-item"> <?php echo $user['email']; ?> <span class="badge">E-mail</span> </li>
                        <li class="list-group-item edit-link"> <a href="editgeneral">Edit</a> </li>
                        <li class="list-group-item"> <?php echo $profile['name']; ?> <span class="badge">Full Name</span> </li>
                        <li class="list-group-item"> <?php echo $profile['birth_date']; ?> <span class="badge">Birth Date</span> </li>
                        <li class="list-group-item edit-link"> <a href="editinfo">Edit</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bs-callout bs-callout-primary">
        <h3> Favorites </h3>
        <h5> Favorite Authors: <a href="favauthor">Add</a> </h5>
        <div class="container-fluid" id="grid-table">
            <?=
            GridView::widget([
                'dataProvider' => $authors,
                'tableOptions' => ['class' => 'table table-condensed'],
                'columns' => [
                    'author',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Options',
                        'template' => ' {update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                    return  Html::a('<span class="glyphicon glyphicon-edit"></span>', $url) ;
                            },
                            'delete' => function ($url, $model) {
                                    return  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url) ;
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if($action === 'update')
                            {
                                return  Url::to('update?id=' .$key. '&gridid=2');
                            }
                            else if($action === 'delete')
                            {
                                return  Url::to('delete?id=' .$key. '&gridid=2');
                            }
                        }
                    ],
                ],
            ]);
            ?>

        </div>
        <h5> Favorite Books: <a href="favbook">Add</a> </h5>
        <div class="container-fluid" id="grid-table">
            <?=
            GridView::widget([
                'dataProvider' => $books,
                'tableOptions' => ['class' => 'table table-condensed'],
                'columns' => [
                    [
                        'label' => 'Title',
                        'value' => 'book.title',
                    ],
                    [
                        'label' => 'Author',
                        'value' => 'book.author',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Options',
                        'template' => ' {update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return  Html::a('<span class="glyphicon glyphicon-edit"></span>', $url) ;
                            },
                            'delete' => function ($url, $model) {
                                return  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url) ;
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if($action === 'update')
                            {
                                return  Url::to('update?id=' .$key. '&gridid=3');
                            }
                            else if($action === 'delete')
                            {
                                return  Url::to('delete?id=' .$key. '&gridid=3');
                            }
                        }
                    ],
                ],
            ]);
            ?>

        </div>
    </div>
</div>
</div>


