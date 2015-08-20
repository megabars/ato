<?php
/**
 * author: Mikhail Matveev
 * Date: 04.03.15 
 */

class PageExecutivesController extends AdminController {

    public function actionCreate($pageId = false)
    {
        Yii::app()->getClientScript()->scriptMap = array('*.js' => false, '*.css' => false);

        $model=new PageExecutives;
        $model->page_id = $pageId;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['PageExecutives']))
        {
            $model->attributes=$_POST['PageExecutives'];
            if(!$model->save())
                throw new CHttpException(500, print_r($model->getErrors(), true));
        } else {
            $this->renderPartial('_form',array(
                'model'=>$model
            ), false, true);
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        Yii::app()->getClientScript()->scriptMap = array('*.js' => false, '*.css' => false);

        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['PageExecutives']))
        {
            $model->attributes=$_POST['PageExecutives'];
            if(!$model->save())
                throw new CHttpException(500, print_r($model->getErrors(), true));
        } else {
            $this->renderPartial('_form',array(
                'model'=>$model
            ), false, true);
        }

    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                PageExecutives::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model=PageExecutives::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

}