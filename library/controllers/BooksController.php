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

class BooksController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

     public function actionAddbook()
    {
        $this->layout = 'form';

        $model = new Book;

        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('index'));
        }
        return $this->render('forms/addBook', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $this->layout = 'form';

        $model = Book::findOne($id);

        if ($model -> load(Yii::$app->request->post()) && $model -> validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('index'));
        }
        return $this->render('forms/addBook', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Book::findOne($id);
        $model -> delete();
        return Yii::$app->response->redirect(Url::to('index'));
    }
}