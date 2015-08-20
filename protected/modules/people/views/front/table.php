<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;

?>

<div class="wrap">
    <h3><?php echo $this->pageTitle?></h3><br/>

    <table class="table">
        <thead>
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th><a class="sort-link" href="#">Тип</a></th>
            <th>Руководитель</th>
            <th>Контакты</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        if(!empty($models))
            foreach($models as $m){?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><a href="<?php echo (!empty($m->contact_site)?$m->contact_site:'/people/front/view/id/'.$m->id)?>"><?php echo $m->main_info?></a></td>
                    <td><?php echo People::getTypeLabels($m->type)?></td>
                    <td><?php echo $m->full_name?></td>
                    <td>
                        <?php if(!empty($m->contact_address)){?>
                            <div><b>Адрес: </b><?php echo $m->contact_address?></div>
                        <?php } ?>
                        <?php if(!empty($m->contact_phone)){?>
                            <div><b>Телефон: </b><?php echo $m->contact_phone?></div>
                        <?php } ?>
                        <?php if(!empty($m->contact_site)){?>
                            <div><b>Сайт: </b><a href="<?php echo $m->contact_site; ?>"><?php echo $m->contact_site; ?></a></div>
                        <?php } ?>
                        <?php if(!empty($m->contact_email)){?>
                            <div><b>E-mail: </b> <a href="mailto:<?php echo $m->contact_email; ?>"><?php echo $m->contact_email; ?></a></div>
                        <?php } ?>
                    </td>
                </tr>
        <?php $i++;
            } ?>


        </tbody>
    </table>
</div>

<style type="text/css">
    b {
        font-weight: bold;
    }
</style>