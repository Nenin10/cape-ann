<?php

namespace app\models;

use Yii;
use yii\helpers\url;

?>
<?php
    $session = Yii::$app->session;
    if(!isset($session['user_id']))
    {
        return Yii::$app->response->redirect(Url::to('index'));
    }

    if($session['user_rank'] === 'admin')
    {
        echo "You are logged in as admin";
    } else
        echo "You are logged in as regular user";
?>