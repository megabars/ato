<?php

class AudioStreamer
{
    public $command = ' -i %s -vn -ab 192k -f %s %s';
    public $programPath;
    public $file;

    public function __construct($fileModel, $programPath = null)
    {
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

    public function saveFile($format)
    {
        $filePath = File::model()->getFilePath($this->file->id);
        $fileFolder = dirname($filePath);
        $originFileNameWithoutExt = mb_substr($this->file->origin_name, 0, strripos($this->file->origin_name, '.', -1));
        $fileNameWithoutExt = mb_substr($this->file->name, 0, strripos($this->file->name, '.', -1));

        $newFileName = "{$format}_{$fileNameWithoutExt}.{$format}";
        $newFilePath = "{$fileFolder}/{$newFileName}";

        $commandForExecute = sprintf($this->command, $filePath, $format, $newFilePath);
        exec("{$this->programPath} {$commandForExecute}");

        $wavFile = new File();
        $wavFile->origin_name = "{$originFileNameWithoutExt}.{$format}";
        $wavFile->ext = $format;
        $wavFile->date = time();
        $wavFile->name = $newFileName;
        $wavFile->size = filesize($newFilePath);
        $wavFile->save();

        return $wavFile->id;
    }
}