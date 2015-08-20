<script>
	$(function () {
		$('.pagination a').click(function () {
			$('.pagination a').parent().removeClass('active');
			$(this).parent().addClass('active');
			$('ul[id^=list-]').hide();
			$('#list-' + $(this).data('id')).show();
			return false;
		})
	});
</script>

<?php

$assets = $this->getAssetsBase();
$this->pageTitle = Yii::t('app', 'Поиск');

$this->breadcrumbs = array(
    Yii::t('app', 'Поиск'),
);
?>

<div class="wrap search-page">
	<h2><?php echo Yii::t('app', 'Поиск'); ?></h2>

	<div class="grid-search">
        <div class="text-right"><a href="" id="toggle-search"><?php echo Yii::t('app', 'расширенный поиск'); ?></a></div>

        <form action="<?php echo $this->createUrl('/search/default/index'); ?>" name="search-form" method="get">
            <div class="search-min clearfix">
                <button type="submit" class="btn-default"><?php echo Yii::t('app', 'Искать'); ?></button>
                <div class="input">
                    <input type="text" name="query" placeholder="" value="<?php echo $query; ?>">
                </div>
            </div>

        <div class="search-max">
            <div class="row">
                <label><?php echo Yii::t('app', 'Введите запрос'); ?></label>
                <input type="text" placeholder="<?php echo Yii::t('app', 'Введите запрос'); ?>" value="<?php echo $query; ?>" />
            </div>
            <button type="submit" class="fr btn-default"><?php echo Yii::t('app', 'Искать'); ?></button>
            <div class="row input-group">
                <div class="row">
                    <label><?php echo Yii::t('app', 'Логика поиска'); ?></label>
                    <select class="select" name="logic">
                        <option value="0" <?php echo ($logic == 0) ? "selected='selected'" : '' ?>><?php echo Yii::t('app', 'Все слова запроса'); ?></option>
                        <option value="1" <?php echo ($logic == 1) ? "selected='selected'" : '' ?>><?php echo Yii::t('app', 'Любое слово запроса'); ?></option>
                        <option value="2" <?php echo ($logic == 2) ? "selected='selected'" : '' ?>><?php echo Yii::t('app', 'Точное совпадение фразы'); ?></option>
                    </select>
                </div>
<!--                <div class="row">-->
<!--                    <label>--><?php //echo Yii::t('app', 'Раздел поиска'); ?><!--</label>-->
<!--                    <select class="select">-->
<!--                        <option value="">--><?php //echo Yii::t('app', 'Везде'); ?><!--</option>-->
<!--                        <option value="">--><?php //echo Yii::t('app', 'не везде'); ?><!--</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <label>--><?php //echo Yii::t('app', 'Период поиска'); ?><!--</label>-->
<!--                    <select class="select">-->
<!--                        <option value="">--><?php //echo Yii::t('app', 'Везде'); ?><!--</option>-->
<!--                        <option value="">--><?php //echo Yii::t('app', 'не везде'); ?><!--</option>-->
<!--                    </select>-->
<!--                </div>-->
            </div>
        </div>
        </form>
	</div>

	<div class="result">
		<div><?php echo Yii::t('app', 'Результат поиска'); ?></div>
        <?php echo Yii::t('app', 'найдено:'); ?> <?php echo $totalCount; ?>
	</div>

    <?php if (count($mainProvider->getData())) : ?>
        <h3><?php echo Yii::t('app', 'Текущий портал'); ?> (<?php echo $mainPages->getItemCount(); ?>)</h3>

        <ul class="search-result">
            <?php foreach ($mainProvider->getData() as $index => $item): ?>
                <li>
                    <span class="numb">
                        <?php echo ($index + 1); ?>
                    </span>

                    <div class="date">
                        <?php echo $item['title']; ?>
                    </div>

                    <a class="title" href="<?php echo $item['url']; ?>" target="_blank">
                        <?php echo $item['url']; ?>
                    </a>

                    <div class="text">
                        <?php echo $item['text']; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php $this->widget('application.widgets.customPager', array('pages' => $mainPages)); ?>
    <?php endif; ?>



    <?php if (count($othersProvider->getData())) : ?>
        <h3><?php echo Yii::t('app', 'Другие порталы'); ?> (<?php echo $othersPages->getItemCount(); ?>)</h3>

        <ul class="search-result">
            <?php foreach ($othersProvider->getData() as $index => $item): ?>
                <li>
                    <span class="numb">
                        <?php echo ($index + 1); ?>
                    </span>

                    <div class="date">
                        <?php echo $item['title']; ?>
                    </div>

                    <a class="title" href="<?php echo $item['url']; ?>" target="_blank">
                        <?php echo $item['url']; ?>
                    </a>

                    <div class="text">
                        <?php echo $item['text']; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php $this->widget('application.widgets.customPager', array('pages' => $othersPages)); ?>
    <?php endif; ?>
</div>