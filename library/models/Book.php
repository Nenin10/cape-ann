<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property int $year
 *
 * @property Profile2book[] $profile2books
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author'], 'required'],
            [['year'], 'integer'],
            [['cover', 'description'], 'string'],
            [['title', 'author'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'year' => 'Year',
            'cover' => 'Cover Image',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile2books()
    {
        return $this->hasMany(Profile2book::className(), ['book_id' => 'id']);
    }
}
