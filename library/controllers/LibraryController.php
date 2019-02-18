<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;
use app\models\Book;

class LibraryController extends Controller
{
    //Using Yii Documentation for first example
    //just to make sure Controller is working
    //with Model and View.
    public function actionIndex()
    {
        $query = Book::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $books = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'books' => $books,
            'pagination' => $pagination,
        ]);
    }
    public function actionBookform()
    {
        $model = new Book;

        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('index'));
        }
        return $this->render('forms/bookform', ['model' => $model]);
    }
}