<?php

/**
 * Class independentEvaluationModule
 */
class IndependentEvaluationModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'application.modules.independentEvaluation.enums.*',
            'application.modules.independentEvaluation.models.*',
            'application.modules.independentEvaluation.components.*',
        ));
    }
}
