<?php
/**
 * Created by PhpStorm.
 * User: CERN
 * Date: 06.03.2018
 * Time: 13:36
 */

namespace app\models;

use Yii;

class ImagePath
{
    public $localPathToImage;
    public $relativeUrlToImage;

    public function setImagePathById($id)
    {
        $this->relativeUrlToImage = $id . '.' . 'jpg';
        $this->setLocalPathToImage();

        if ( file_exists($this->localPathToImage) ) {
            return;
        }
        $this->relativeUrlToImage = $id . '.' . 'png';
        $this->setLocalPathToImage();
    }

    private function setLocalPathToImage() {
        $this->localPathToImage = Yii::getAlias('@app/web/img') . '/' . $this->relativeUrlToImage;

    }

    public function deleteImage() {
        unlink($this->localPathToImage);
    }
}