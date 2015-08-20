<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Staff('search');

        $model->unsetAttributes();

        if (isset($_GET['Staff']))
        {
            $model->attributes = $_GET['Staff'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Staff();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Staff']))
        {
            $model->attributes = $_POST['Staff'];

            $this->setModelDataByXLS($model);

            if ($model->save())
            {
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Staff']))
        {
            $model->attributes = $_POST['Staff'];

            $this->setModelDataByXLS($model);

            if ($model->save())
            {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/staff/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Staff::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Staff::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'staff-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    /**
     * Функция сохранения параметров из XLS файла
     * @param $model
     */
    private function setModelDataByXLS(&$model)
    {
        if ($model->file)
        {
            $file = File::model()->getFilePath($model->file);

            spl_autoload_unregister(array('YiiBase', 'autoload'));
            Yii::import("staff.libraries.phpexel.Classes.PHPExcel", true);
            spl_autoload_register(array('YiiBase', 'autoload'));

            $file = PHPExcel_IOFactory::load($file);
            $sheet = $file->setActiveSheetIndex(0);

            $model->title               = $sheet->getCellByColumnAndRow(1, 1)->getValue();

            $model->knowledge           = $sheet->getCellByColumnAndRow(1, 15)->getValue();
            $model->skill               = $sheet->getCellByColumnAndRow(1, 16)->getValue();
            $model->amount_min          = $sheet->getCellByColumnAndRow(1, 17)->getValue();
            $model->amount_max          = $sheet->getCellByColumnAndRow(1, 18)->getValue();
            $model->contract            = $sheet->getCellByColumnAndRow(1, 19)->getValue();
            $model->additional          = $sheet->getCellByColumnAndRow(1, 20)->getValue();
            $model->acts                = $sheet->getCellByColumnAndRow(1, 21)->getValue();
            $model->documents           = $sheet->getCellByColumnAndRow(1, 22)->getValue();

            if ($sheet->getCellByColumnAndRow(0, 2)->getValue() == 'Вид конкурса')
            {
                $model->type = 1;

                $model->contest_type        = ContestType::instance()->asIndex($sheet->getCellByColumnAndRow(1, 2)->getValue());

                // С датами какая-то проблема....
                $model->date                = $this->changeDate($sheet->getCellByColumnAndRow(1, 3)->getFormattedValue());
                $model->date_actual         = $this->changeDate($sheet->getCellByColumnAndRow(1, 4)->getFormattedValue());

                $model->organization        = $sheet->getCellByColumnAndRow(1, 5)->getValue();
                $model->group               = $sheet->getCellByColumnAndRow(1, 6)->getValue();
                $model->category            = $sheet->getCellByColumnAndRow(1, 7)->getValue();
                $model->responsibility      = $sheet->getCellByColumnAndRow(1, 8)->getValue();
                $model->education_level     = $sheet->getCellByColumnAndRow(1, 10)->getValue();
                $model->education_direction = $sheet->getCellByColumnAndRow(1, 11)->getValue();
                $model->expirience          = implode(', ', array(
                    $sheet->getCellByColumnAndRow(1, 12)->getValue() . ' - ' . $sheet->getCellByColumnAndRow(7, 12)->getValue(),
                    $sheet->getCellByColumnAndRow(1, 13)->getValue() . ' - ' . $sheet->getCellByColumnAndRow(7, 13)->getValue(),
                    $sheet->getCellByColumnAndRow(1, 14)->getValue() . ' - ' . $sheet->getCellByColumnAndRow(7, 14)->getValue(),
                ));

                $model->contact             = $sheet->getCellByColumnAndRow(1, 23)->getValue();
                $model->contest_result      = $sheet->getCellByColumnAndRow(1, 24)->getValue();
            }
            else
            {
                $model->type = 2;

                $model->org_address         = $sheet->getCellByColumnAndRow(1, 2)->getValue();
                $model->contest_type        = ContestType::instance()->asIndex($sheet->getCellByColumnAndRow(1, 3)->getValue());

                // С датами какая-то проблема....
                $model->date                = $this->changeDate($sheet->getCellByColumnAndRow(1, 4)->getFormattedValue());
                $model->date_actual         = $this->changeDate($sheet->getCellByColumnAndRow(1, 5)->getFormattedValue());

                $model->doc_address         = $sheet->getCellByColumnAndRow(1, 6)->getValue();
                $model->organization        = $sheet->getCellByColumnAndRow(1, 7)->getValue();
                $model->org_characteristic  = $sheet->getCellByColumnAndRow(1, 8)->getValue();
                $model->labor_condition     = $sheet->getCellByColumnAndRow(1, 9)->getValue();
                $model->responsibility      = $sheet->getCellByColumnAndRow(1, 10)->getValue();
                $model->education_level     = $sheet->getCellByColumnAndRow(1, 12)->getValue();
                $model->education_direction = $sheet->getCellByColumnAndRow(1, 13)->getValue();
                $model->expirience          = $sheet->getCellByColumnAndRow(1, 14)->getValue();

                $model->contest_date        = $sheet->getCellByColumnAndRow(1, 23)->getValue();
                $model->contact             = $sheet->getCellByColumnAndRow(1, 24)->getValue();
                $model->paper               = $sheet->getCellByColumnAndRow(1, 25)->getValue();
                $model->contest_result      = $sheet->getCellByColumnAndRow(1, 26)->getValue();
            }
        }
    }

    private function changeDate($sheetValue)
    {
        if ($time = strtotime($sheetValue))
            return $time;
//        if ($time = strtotime($sheetValue[0] . $sheetValue[1] . '-' . $sheetValue[3] . $sheetValue[4] . '-20' . $sheetValue[8] . $sheetValue[9]))
//            return $time;

        return time();
    }
}