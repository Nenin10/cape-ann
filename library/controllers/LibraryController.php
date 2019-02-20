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

class LibraryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new User;
        $model->scenario = 'login';
        $profile = new Profile;
        if ($model -> load(\Yii::$app->request->post()) && $model -> validate())
        {
            $POST_VAR = Yii::$app->request->post('User');
            $username = $POST_VAR['username'];
            $password = $POST_VAR['password'];
            $user = $model->GetUser($username);
            if(!is_null($user))
            {
                if($user->validatePassword($password))
                {
                    $session = Yii::$app->session;
                    $session->set('id', $user->id);
                    $session->set('user_id', $user->username);
                    $session->set('user_rank', $user->rank);

                    $userProfile = $profile->GetProfile($session['id']);
                    if(!is_null($userProfile)) {
                        $session->set('user_profile', $userProfile->id);
                        return Yii::$app->response->redirect(Url::to('home'));
                    }
                    $model->addError('ERROR', "This user's profile doesn't exist.");
                }
                else
                {
                    $model->addError('ERROR', 'Wrong password inserted.');
                }
            }
            else
            {
                $model->addError('ERROR', 'Wrong username inserted.');
            }
        }
        return $this->render('forms/loginform', ['model' => $model]);
    }

    public function actionRegister()
    {
        $model = new User;
        $model->rank = 'user';
        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();

            $POST_VAR = Yii::$app->request->post('User');
            $username = $POST_VAR['username'];
            $user = $model->GetUser($username);
            if(!is_null($user))
            {
                $session = Yii::$app->session;
                $userID = $user->id;
                $profile = new Profile();
                $profile->user_id = $userID;
                $profile->name = 'Full Name';
                $profile->description = 'Summary - Description - etc.';
                $profile->birth_date = '0000-00-00';
                $profile->image = 'image';

                if ($profile->validate()) {
                    $profile->save();
                    return Yii::$app->response->redirect(Url::to('index'));
                }
            }
        }
        return $this->render('forms/registerform', ['model' => $model]);
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

    public function actionAdduser()
    {
        $model = new User;

        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();

            $POST_VAR = Yii::$app->request->post('User');
            $username = $POST_VAR['username'];
            $user = $model->GetUser($username);
            if(!is_null($user))
            {
                $session = Yii::$app->session;
                $userID = $user->id;
                $profile = new Profile();
                $profile->user_id = $userID;
                $profile->name = 'Full Name';
                $profile->description = 'Summary - Description - etc.';
                $profile->birth_date = '0000-00-00';
                $profile->image = 'image';

                if ($profile->validate()) {
                    $profile->save();
                    return Yii::$app->response->redirect(Url::to('index'));
                }
            }
        }
        return $this->render('forms/addUser', ['model' => $model]);
    }

    public function actionAddbook()
    {
        $model = new Book;

        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('index'));
        }
        return $this->render('forms/addBook', ['model' => $model]);
    }
}