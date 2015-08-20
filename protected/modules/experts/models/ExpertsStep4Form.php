<?php

/**
 * Регистрация эксперта
 * Class ExpertsStep4Form
 */
class ExpertsStep4Form extends CFormModel
{
    public $education; //r
    public $degree = 1; //r
    public $degrees;
    public $academic = 1; //r
    public $academics;
    public $honorary = 1; //r
    public $honoraries;
    public $publishing;
    public $publishing_count;
    public $further_education;
    public $further_education_required = false;

    public function rules()
    {
        return array(
            array('education, degree, academic, honorary', 'required'),
            array('education, degrees, academics, honoraries, further_education', 'validateMultipleRows'),
            array('degree, academic, honorary', 'numerical', 'integerOnly'=>true),
            array('publishing_count', 'numerical', 'integerOnly'=>true, 'message'=>'Количество должно быть числом'),
            array('degree, degrees, academic, academics, honorary, honoraries, publishing, publishing_count, further_education','safe'),
        );
    }

    public function validateMultipleRows($attribute) {
        if (is_array($this->$attribute)) {

            $lines = Experts::arraySortingToLine($this->$attribute);

            // собираем данные по полям строк
            $filledLines = 0;
            $emptyFields = array();
            foreach($lines as $line => $fields) {
                foreach($fields as $field=>$value) {
                    if($field == 'year') {
                        if($value != '' && (iconv_strlen($value)!=4 || iconv_strlen((int)$value)!=4))
                            $this->addError("{$attribute}[{$field}][{$line}]", 'Значение года должно содержать 4 цифры');
                        if($value != '' && (int)$value>(int)date('Y'))
                            $this->addError("{$attribute}[{$field}][{$line}]", 'Значение года не может быть более '.date('Y'));
                    }
                    if(trim($value)=='')
                        $emptyFields[$line][]=$field;
                }
                if(@count($emptyFields[$line])==0)
                    $filledLines++;
            }

            // валидация
            if(count($emptyFields)>0)  {
                foreach($emptyFields as $emptyLine => $emptyField){
                    if($filledLines < 1) {
                        if($attribute == 'education')
                            $this->customAddError($attribute, $emptyLine, $emptyField,'Необходимо указать данные по образованию');

                        if($attribute=='degrees' && $this->degree == 1)
                            $this->customAddError($attribute, $emptyLine, $emptyField,'Если имеется ученая степень, необходимо указать данные по нему');

                        if($attribute=='academics' && $this->academic == 1)
                            $this->customAddError($attribute, $emptyLine, $emptyField,'Если имеется ученое звание, необходимо указать данные по нему');

                        if($attribute=='honoraries' && $this->honorary == 1)
                            $this->customAddError($attribute, $emptyLine, $emptyField,'Если имеется почетное звание, необходимо указать данные по нему');
                    }

                    if(count($emptyField) < count($this->$attribute))
                        $this->customAddError($attribute, $emptyLine, $emptyField,'Все поля в строке должны быть заполнены');
                }
            }
        }
    }

    protected function customAddError($attribute, $emptyLine, $emptyField, $message, $fieldMessage = 'Нужно заполнить поле'){
        $this->addError($attribute, $message);
        foreach($emptyField as $field)
            $this->addError("{$attribute}[{$field}][{$emptyLine}]", $fieldMessage);
    }

    public function attributeLabels()
    {
        return array(
            'education' => 'Образование (специальность по диплому)',
            'degree' => 'Наличие ученой степени',
            'academic' => 'Наличие ученого звания',
            'honorary' => 'Наличие почетного звания (степени)',
            'publishing' => 'Наличие публикаций в научных журналах',
            'further_education' => 'Дополнительное образование (курсы, семинары и т.п.)',
        );
    }
}
