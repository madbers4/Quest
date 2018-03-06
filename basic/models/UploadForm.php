<?php
/**
 * Created by PhpStorm.
 * User: CERN
 * Date: 05.03.2018
 * Time: 21:54
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    private $pathToFile = false;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if($this->pathToFile!=false) {
            if ($this->validate()) {
                $this->imageFile->saveAs($this->pathToFile);
                return true;
            }
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Изображение',
        ];
    }

    public function setPathToFile($id) {
        $this->pathToFile = Yii::getAlias('@app/web/img') . '/' . $id . '.' . $this->imageFile->extension;
    }
}