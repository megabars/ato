<?php

class FrontController extends Controller
{
    public function actionDownload($id)
    {

        if (($model = File::model()->resetScope()->findByPk($id)) && ($file = File::model()->getFilePath($id)))
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $model->origin_name . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));

            readfile($file);
            exit;
        }

        echo 'Файл не найден';
    }

    /**
     * Функция сохранения файлов из админки
     */
    public function actionUpload($portal = true)
    {
//        $folder = $portal ? BaseActiveRecord::getUploadFolder() : NoBaseActiveRecord::getUploadFolder();
        $folder = BaseActiveRecord::getUploadFolder();

        $folder = Yii::app()->getBasePath() . "/..{$folder}";

        $sizeLimit = 500 * 1024 * 1024;

        $uploader = new qqFileUploader(array(), $sizeLimit);
        $result = $uploader->handleUpload($folder);

        if (!isset($result['error']))
        {
            $record = new File();
            $record->origin_name = $result['basename'];
            $record->name = $result['filename'];
            $record->size = filesize($folder . $result['filename']);
            $record->ext  = $result['ext'];
            $record->date = time();
            $record->user_id = Yii::app()->user->id;

            $result['is_image'] = $record->isImage();

            if ($record->save()) {

                $result = $result + array('id' => $record->id, 'file_size' => round($record->size/pow(10,6),1));
            }
        } else {
            print_r($result);
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
}