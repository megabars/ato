<?php
/**
 * @var $this Controller
 * @var $records News[]
 */

$this->pageTitle = 'Стенограммы';

//$this->breadcrumbs = array(
//    'Стенограммы'
//);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>


<!--    <table class="sub_menu">-->
<!--        <tbody>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <a href="--><?php //echo $this->createUrl('/news/front/index'); ?><!--">-->
<!--                        <span>Все новости</span>-->
<!--                    </a>-->
<!--                </td>-->
<!--                --><?php //foreach (NewsType::model()->findAll() as $index => $item) : ?>
<!--                    <td>-->
<!--                        <a href="--><?php //echo $this->createUrl('/news/front/index', array('type' => $item->id)); ?><!--">-->
<!--                            <span>--><?php //echo $item->title; ?><!--</span>-->
<!--                        </a>-->
<!--                    </td>-->
<!--                --><?php //endforeach; ?>
<!--            </tr>-->
<!--        </tbody>-->
<!--    </table>-->

    <div class="select-filter">
        Выбрать период
        <div class="horisontal-row">
            <div class="label">с</div>
            <input id="dateBegin" type="text" value="<?php echo @$_GET['dateBegin'] ?>"/>
        </div>
        <div class="horisontal-row">
            <div class="label">по</div>
            <input id="dateEnd" type="text" value="<?php echo @$_GET['dateEnd'] ?>"/>
        </div>
    </div>

    <ul class="news_list">
        <?php if($records): ?>
            <?php foreach ($records as $key => $item): ?>
                <?php  if($key % 2 == 0):?>
                    <li>
                <?php endif; ?>
                    <div>
                        <h3>
                            <a href="<?php echo $this->createUrl("/stenogramm/front/view/", array('id' => $item->id)); ?>">
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
                    window.location.href= '?dateBegin='+$("#dateBegin").val()+'&dateEnd='+$("#dateEnd").val()
                }
            }
        });
    });
</script>

