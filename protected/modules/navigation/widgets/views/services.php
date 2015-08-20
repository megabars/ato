<?php
/**
 * @var $records NavItems[]
 */
?>

<?php if (count($records)) : ?>
    <ul class="clearfix">
        <?php foreach ($records as $record) : ?>
            <?php
//            if ($record->title == 'Кадровая политика')
//                $url = Portal::model()->findByPk(1)->createAbsoluteAddress(Yii::app()->createUrl('/staff/front', array('Staff[portal_id]' => Yii::app()->controller->portalId)));
            if ($record->title == 'Открытые данные')
                $url = Portal::model()->findByPk(1)->createAbsoluteAddress(Yii::app()->createUrl('/opendata/front', array('portal_id' =>  Yii::app()->controller->portalId)));
            else
                $url = @$record->url->url;


            $linkClass = '';

            if ($record->url == '/feedback/front/index')
                $linkClass = 'fancy';

            ?>

            <li>
                <a class="item <?php echo $linkClass?>" target="_blank" href="<?php echo $url; ?>">
                    <span>
                        <span class="image">
                            <img src="<?php echo Yii::app()->controller->getAssetsBase(); ?>/images/icon/<?php echo @$this->possibleNames[$record->title]; ?>.png"/>
                        </span>
                        <span class="label">
                            <span><?php echo $record->title; ?></span>
                        </span>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>