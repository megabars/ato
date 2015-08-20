<?php

/**
 * This is the model class for table "settings_mail".
 *
 * The followings are the available columns in table 'settings_mail':
 * @property string $id
 * @property string $server_email
 * @property integer $type
 * @property string $smtp_host
 * @property integer $smtp_port
 * @property string $smtp_username
 * @property string $smtp_password
 * @property string $sendmail_path
 * @property string $support_addr_1
 * @property string $support_addr_2
 */
class SettingsMail extends BaseActiveRecord
{
    const TYPE_SMTP = 0;
    const TYPE_SENDMAIL = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SettingsMail the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

//    public function beforeSave(){
//
//        $this->portal_id = Yii::app()->controller->portalId;
//        return parent::beforeSave();
//
//    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'settings_mail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, smtp_port', 'numerical', 'integerOnly' => true),
            array('server_email, smtp_host, smtp_username, smtp_password, sendmail_path', 'length', 'max' => 255),
            array('support_addr_1, support_addr_2', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, server_email, type, smtp_host, smtp_port, smtp_username, smtp_password, sendmail_path', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
//            'portal_id' => 'Портал',
            'server_email' => 'E-mail сервера',
            'type' => 'Протокол почты',
            'smtp_host' => 'Хост SMTP',
            'smtp_port' => 'Порт SMTP',
            'smtp_username' => 'Имя пользователя SMTP',
            'smtp_password' => 'Пароль SMTP',
            'sendmail_path' => ' Путь Sendmail',
            'support_addr_1' => 'Адрес техподдержки #1',
            'support_addr_2' => 'Адрес техподдержки #2'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
//        $criteria->compare('portal_id', $this->portal_id, true);
        $criteria->compare('server_email', $this->server_email, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('smtp_host', $this->smtp_host, true);
        $criteria->compare('smtp_port', $this->smtp_port);
        $criteria->compare('smtp_username', $this->smtp_username, true);
        $criteria->compare('smtp_password', $this->smtp_password, true);
        $criteria->compare('sendmail_path', $this->sendmail_path, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}