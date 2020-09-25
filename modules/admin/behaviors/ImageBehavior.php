<?php

namespace app\modules\admin\behaviors;

use InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class ImageBehavior extends ImageUploadBehavior
{
    public $createThumbsOnRequest = true;
    public $attribute = 'image';
    public $hashAttribute;
    public $thumbs = [
        'thumb' => ['width' => 100, 'height' => 100],
    ];
    public $folder;

    public function init()
    {
        parent::init();

        if (empty($this->folder)) {
            throw new InvalidArgumentException('property "folder" should be set');
        }

        if (empty($this->hashAttribute)) {
            $this->hashAttribute = $this->attribute . '_hash';
        }

        $this->filePath = "@webroot/uploads/{$this->folder}/[[pk]]_[[attribute_{$this->hashAttribute}]].[[extension]]";
        $this->fileUrl = "/uploads/{$this->folder}/[[pk]]_[[attribute_{$this->hashAttribute}]].[[extension]]";
        $this->thumbPath = "@webroot/uploads/cache/{$this->folder}/[[pk]]_[[attribute_{$this->hashAttribute}]]_[[profile]].[[extension]]";
        $this->thumbUrl = "/uploads/cache/{$this->folder}/[[pk]]_[[attribute_{$this->hashAttribute}]]_[[profile]].[[extension]]";
    }

    public function beforeSave()
    {
        if ($this->owner->{$this->attribute} instanceof UploadedFile) {
            $this->owner->{$this->hashAttribute} = uniqid();
        }

        if ($this->file instanceof UploadedFile) {

            if (true !== $this->owner->isNewRecord) {
                /** @var ActiveRecord $oldModel */
                $oldModel = $this->owner->findOne($this->owner->primaryKey);
                $behavior = static::getInstance($oldModel, $this->attribute);
                $behavior->cleanFiles();
            }

            $this->owner->{$this->attribute} = implode('.',
                array_filter([$this->file->baseName, $this->file->extension], 'strlen')
            );
        } else {
            if (true !== $this->owner->isNewRecord && empty($this->owner->{$this->attribute})) {
                $this->owner->{$this->attribute} = ArrayHelper::getValue($this->owner->oldAttributes, $this->attribute,
                    null);
            }
        }
    }

    public function deleteImage()
    {
        $this->cleanFiles();
        $this->owner->updateAttributes([$this->attribute => null, $this->hashAttribute => null]);
    }

    public function hasImage()
    {
        return !empty($this->owner->{$this->attribute}) && is_file($this->getUploadedFilePath($this->attribute));
    }
}