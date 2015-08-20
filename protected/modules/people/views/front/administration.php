<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Структура исполнительных органов государственной власти Томской области в разрезе курирующих заместителей Губернатора Томской области';

$this->breadcrumbs = array(
    'Органы власти'=>'#',
    'Исполнительные органы государственной власти'=>'/people/front/government',
    'Структура исполнительных органов государственной власти Томской области в разрезе курирующих заместителей Губернатора Томской области'
);
?>

<div class="wrap">
    <h2>Структура исполнительных органов государственной власти Томской области в разрезе курирующих заместителей Губернатора Томской области</h2>

    <div class="tree">
        <div id="organization_structure">
            <ul class="first no_need_links">
                <?php if($administration){?>
                <li class="first_item">
                    <div class="node superior ">
                        <div class="title">
                            <a href="/people/front/view/id/<?php echo $administration->id?>/from/administration"><?php echo @People::getTypeLabels($administration->type)?></a>
                        </div>
                        <img height="234" src="<?php echo $administration->getImageUrl('photo')?>" width="178">

                        <div class="fio"><?php echo $administration->full_name?></div>
                    </div>

                    <ul class="second">
                    <?php
                        if($models)
                            $total = count($models);
                            $counter = 0;

                            foreach($models as $zam){
                                $counter++;?>
                        <li class="second_item <?php echo ($counter == $total)? '': '' ?>">
                            <div class="node superior ">
                                <div class="title">
                                    <a href="/people/front/view/id/<?php echo $zam->id?>/from/administration"><?php echo @People::getTypeLabels($zam->type)?></a>
                                </div>
                                <img height="234" src="<?php echo $zam->getImageUrl('photo')?>" width="178">
                                <div class="fio"><?php echo $zam->full_name?></div>
                            </div>

                                    <?php if($zam->unit){?>
                                    <ul class="third">
                                        <?php foreach($zam->unit as $unitz){?>
                                            <li class="third_item">
                                                <div class="node subdivision">
                                                    <?php echo CHtml::link($unitz->name,$unitz->url)?>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                            </li>
                            <?php } ?>

                        <?php if($administration->unit)
                        foreach($administration->unit as $unit){?>
                            <li class="second_item no_margin">
                                <div class="node subdivision">
                                    <?php echo CHtml::link($unit->name,$unit->url)?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>


