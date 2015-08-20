<?php

class DetailsController extends AdminController
{

    public function actionLoadForm($id=null){
        $cs=Yii::app()->getClientScript();
        $cs->registerCoreScript('maskedinput');
        $cs->scriptMap = array('jquery.js' => false, '*.css' => false);

        $model = new ContactDetails;
        if (isset($id))
            $model = ContactDetails::model()->findByPk($id);

            $model->contact_id = $_POST['contact_id'];

        $this->renderPartial('_form', array(
            'model' => $model,
        ), false, true);
    }

    public function actionProcessing()
    {
        if (isset($_POST['ContactDetails'])) {
            $model = new ContactDetails;

            if (isset($_POST['ContactDetails']['id']))
                $model = ContactDetails::model()->findByPk($_POST['ContactDetails']['id']);

            $model->setAttributes($_POST['ContactDetails'], false);

            if ($model->type == ContactType::EMAIL)
                $model->scenario = 'emailType';

            $this->performAjaxValidation($model);

            if ($model->save())
                return true;
            else
                throw new CHttpException(500, 'Validation!');
        }
    }

    public function actionDelete($id)
    {
        ContactDetails::model()->deleteByPk($id);
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                $this->actionDelete($id);
        }

        echo json_encode(true);
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-details-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}