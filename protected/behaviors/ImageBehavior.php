<?php

/**
 * @property BaseActiveRecord $owner
 * Class ImageBehavior
 */
class ImageBehavior extends CActiveRecordBehavior
{
    public $fields = array();

    public $module = null;

    private $smallPrefix = 'small_';

    private $mediumPrefix = 'medium_';

    private $largePrefix = 'large_';

    public function beforeSave($event)
    {
        // Создаем preview для всех полей, которые переданы в массиве fields
        foreach ($this->fields as $item)
        {
            if ($this->owner->$item['field'])
            {
                if (!empty($item['small']))
                    $this->createSmallImage($item['field'], $item['small']);

                if (!empty($item['medium']))
                    $this->createMediumImage($item['field'], $item['medium']);

                if (!empty($item['large']))
                    $this->createLargeImage($item['field'], $item['large']);
            }
        }

        return parent::beforeSave($event);
    }

    public function afterDelete($event)
    {
        // Удаляем все связанные с моделью файлы изображений
        foreach ($this->fields as $item)
        {
            $imagePath  = $this->getImagePath($item['field']);
            $smallPath  = $this->getSmallPath($item['field']);
            $mediumPath = $this->getMediumPath($item['field']);
            $largePath  = $this->getLargePath($item['field']);

            if (is_file($imagePath))
                unlink($imagePath);

            if (is_file($smallPath))
                unlink($smallPath);

            if (is_file($mediumPath))
                unlink($mediumPath);

            if (is_file($largePath))
                unlink($largePath);
        }
    }

    public function getUploadPath()
    {
        $model = $this->owner;

        $result = Yii::app()->basePath . "/..{$model::getUploadFolder()}";

        if (!is_dir($result)) {
            if (!mkdir($result, 0777, true))
                Yii::log("Unable create a directory {$result}", CLogger::LEVEL_ERROR);
        }

        return $result;
    }

    protected function getThumbPath()
    {
        if ($this->module) {
            $path = "{$this->getUploadPath()}thumbs/{$this->module}/";
        } else {
            $path = "{$this->getUploadPath()}thumbs/";
        }

        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                Yii::log("Unable create a directory {$path}", CLogger::LEVEL_ERROR);
            }
        }

        return $path;
    }

    protected function getThumbUrl()
    {
        $model = $this->owner;

        if (isset($model->portal_id))
            $path = $model::getUploadPath($model->portal_id);
        else
            $path = $model::getUploadPath();

        return $this->module ? "{$path}thumbs/{$this->module}/" : "{$this->owner->uploadFilePath}thumbs/";
    }


    protected function getImageName($imageField)
    {
        if ($this->owner->$imageField instanceof CActiveRecord)
            $file = $this->owner->$imageField;
        else
            $file = File::model()->resetScope()->findByPk($this->owner->$imageField);

        if ($file !== null) {
            return $file->name;
        } else {
            return false;
        }
    }


    protected function getImagePath($imageField)
    {
        return $this->getUploadPath() . $this->getImageName($imageField);
    }

    protected function getSmallPath($imageField)
    {
        return $this->getThumbPath(). $this->smallPrefix . $this->getImageName($imageField);
    }

    protected function getMediumPath($imageField)
    {
        return $this->getThumbPath() . $this->mediumPrefix . $this->getImageName($imageField);
    }

    protected function getLargePath($imageField)
    {
        return $this->getThumbPath() . $this->largePrefix . $this->getImageName($imageField);
    }


    protected function createSmallImage($imageField, $params)
    {
        try
        {
            $image = Yii::app()->image->load($this->getImagePath($imageField));
            $image->smart_resize($params['width'], $params['height']);
            $image->save($this->getSmallPath($imageField));
        }
        catch(Exception $exception)
        {
            $className = get_class($this->owner);

            Yii::log("Не удалось создать small-preview изображение в модели {$className}");
        }
    }

    protected function createMediumImage($imageField, $params)
    {
        try
        {
            $image = Yii::app()->image->load($this->getImagePath($imageField));
            $image->smart_resize($params['width'], $params['height']);
            $image->save($this->getMediumPath($imageField));
        }
        catch(Exception $exception)
        {
            $className = get_class($this->owner);

            Yii::log("Не удалось создать medium-preview изображение в модели {$className}");
        }
    }

    protected function createLargeImage($imageField, $params)
    {
        try
        {
            $image = Yii::app()->image->load($this->getImagePath($imageField));
            $image->smart_resize($params['width'], $params['height']);
            $image->save($this->getLargePath($imageField));
        }
        catch(Exception $exception)
        {
            $className = get_class($this->owner);

            Yii::log("Не удалось создать large-preview изображение в модели {$className}");
        }
    }

    /**
     * Получение пути до исходного изображения
     * @return string
     */
    public function getImageUrl($imageField = 'photo')
    {
        $model = $this->owner;

        $name = $this->getImageName($imageField);

        if ($name == false)
            return false;

        return $model::getUploadPath() . $this->getImageName($imageField);
    }

    /**
     * Получение пути до маленькой preview
     * @return string
     */
    public function getSmallUrl($imageField = 'photo')
    {
        $name = $this->getImageName($imageField);

        if ($name == false)
            return false;

        return $this->getThumbUrl() . $this->smallPrefix . $this->getImageName($imageField);
    }

    /**
     * Получение пути до средней preview
     * @return string
     */
    public function getMediumUrl($imageField = 'photo')
    {
        $name = $this->getImageName($imageField);

        if ($name == false)
            return false;

        return $this->getThumbUrl() . $this->mediumPrefix . $this->getImageName($imageField);
    }

    /**
     * Получение пути до большой preview
     * @return string
     */
    public function getLargeUrl($imageField)
    {
        $name = $this->getImageName($imageField);

        if ($name == false)
            return false;


        return $this->getThumbUrl() . $this->largePrefix . $this->getImageName($imageField);
    }
}