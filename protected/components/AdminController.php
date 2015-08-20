<?php

/**
 * Основной контроллер для админки, все контроллеры админки наследовать от него
 * Class AdminController
 */
class AdminController extends Controller
{
    public $pageTitle = 'Администрирование';

	public function init()
	{
        if (Yii::app()->user->isGuest && $this->route != 'user/login' && $this->route != 'user/recovery/recovery' && $this->route != 'user/recovery')
            $this->redirect($this->createUrl('/user/login'));

        parent::init();
        Yii::app()->theme = 'admin';
        $this->layout = '//layouts/main';

        $isAdmin = @User::model()->findByPk(Yii::app()->user->id)->superuser;

        $au = UsrAuthAssignment::model()->findByAttributes(array('userid' => (string)Yii::app()->user->id, 'itemname' => 'PortalAdmin'));
        if ($au !== null) {
            $data = json_decode($au->data);

            if (!$isAdmin && ($this->portalId != 1) && (!isset($data->portal_id) || ($data->portal_id != $this->portalId)))
                throw new CHttpException(403, 'Вы не авторизованы для выполнения этого действия');
        }
    }


}