<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $uid
 * @property string $title
 * @property string $descr
 * @property string $text
 * @property string $created
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function relations(){
        return [
            'user'=>[self::BELONGS_TO, 'User', 'uid']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'title', 'descr', 'text'], 'required'],
            [['uid'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe'],
            [['title', 'descr'], 'string', 'max' => 255],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'title' => 'Title',
            'descr' => 'Descr',
            'text' => 'Text',
            'created' => 'Created',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
