<?php

namespace app\modules\admin\components;

use Mimey\MimeTypes;
use RuntimeException;
use yii\web\UploadedFile;

class UrlUploadedFile extends UploadedFile
{
    public function __construct($link, $config = [])
    {
        $fileName = \Yii::$app->security->generateRandomString();

        $this->tempName = sys_get_temp_dir() . '/' . $fileName;
        if  (!copy($link, $this->tempName)) {
            throw new RuntimeException('Не удалось скачать файл');
        }

        $mimes = new MimeTypes;
        $extension = $mimes->getExtension(mime_content_type($this->tempName));
        rename($this->tempName, $this->tempName .= '.' . $extension);

        if (!filesize($this->tempName)) {
            unlink($this->tempName);
            throw new RuntimeException($this->tempName . ' Пустой файл');
        }

        $this->name = pathinfo($this->tempName, PATHINFO_BASENAME);

        parent::__construct($config);
    }

    public function saveAs($file, $deleteTempFile = false)
    {
        if ($this->error == UPLOAD_ERR_OK) {
            $result = copy($this->tempName, $file);
            unlink($this->tempName);
            return $result;
        }

        return false;
    }

    public function __destruct()
    {
        if (is_file($this->tempName)) {
            unlink($this->tempName);
        }
    }
}
