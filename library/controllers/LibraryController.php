<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
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
}