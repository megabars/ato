<?php

Yii::import('gii.generators.crud.CrudCode');

class AlexCode extends CrudCode
{
    public $baseControllerClass = 'AdminController';

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'model' => 'Класс модели',
            'controller' => 'Контроллер',
            'baseControllerClass' => 'Наследуемый контроллер',
        ));
    }

    public function getViewPath()
    {
        return Yii::app()->getBasePath() . '/themes/admin/views/'.$this->getControllerID();
    }

    public function generateActiveRow($modelClass, $column)
    {
        if ($column->type === 'boolean')
        {
            return "\$form->checkBoxRow(\$model,'{$column->name}')";
        }
        else if (stripos($column->dbType, 'text') !== false)
        {
            return "\$form->textAreaRow(\$model,'{$column->name}',array('rows'=>6, 'cols'=>50, 'class'=>'span8'))";
        }
        else
        {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name))
            {
                $inputField = 'passwordFieldRow';
            }
            else
            {
                $inputField = 'textFieldRow';
            }

            if ($column->type !== 'string' || $column->size === null)
            {
                if ($column->dbType == 'date')
                {
                    return "\$form->datepickerRow(\$model,'{$column->name}',array('options'=>array(),'htmlOptions'=>array('class'=>'span5')),array('prepend'=>'<i class=\"icon-calendar\"></i>','append'=>'Click on Month/Year at top to select a different year or type in (mm/dd/yyyy).'))";
                }
                else
                {
                    return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5'))";
                }
            }
            else
            {
                if (strpos($column->dbType, 'enum(') !== false)
                {
                    $temp = $column->dbType;
                    $temp = str_replace('enum', 'array', $temp);
                    // FIXME: What. The. Seriously, parse the enum declaration from MySQL as an array definition in PHP?!
                    eval ('$options = ' . $temp . ';');
                    $dropdown_options = "array(";
                    foreach ($options as $option)
                    {
                        $dropdown_options .= "\"$option\"=>\"$option\",";
                    }
                    $dropdown_options .= ")";
                    return "\$form->dropDownListRow(\$model,'{$column->name}',{$dropdown_options},array('class'=>'input-large'))";
                }
                else
                {
                    return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5','maxlength'=>$column->size))";
                }
            }
        }
    }
}
