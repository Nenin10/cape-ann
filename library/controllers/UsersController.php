<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Profile;
use app\models\Profile2Book;
use app\models\ProfileAuthor;
use app\models\User;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionProfile()
    {
        $session = Yii::$app->session;
        $id = $session['id'];
        $user = User::findOne($id);

        $profileID = $session['profile_id'];
        $profile = Profile::findOne($profileID);

        $authors = new ActiveDataProvider([
            'query' => ProfileAuthor::find()->where(['profile_id' => $profileID])
        ]);

        $books = new ActiveDataProvider([
            'query' => Profile2Book::find()->where(['profile_id' => $profileID])
        ]);

        return $this->render('profile', ['user' => $user, 'profile' => $profile, 'authors' => $authors, 'books' => $books]);
    }

    public function actionAdduser()
    {
        $this->layout = 'form';

        $model = new User;

        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();

            $POST_VAR = Yii::$app->request->post('User');
            $username = $POST_VAR['username'];
            $user = $model->GetUser($username);
            if(!is_null($user))
            {
                $userID = $user->id;
                $profile = new Profile();
                $profile->user_id = $userID;
                $profile->name = NULL;
                $profile->birth_date = NULL;
                $profile->image = NULL;

                if ($profile->validate()) {
                    $profile->save();
                    return Yii::$app->response->redirect(Url::to('../main/home'));
                }
            }
        }
        return $this->render('forms/addUser', ['model' => $model]);
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session['id'] = NULL;
        $session['user_id'] = NULL;
        $session['user_rank'] = NULL;
        $session['user_profile'] = NULL;
        $session['user_email'] = NULL;
        $session['user_password'] = NULL;
        $session['user_name'] = NULL;
        $session['user_birth'] = NULL;
        $session['user_image'] = NULL;

        return Yii::$app->response->redirect(Url::to('../main'));
    }

    public function actionUpdate($id,$gridid)
    {
        $this->layout = 'form';

        if($gridid == 1){
            $model = User::findOne($id);
            if ($model -> load(Yii::$app->request->post()) && $model -> validate())
            {
                $model -> save();
                return Yii::$app->response->redirect(Url::to('index'));
            }
            return $this->render('forms/addUser', ['model' => $model]);
        }
        else if($gridid == 2){
            $model = ProfileAuthor::findOne($id);
            if ($model -> load(Yii::$app->request->post()) && $model -> validate())
            {
                $model -> save();
                return Yii::$app->response->redirect(Url::to('profile'));
            }
            return $this->render('forms/favAuthor', ['model' => $model]);
        }
        else if($gridid == 3){
            $model = Profile2Book::findOne($id);
            if ($model -> load(Yii::$app->request->post()) && $model -> validate())
            {
                $model -> save();
                return Yii::$app->response->redirect(Url::to('profile'));
            }
            return $this->render('forms/favBook', ['model' => $model]);
        }
    }

    public function actionEditgeneral()
    {
        $this->layout = 'form';

        $session = Yii::$app->session;
        $id = $session['id'];
        $model = User::findOne($id);
        if ($model -> load(Yii::$app->request->post()) && $model -> validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('profile'));
        }
        return $this->render('forms/editGeneral', ['model' => $model]);
    }
    public function actionEditinfo()
    {
        $this->layout = 'form';

        $session = Yii::$app->session;
        $id = $session['profile_id'];
        $model = Profile::findOne($id);
        if ($model -> load(Yii::$app->request->post()) && $model -> validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('profile'));
        }
        return $this->render('forms/editInfo', ['model' => $model]);
    }

    public function actionFavauthor()
    {
        $this->layout = 'form';

        $model = new ProfileAuthor;
        $session = Yii::$app->session;
        $model->profile_id = $session['profile_id'];
        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('profile'));
        }
        return $this->render('forms/favAuthor', ['model' => $model]);
    }
    public function actionFavbook()
    {
        $this->layout = 'form';

        $model = new Profile2Book;
        $session = Yii::$app->session;
        $model->profile_id = $session['profile_id'];
        if ($model -> load(Yii::$app->request->post()) && $model->validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('profile'));
        }
        return $this->render('forms/favBook', ['model' => $model]);
    }

    public function actionDelete($id,$gridid)
    {
        if($gridid == 1)
        {
            $model = User::findOne($id);
            $model -> delete();
            return Yii::$app->response->redirect(Url::to('index'));
        }
        else if($gridid == 2)
        {
            $model = ProfileAuthor::findOne($id);
            $model -> delete();
            return Yii::$app->response->redirect(Url::to('profile'));
        }
        else if($gridid == 3)
        {
            $model = Profile2Book::findOne($id);
            $model -> delete();
            return Yii::$app->response->redirect(Url::to('profile'));
        }
    }
}