<?php

class VideoStreamer
{
    public $programPath;
    public $file;

    public function __construct($fileModel, $programPath = null)
    {
        // Если путь не указан, устанавливаем пути по умолчанию
        $os = preg_match('/^WIN/', PHP_OS) ? 'windows' : 'linux';

        if ($os == 'linux')
        {
            $programPath = '/usr/bin/ffmpeg';
        }
        elseif ($programPath === null && $os == 'windows')
        {
            $programPath = 'C:\ffmpeg\bin\ffmpeg.exe';
        }

        $this->programPath = $programPath;

        $this->file = $fileModel;
    }

    /**
     * Сохранение файла в другом формате
     * @param $format
     * @return int
     */
    public function saveFile($format)
    {
        $filePath = File::model()->getFilePath($this->file->id);
        $fileFolder = dirname($filePath);
        $originFileNameWithoutExt = mb_substr($this->file->origin_name, 0, strripos($this->file->origin_name, '.', -1));
        $fileNameWithoutExt = mb_substr($this->file->name, 0, strripos($this->file->name, '.', -1));

        $newFileName = "{$format}_{$fileNameWithoutExt}.{$format}";
        $newFilePath = "{$fileFolder}/{$newFileName}";

        // Команды ffmpeg для различных форматов
        switch ($format) {
            case 'webm':
                $command = ' -i %s -vcodec libvpx -acodec libvorbis %s';
                break;
            case 'ogv':
                $command = ' -i %s -vcodec libtheora -acodec libvorbis %s';
                break;
            case 'mp4':
                $command = ' -i %s -vcodec libx264 -acodec aac -strict -2 %s';
                break;
            default:
                $command = ' -i %s -vcodec libvpx -acodec libvorbis %s';
                break;
        }
        $commandForExecute = sprintf($command, $filePath, $newFilePath);
        exec("{$this->programPath} {$commandForExecute}");

        // Сохранение в модель файлов
        $videoFile = new File();
        $videoFile->portal_id = $this->file->portal_id;
        $videoFile->origin_name = "{$originFileNameWithoutExt}.{$format}";
        $videoFile->ext = $format;
        $videoFile->date = time();
        $videoFile->name = $newFileName;
        $videoFile->size = @filesize($newFilePath);
        $videoFile->save();

        return $videoFile->id;
    }
}