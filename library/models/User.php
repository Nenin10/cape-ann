<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $rank
 * @property string $email
 *
 * @property Profile[] $profiles
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Username is required.'],
            ['password', 'required', 'message' => 'Password is required.'],
            ['email', 'required', 'message' => 'Email is required.'],
            ['rank', 'required', 'message' => 'Rank is required.'],
            [['username', 'password'], 'string', 'max' => 16],
            [['email'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'rank' => 'Rank',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['user_id' => 'id']);
    }
//----------------- SCENARIOS
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['login'] = ['username','password'];// Za login
        return $scenarios;
    }
//----------------- FIND USER
    public function getUser($username)
    {
        return User::findByUsername($username);
    }
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
//----------------- ID TOKENS
    public function getAuthKey()
    {
        throw new NotSupportedException();
    }
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
    }
    public function getId()
    {
        return $this->id;
    }
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }
}
