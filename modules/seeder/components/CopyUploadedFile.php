<?php

namespace app\modules\seeder\components;

use RuntimeException;
use yii\web\UploadedFile;

class CopyUploadedFile extends UploadedFile
{
    public function __construct($file, $config = [])
    {
        $this->tempName = $file;

        if (!filesize($this->tempName)) {
            throw new RuntimeException($this->tempName . ' Пустой файл');
        }

        $this->name = pathinfo($this->tempName, PATHINFO_BASENAME);

        parent::__construct($config);
    }

    public function saveAs($file, $deleteTempFile = false)
    {
        if ($this->error == UPLOAD_ERR_OK) {
            return copy($this->tempName, $file);
        }

        return false;
    }
}