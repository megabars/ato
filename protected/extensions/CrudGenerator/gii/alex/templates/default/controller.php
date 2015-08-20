<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass . "\n"; ?>
{
    public function actionIndex()
    {
        $model = new <?php echo $this->modelClass; ?>('search');

        $model->unsetAttributes();

        if (isset($_GET['<?php echo $this->modelClass; ?>']))
            $model->attributes = $_GET['<?php echo $this->modelClass; ?>'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new <?php echo $this->modelClass; ?>;

        // $this->performAjaxValidation($model);

        if (isset($_POST['<?php echo $this->modelClass; ?>']))
        {
            $model->setAttributes($_POST['<?php echo $this->modelClass; ?>'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['<?php echo $this->modelClass; ?>']))
        {
            $model->setAttributes($_POST['<?php echo $this->modelClass; ?>'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/<?php echo strtolower($this->modelClass); ?>/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                <?php echo $this->modelClass; ?>::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = <?php echo $this->modelClass; ?>::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === '<?php echo strtolower($this->modelClass); ?>-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
