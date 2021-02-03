<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Profile;
use app\models\User;

class MainController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
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
                        $session->set('profile_id', $userProfile->id);
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
        return $this->render('forms/login', ['model' => $model]);
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
        return $this->render('forms/register', ['model' => $model]);
    }

    public function actionHome()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()
        ]);

        $dataProvider1 = new ActiveDataProvider([
            'query' => User::find()
        ]);
        return $this->render('home', ['dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1]);
    }
}