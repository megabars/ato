<?php

Yii::app()->getModule('files');
Yii::app()->getModule('video');

class VideoEncodeCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('webm IS NULL', 'OR');
        $criteria->addCondition('ogv IS NULL', 'OR');

        foreach (VideoGalleryVideos::model()->findAll($criteria) as $item)
        {
            if ($item->mp4 && $file = File::model()->findByPk($item->mp4))
            {
                $streamer = new VideoStreamer($file);

                $item->mp4 = $streamer->saveFile('mp4');
                $item->webm = $streamer->saveFile('webm');
                $item->ogv = $streamer->saveFile('ogv');

                echo $item->save();
            }
        }
    }
}