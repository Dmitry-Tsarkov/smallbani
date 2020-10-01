<?php


namespace app\modules\catalog\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class PhotosForm extends Model
{
    public $files;

    public function rules()
    {
        return [
            ['files', 'each', 'rule' => ['image', 'extensions' => 'jpeg, png, jpg']]
        ];
    }

    public function beforeValidate()
    {
        $this->files = UploadedFile::getInstances($this, 'photos');
        return parent::beforeValidate();
    }
}