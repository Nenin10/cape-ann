<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Book;
use app\models\Profile;
use app\models\Profile2Book;
use app\models\ProfileAuthor;
use app\models\User;

class MainController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHome()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find(),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        $dataProvider1 = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);
        return $this->render('home', ['dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1]);
    }
}