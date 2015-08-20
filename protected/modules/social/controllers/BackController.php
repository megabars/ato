<?php

class BackController extends AdminController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionEdit($type)
	{
		$model=SocialNetwork::findByType($type);
        if (is_null($model))
            $model = new SocialNetwork();

		if(isset($_POST['SocialNetwork']))
		{
			$model->attributes=$_POST['SocialNetwork'];
            $model->portal_id = Yii::app()->controller->portalId;
            $model->type = $type;
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
            'type' => $type,
		));
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$social = array();

        $social['vk'] = SocialNetwork::getLinkByType(SocialType::VK);
        $social['tw'] = SocialNetwork::getLinkByType(SocialType::TWITTER);
        $social['fb'] = SocialNetwork::getLinkByType(SocialType::FB);

		$this->render('index',array(
			'social' => $social,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SocialNetwork('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SocialNetwork']))
			$model->attributes=$_GET['SocialNetwork'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SocialNetwork the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SocialNetwork::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SocialNetwork $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='social-network-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
