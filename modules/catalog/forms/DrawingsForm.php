<?php


namespace app\modules\catalog\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class DrawingsForm extends Model
{
    public $files;

    public function rules()
    {
        return [
            ['files', 'each', 'rule' => ['image', 'extensions' => 'jpeg, png, jpg']]
        ];
    }
    public function attributeLabels()
    {
        return [
            'files' => 'Чертежи',
        ];
    }

    public function beforeValidate()
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        return parent::beforeValidate();
    }
}
