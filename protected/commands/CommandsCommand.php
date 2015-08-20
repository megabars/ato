<?php
/**
 * Предлагаю все консольные манипулиции выполнять тут, чтоб не плодить команды
 */

class CommandsCommand extends CConsoleCommand {

    /**
     * На один url_id приходится несколько
     * @author mamatveev
     */
    public function actionStaticFix() {

        foreach (UrlManager::model()->findAll() as $url) {

            $attrs = array('url_id' => $url->id, 'portal_id' => $url->portal_id);

            if (StaticPage::model()->countByAttributes($attrs) > 1){

                $data = new StaticPage('console');
                $data = $data->findAllByAttributes($attrs);

                $portal = Portal::model()->findByPk($url->portal_id);

                echo "\n\n Page  http://{$portal->alias}/{$url->url}\n";
                foreach ($data as $item) {
                    $adminUrl = "http://{$portal->alias}/pages/back/update/type/{$item->type_id}/id/{$item->id}";

                    if ($item->description == '' or $item->description == 'Информация готовится к размещению.')
                        echo "empty content: {$adminUrl} is_deleted: {$item->is_deleted}\n";
                    else
                        echo "content: {$adminUrl} is_deleted: {$item->is_deleted}\n";
                }
            }
        }

    }

    public function actionModeratorImport(){
        $path = Yii::app()->basePath . '/data/moderators_list.csv';

        $fp = fopen($path,'r');
        $csv = array();

        while (($filePart = fgetcsv($fp, 0, ';')) !== false) {
            $csv[]=$filePart;
        }

        fclose($fp);
        array_shift($csv);

        foreach ($csv as $data) {

            if ($data[0] != '') {
                $departmentName = str_replace('Администрации Томской области', '', trim($data[0]));
                $departmentName = str_replace('Томской области', '', $departmentName);
            }

            $portal = Portal::model()->find("title like '%{$departmentName}%'");
            if ($portal === null) {
                echo "Cant found portal with title: {$departmentName}\n";
                continue;
            }

            $username = trim($data[4]);

//            if (User::model()->countByAttributes(array('username' => $username)) > 0)
//                continue;

            $user = new User;
            $profile = new Profile;

            $user->attributes = array(
                'username' => $username,
                'email' => $data[3]
            );

            $user->password = $user->generatePassword();
            $user->status = User::STATUS_ACTIVE;
            $user->superuser = 1;

            $name = explode(' ', $data[1]);

            $profile->attributes = array(
                'first_name' => @$name[0],
                'last_name' => @$name[1],
                'surname' => @$name[2],
                'phone' => preg_replace('/^8/i', '+7', $data[2]),
            );

            $profile->user_id = 0;

            if ($user->validate() && $profile->validate()) {

                $password = $user->password;

//                $user->password = Yii::app()->controller->module->encrypting($user->password);
                $user->password = Yii::app()->getModule('user')->encrypting($user->password);

                if ($user->save()) {
                    $profile->user_id = $user->id;
                    $profile->save();
                }

                $au = new UsrAuthAssignment();
                $au->itemname = "PortalAdmin";
                $au->userid = $user->id;
                $au->data = json_encode(array('portal_id' => $portal->id));
                if (!$au->save()) {
                    print_r($au->getErrors());
                    die;
                }

                echo "{$user->email};{$user->username};{$password};http://{$portal->alias}\n";



            } else {
                echo "Validation Errors\n";
                print_r($user->getErrors());
                print_r($user->attributes);
//                print_r($profile->getErrors());
            }
        }

    }
}