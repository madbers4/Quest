<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "records".
 *
 * @property int $id
 * @property string $heading
 * @property string $author_name
 * @property string $text
 * @property string $date_of_creation
 * @property string $Is_there_a_photo
 */
class Records extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_name', 'heading', 'text'], 'required'],
            [['text'], 'string'],
            [['date_of_creation'], 'safe'],
            [['heading', 'author_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heading' => 'Заголовок',
            'author_name' => 'Имя автора',
            'text' => 'Текст',
            'date_of_creation' => 'Дата создания',
            'Is_there_a_photo' => 'Есть ли изображение?',
        ];
    }

    public function setData()
    {
        $this->date_of_creation = date("Y-m-d H:i:s");
        return true;
    }

}
