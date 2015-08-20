<?php

class FrontController extends Controller
{
    public function actionIndex()
    {
        $form1 = PublicReport::model()->sorted()->type(1)->find();
        $form2 = PublicReport::model()->sorted()->type(2)->find();

        $criteria = new CDbCriteria();
        $criteria->condition = "id != :id1 AND id != :id2";
        $criteria->params = array (
            ':id1' => $form1->id,
            ':id2' => $form2->id,
        );
        $archive = PublicReport::model()->sorted()->findAll($criteria);

        $this->render('index', array(
            'form1' => $form1,
            'form2' => $form2,
            'archive' => $archive,
        ));
    }
 }