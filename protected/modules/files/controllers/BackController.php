<?php

class BackController extends AdminController
{
    /**
     * Функция сохранения картинок из админки
     */
    public function actionUpload($portal = true)
    {
//        $folder = $portal ? BaseActiveRecord::getUploadFolder() : NoBaseActiveRecord::getUploadFolder();
        $folder = BaseActiveRecord::getUploadFolder();

        $folder = Yii::app()->getBasePath() . "/..{$folder}";

        $sizeLimit = 200 * 1024 * 1024;

        $uploader = new qqFileUploader(array(), $sizeLimit);
        $result = $uploader->handleUpload($folder);

        if (!isset($result['error']))
        {
            $record = new File();
            $record->origin_name = $result['basename'];
            $record->name = $result['filename'];
            $record->size = filesize($folder . $result['filename']);
            $record->ext = $result['ext'];
            $record->date = time();

            $result['is_image'] = $record->isImage();

            if ($record->save())
                $result = $result + array('id' => $record->id, 'file_size' => ($record->size/10^6));
            else
                $result = array('error' => 'Не удалось сохранить запись о файле в БД');

        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }


    /**
     * Функция удаления картинок из админки
     */
    public function actionDelete($id)
    {
        if (!$record = File::model()->findByPk($id))
        {
            echo 'fail';
            die;
        }

        if($record->delete())
            echo 'success';
    }
}