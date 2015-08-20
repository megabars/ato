<?php
/** @var $this Controller */

$assets = $this->getAssetsBase();

$this->pageTitle = 'Главная';
?>


<div class="wrap">

    <div class="iogv-header">

        <div class="right-content">
            <?php
            $addClass = 'full';

            if (NavItems::model()->with('menu')->count("menu.alias = 'right_menu' and t.state = 1 and menu.published = 1") !== 0):
                $addClass = '';
            ?>

            <div class="iogv-menu">
                <div class="title"><?php echo Yii::t('app', 'Актуальное')?></div>
                <?php
                $this->widget('navigation.widgets.menuByAlias', array(
                    'parentId' => $this->navigationItemId,
                    'menu_alias' => 'right_menu',
                    'max_levels' => 0
                )); ?>
            </div>
            <?php endif; ?>

            <div class="vote">
                <?php $this->widget('application.modules.vote.widgets.vote.VoteWidget'); ?>
            </div>

            <?php if ($mainPage !== null && isset($mainPage->info_thread) && $mainPage->info_thread == 1): ?>
                <?php $addClass = ''; ?>
                <div class="infopotok">
                    <!--Begin OpenGov Infostream-widget code-->
                    <script src="http://bigovernment.ru/twinvest/api/widget/infopotok/script.js"
                            type="text/javascript"></script>
                    <div id="bg-infopotok-widget-container" data-width="220" data-height="425"><img
                            src="http://bigovernment.ru/twinvest/api/widget/loading.gif"/></div>
                    <!--End of OpenGov Infostream-widget code-->
                </div>
            <?php endif; ?>

        </div>

        <div class="portal-info">
            <h2><?php echo Yii::t('app', 'Общие сведения')?></h2>
            <?php echo ($mainPage !== null) ? $mainPage->description : ''; ?>
        </div>

        <?php if ($this->contact !== null): ?>
        <div class="contact-info clearfix">
            <?php if ($this->contact->photo): ?>
            <div class="image">
                <img src="<?php echo $this->contact->getMediumUrl('photo'); ?>"/>
            </div>
            <?php endif; ?>
            <div class="desc">
                <div class="title"><?php echo Yii::t('app', 'Контакты')?></div>

                <?php if ($this->contact !== null && !empty($this->contact->address)): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Адрес:')?></span> <p><?php echo @$this->contact->address; ?></p>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->phone) && is_array($this->contact->phone) && count($this->contact->phone) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Телефон:')?></span>
                        <?php $phoneText = '';
                        foreach($this->contact->phone as $phone)
                            $phoneText .= '<a href="tel:'.$phone->value.'">'.$phone->value.'</a>, ';
                        echo '<p>'.trim($phoneText, ', ').'</p>';
                        ?>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->fax) && is_array($this->contact->fax) && count($this->contact->fax) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Факс:')?></span>
                        <?php $faxText = '';
                        foreach($this->contact->fax as $fax)
                            $faxText .= '<a href="tel:'.$fax->value.'">'.$fax->value.'</a>, ';
                        echo '<p>'.trim($faxText, ', ').'</p>'; ?>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->web) && is_array($this->contact->web) && count($this->contact->web) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Дополнительный адрес:')?></span>
                        <?php
                        $webText = '';
                        foreach($this->contact->web as $web)
                            $webText .= '<a href="'.$web->value.'">'.$web->value.'</a>, ';
                        echo '<p>'.trim($webText, ', ').'</p>'; ?>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->email) && is_array($this->contact->email) && count($this->contact->email) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Электронная почта:')?></span>
                        <?php $emailText = array();
                        foreach($this->contact->email as $email)
                            $emailText[] = '<a href="mailto:'.$email->value.'">'.$email->value.'</a><br/>';

                        echo '<div class="mail-list">'.implode($emailText).'</div>';
                        ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="clearfix">

        <div class="left-content <?php echo $addClass; ?>">
            <div class="media">
                <?php
                Yii::app()->clientScript->scriptMap=array('jquery-ui.css'=>false);
                // переключатель с инфой
                $this->widget('zii.widgets.jui.CJuiTabs',array(
                    'tabs'=> array(
                        Yii::t('app', 'Новости') => $this->widget('zii.widgets.CListView', array(
                                'dataProvider'=> $news,
                                'itemsTagName'=>'ul',
                                'htmlOptions'=>array(
                                    'class'=>'last-news'
                                ),
                                'itemView'=>'application.themes.tomsk.views.main._news',
                            ), true).'<div class="foot clearfix"><a href="" class="fl">'.Yii::t('app', 'Подписаться').'</a><a href="/news/front" class="fr">'.Yii::t('app', 'Все новости').'</a></div>',

                        Yii::t('app', 'Календарь мероприятий') => $this->widget('application.modules.afisha.widgets.LatestEventsWidget', array(
                            'limit' => 2,
                        ), true),
                    ),
                    // additional javascript options for the tabs plugin
                    'options'=>array(
                        'collapsible'=>true,
                    ),
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="block-link-custom">
        <?php $this->widget('navigation.widgets.servicesWidget'); ?>
    </div>

    <h2 class="no-padding-bottom"><?php echo Yii::t('app', 'Полезные ресурсы')?></h2>
    <?php $this->widget('application.modules.links.widgets.LinksWidget'); ?>
</div>







