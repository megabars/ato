<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Структура исполнительных органов государственной власти Томской области';

$this->breadcrumbs = array(
    'Органы власти'=>'#',
    'Исполнительные органы государственной власти'=>'/people/front/government',
    'Структура исполнительных органов государственной власти Томской области'
);
?>

<div class="wrap">
    <h2>Структура исполнительных органов государственной власти Томской области</h2>

    <h3>Администрация Томской области</h3>
    <div class="collapses">
        <div class="item">
            <div class="title">
                <div class="name">Заместители Губернатора Томской области</div>
                <div class="toggle"></div>
            </div>
            <div class="desc">
                <div class="list-links">
                    <ul>
                        <?php
                        if($model)
                        foreach($model as $m){?>
                            <li><a href="<?php echo (!empty($m->contact_site)?$m->contact_site:'/people/front/view/id/'.$m->id.'/from/structure')?>"><?php echo $m->getTypeLabel()?></a></li>
                        <?php }  ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        foreach(People::getTypeGroupLabels(People::POWER) as $k=>$p){?>
            <div class="item">
                <div class="title">
                    <div class="name"><?php echo @$p?></div>
                    <div class="toggle"></div>
                </div>
                <div class="desc">
                    <div class="list-links">
                        <ul>
                            <?php
                            if(!empty($power[$k]['models']))
                                foreach($power[$k]['models'] as $m){?>
                                    <li><a href="<?php echo (!empty($m->contact_site)?$m->contact_site:'/people/front/view/id/'.$m->id.'/from/structure')?>"><?php echo $m->url?></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <h3 class="mt30">Иные органы власти</h3>
    <div class="collapses">
        <?php foreach(People::getTypeGroupLabels(People::OTHER_POWER) as $k=>$p){?>
            <div class="item">
                <div class="title">
                    <div class="name"><?php echo @$p?></div>
                    <div class="toggle"></div>
                </div>
                <div class="desc">
                    <div class="list-links">
                        <ul>
                            <?php
                            if(!empty($power[$k]['models']))
                                foreach($power[$k]['models'] as $m){?>
                                    <li><a href="<?php echo (!empty($m->contact_site)?$m->contact_site:'/people/front/view/id/'.$m->id.'/from/structure')?>"><?php echo $m->url?></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

