<?php
/**
 * author: Mikhail Matveev
 * Date: 25.02.15 
 */

class PageGallery extends PhotoGallery {

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('state', 'numerical', 'integerOnly' => TRUE),
            array('photos', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, title, date, photo, preview, description, state', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PhotoGallery the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    public function behaviors()
    {
        return array();
    }



}