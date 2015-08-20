<?php

class ContestsController extends Controller
{
    /* Конкурсы */
    public function actionIndex()
    {
        $this->render('index');
    }
    public function actionArchive()
    {
        $this->render('archive');
    }
    public function actionResults()
    {
        $this->render('results');
    }

    public function actionView()
    {
        $this->render('view');
    }

}