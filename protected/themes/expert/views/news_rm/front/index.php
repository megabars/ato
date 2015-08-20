<?php
/**
 * @var $this Controller
 * @var $records News[]
 */

$this->pageTitle = 'Новости';

//$this->breadcrumbs = array(
//    'Новости'
//);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>

    <div class="select-filter">

        <form method="get">
            <div class="grid-search">
                <div class="search-min clearfix">
                    <button type="submit" class="btn-default" id="searchBtn">Искать</button>
                    <div>
                        <input type="text" name="search" id="search" value="<?php echo $search?>">
                    </div>
                </div>
            </div>

            <a href="<?php echo $this->createUrl('/news/front/subscribe'); ?>" class="fancy fr">Подписаться</a>

            Выбрать период
            <div class="horisontal-row">
                <div class="label">с</div>
                <input id="dateBegin" type="text" name="dateBegin" value="<?php echo $dateBegin ?>"/>
            </div>
            <div class="horisontal-row">
                <div class="label">по</div>
                <input id="dateEnd" type="text" name="dateEnd" value="<?php echo $dateEnd ?>"/>
            </div>
        </form>
    </div>

    <ul class="news_list">
        <?php if($records): ?>
            <?php foreach ($records as $key => $item): ?>
                <?php  if($key % 2 == 0):?>
                    <li>
                <?php endif; ?>
                <div>
                    <?php  if($item->getSmallUrl('photo')):?>
                        <img src="<?php echo ($item->photo)? $item->getSmallUrl('photo') : $this->assetsBase.'/images/image.png'; ?>" />
                    <?php endif; ?>

                    <h3>
                        <a href="<?php echo $this->createUrl("/news/front/view/", array('id' => $item->id)); ?>">
                            <?php echo $item->title; ?>
                        </a>
                    </h3>
                    <p class="date"><?php echo Rudate::date(date('d F, H:i', strtotime($item->date))); ?></p>
                    <div><?php echo strip_tags($item->preview); ?></div>
                    <?php
                    if ($item->url !== null && !empty($item->url->meta_keywods))
                        echo '<div class="hash-tag">Ключевые слова: '.$item->url->meta_keywods.'</div>';
                    ?>
                </div>
                <?php  if(count($records) % 2 == 1 && $key == count($records)-1):?>
                    <div></div>
                <?php endif; ?>
                <?php  if($key % 2 == 1 || $key == count($records)-1):?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <?php $this->widget('application.widgets.customPager', array('pages' => $pages)); ?>
</div>

<script>
    $(function() {
        $("#dateBegin, #dateEnd").datepicker({
            dateFormat: 'dd.mm.yy',
            onSelect: function(date) {
                if($("#dateBegin").val() != "" && $("#dateEnd").val() != "") {
                    window.location.href= '?dateBegin='+$("#dateBegin").val()+'&dateEnd='+$("#dateEnd").val()+'&search='+encodeURIComponent($("#search").val())
                }
            }
        });
    });
</script>

