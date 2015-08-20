<?php

class StyledCheckBoxColumn extends CCheckBoxColumn
{

    public function getHeaderCellContent()
    {
        if(trim($this->headerTemplate)==='')
            return $this->grid->blankDisplay;

        if($this->selectableRows===null && $this->grid->selectableRows>1)
            $item=CHtml::checkBox($this->id.'_all',false,array('class'=>'select-on-check-all')) .' '. CHtml::label('',$this->id.'_all');
        elseif($this->selectableRows>1)
            $item=CHtml::checkBox($this->id.'_all',false) .' '. CHtml::label('',$this->id.'_all');
        else
            $item=parent::getHeaderCellContent();

        return strtr($this->headerTemplate,array(
            '{item}'=>$item,
        ));
    }

    public function getDataCellContent($row)
    {
        $data=$this->grid->dataProvider->data[$row];
        if($this->value!==null)
            $value=$this->evaluateExpression($this->value,array('data'=>$data,'row'=>$row));
        elseif($this->name!==null)
            $value=CHtml::value($data,$this->name);
        else
            $value=$this->grid->dataProvider->keys[$row];

        $checked = false;
        if($this->checked!==null)
            $checked=$this->evaluateExpression($this->checked,array('data'=>$data,'row'=>$row));

        $options=$this->checkBoxHtmlOptions;
        if($this->disabled!==null)
            $options['disabled']=$this->evaluateExpression($this->disabled,array('data'=>$data,'row'=>$row));

        $name=$options['name'];
        unset($options['name']);
        $options['value']=$value;
        $options['id']=$this->id.'_'.$row;
        return CHtml::checkBox($name,$checked,$options) .' '. CHtml::label('',$options['id']);
    }
}