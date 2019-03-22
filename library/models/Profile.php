<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $birth_date
 * @property string $image
 *
 * @property User $user
 * @property Profile2book[] $profile2books
 * @property ProfileAuthor[] $profileAuthors
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['birth_date'], 'safe'],
            [['image'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'birth_date' => 'Birth Date',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile2books()
    {
        return $this->hasMany(Profile2book::className(), ['profile_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileAuthors()
    {
        return $this->hasMany(ProfileAuthor::className(), ['profile_id' => 'id']);
    }
//----------------- FIND PROFILE
    public function getProfile($user_id)
    {
        return Profile::findByUser($user_id);
    }
    public static function findByUser($user_id)
    {
        return self::findOne(['user_id' => $user_id]);
    }
}
