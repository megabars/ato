<?php

/**
 * Class Groups
 */
class FileMailForm extends CFormModel
{
    public $file;

    public function rules()
    {
        return array(
            array('file', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'file'    => 'CSV формата: email;first_name;last_name;surname;agreement',
        );
    }

    public function saveStruct()
    {
        $info = array();

        if (!empty($this->file) && ($file = File::model()->resetScope()->findByPk($this->file)) !== null)
        {
            $path = $file->getFilePath();

            if (file_exists($path))
            {
                $fp = fopen($path,'r');

                $data = array();

                while (($filePart = fgetcsv($fp, 0, ';')) !== false)
                    $data[]=$filePart;

                fclose($fp);
                array_shift($data);
                if ($data === false OR count($data[0]) < 1) {
                    $this->addError('file', 'Некорректный формат файла');
                } else {

                    foreach ($data as $item) {
                        $email = trim($item[0]);
                        if(!empty($email))
                            if(!$model = MailEmailList::model()->findByAttributes(array('email'=>$email)))
                            {
                                $model = new MailEmailList();
                                $model->email = $email;
                            }

                        if(!empty($item[1]))
                        $model->first_name = $item[1];
                        if(!empty($item[2]))
                        $model->last_name = $item[2];
                        if(!empty($item[3]))
                        $model->surname = $item[3];

                        $model->agreement = (int)@$item[4];

                        $info[$email] = ($model->save()?($model->isNewRecord?'Сохранено':"Обновлено"):'Ошибка');

                    }

                    File::model()->deleteByPk($this->file);
                    @unlink($path);
                }

            }
        }
        return $info;

    }

    public function saveGroupStruct($group_id)
    {
        $info = array();

        if (!empty($this->file) && ($file = File::model()->resetScope()->findByPk($this->file)) !== null)
        {
            $path = $file->getFilePath();

            if (file_exists($path))
            {
                $fp = fopen($path,'r');

                $data = array();

                while (($filePart = fgetcsv($fp, 0, ';')) !== false)
                    $data[]=$filePart;

                fclose($fp);
                array_shift($data);
                if ($data === false OR count($data[0]) < 1) {
                    $this->addError('file', 'Некорректный формат файла');
                } else {

                    foreach ($data as $item) {
                        $email = trim($item[0]);
                        if(!empty($email))
                            if(!$model = MailEmailList::model()->findByAttributes(array('email'=>$email)))
                            {
                                $model = new MailEmailList();
                                $model->email = $email;
                            }

                        if(!empty($item[1]))
                            $model->first_name = $item[1];
                        if(!empty($item[2]))
                            $model->last_name = $item[2];
                        if(!empty($item[3]))
                            $model->surname = $item[3];

                        $model->agreement = (int)@$item[4];
                        $model->save();

                        $modelGroup = new MailGroupEmailList();
                        $modelGroup->list_id = $model->id;
                        $modelGroup->group_id = $group_id;

                        $info[$email] = ($modelGroup->save()?'Сохранено':'Ошибка');

                    }

                    File::model()->deleteByPk($this->file);
                    @unlink($path);
                }

            }
        }
        return $info;
    }
}
