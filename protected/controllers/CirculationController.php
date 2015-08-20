<?php

class CirculationController extends Controller
{
    public $mainPage = true;

    public function actionIndex()
    {
        $this->render('index');
    }
}