<?php

class OpenregionController extends Controller
{
    /* Открытый регион */

    /* Открытый регион - Оценка регулирующего воздействия и экспертиза нпа */
    public function actionRating()
    {
        $docs = new Documents();

        $this->render('rating',array(
            'list' => $docs->sorted()->published(),
        ));
    }


    /* Открытый регион - Госзакупки */
    public function actionPurchase()
    {
        $this->render('purchase');
    }

}