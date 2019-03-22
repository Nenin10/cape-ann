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
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()->where(['user_id' => $id])
        ]);
        return $this->render('profile', ['dataProvider' => $dataProvider]);
    }

    public function actionLogin()
    {
        $this->layout = 'form';

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
                    $session->set('user_email', $user->email);
                    $session->set('user_password', $user->password);

                    $userProfile = $profile->GetProfile($session['id']);
                    if(!is_null($userProfile)) {
                        $session->set('user_name', $userProfile->name);
                        $session->set('user_birth', $userProfile->birth_date);
                        $session->set('user_image', $userProfile->image);
                        return Yii::$app->response->redirect(Url::to('../main/home'));
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
        $this->layout = 'form';

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
                $userID = $user->id;
                $profile = new Profile();
                $profile->user_id = $userID;
                $profile->name = NULL;
                $profile->birth_date = NULL;
                $profile->image = NULL;

                if ($profile->validate()) {
                    $profile->save();
                    return Yii::$app->response->redirect(Url::to('../main'));
                }
            }
        }
        return $this->render('forms/registerform', ['model' => $model]);
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

    public function actionUpdate($id)
    {
        $this->layout = 'form';

        $model = User::findOne($id);
        if ($model -> load(Yii::$app->request->post()) && $model -> validate())
        {
            $model -> save();
            return Yii::$app->response->redirect(Url::to('index'));
        }
        return $this->render('forms/addUser', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = User::findOne($id);
        $model -> delete();
        return Yii::$app->response->redirect(Url::to('index'));
    }
}