<?php

class OpendataController extends Controller
{
    /* Открытые данные */

    public function actions()
    {
        return array(
            'captcha' => array(
                'class'     => 'CCaptchaAction',
                'backColor' => 0xe8e8e8,
                'foreColor' => 0x2d8d38,
                'testLimit' => 2,
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionView()
    {
        $this->render('view');
    }

    public function actionStatistic()
    {
        $this->render('statistic');
    }

    public function actionForm()
    {
        $model = new OpendataForm();

        $this->render('form',array(
            'model' => $model,
        ));
    }

}