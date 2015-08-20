<div class="footer">
    <div class="wrap">
        <div class="right">
            <a href="http://orphus.ru" id="orphus" target="_blank">
                <?php $src = (Yii::app()->language == 'en') ? 'mistake' : (Yii::app()->language == 'de' ? 'fehler' : 'orphus'); ?>
                <img alt="Система Orphus" src="<?php echo $this->getAssetsBase(); ?>/images/<?php echo $src; ?>.png" border="0" />
            </a><br/>
            <div class="social">
                <div style="display: none">
                    <?php $this->widget('counters.widgets.CountersWidget'); ?>
                </div>
                <div class="label"><?php echo Yii::t('app', 'Социальные сети:')?></div>
                <?php Yii::app()->getModule('social') ?>
                <?php if ($link_vk = SocialNetwork::getLinkByType(SocialType::VK)): ?>
                    <a href="<?php echo $link_vk; ?>" target="_blank" class="social-vk"></a>
                <?php endif; ?>
                <?php if ($link_tw = SocialNetwork::getLinkByType(SocialType::TWITTER)): ?>
                    <a href="<?php echo $link_tw; ?>" target="_blank" class="social-tw"></a>
                <?php endif; ?>
                <?php if ($link_fb = SocialNetwork::getLinkByType(SocialType::FB)): ?>
                    <a href="<?php echo $link_fb; ?>" target="_blank" class="social-fb"></a>
                <?php endif; ?>
            </div>
            <div class="link">
                <a href="<?php echo $this->createUrl('/main/siteMap'); ?>" class="footer-map"><?php echo Yii::t('app', 'Карта сайта')?></a>
                <a href="<?php echo $this->createUrl('/feedback/front/index'); ?>" class="footer-feedback fancy"><?php echo Yii::t('app', 'Обратная связь')?></a>
                <a href="<?php echo $this->createUrl('/feedback/front/hotlines'); ?>" class="footer-hot"><?php echo Yii::t('app', 'Горячие линии')?></a>
            </div>
<!--            <div class="copyright">&nbsp;</div>-->
        </div>
        <?php if ($this->contact !== null): ?>
        <div class="left">
            <div class="title"><?php echo Yii::t('app', 'Контактная информация')?></div>
            <div class="desc">
                <p><?php echo @$this->contact->executive->name; ?></p>

                <?php if (isset($this->contact->address)) : ?>
                    <p><?php echo @$this->contact->address; ?>
                        <?php if ($this->portalId == 1) : ?>
                            <span class="show-maps fancybox-maps"></span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>


                <?php if (isset($this->contact->phone) && is_array($this->contact->phone) && count($this->contact->phone) > 0): ?>
                    <p><?php echo Yii::t('app', 'Тел:')?>
                        <?php $phoneText = '';
                        foreach($this->contact->phone as $phone)
                            $phoneText .= '<a href="tel:'.$phone->value.'">'.$phone->value.'</a>, ';
                        echo trim($phoneText, ', '); ?>
                    </p>
                <?php endif; ?>

                <?php if (isset($this->contact->fax) && is_array($this->contact->fax) && count($this->contact->fax) > 0): ?>
                    <p><?php echo Yii::t('app', 'Факс:')?>
                        <?php $faxText = '';
                        foreach($this->contact->fax as $fax)
                            $faxText .= '<a href="tel:'.$fax->value.'">'.$fax->value.'</a>, ';
                        echo trim($faxText, ', '); ?>
                    </p>
                <?php endif; ?>

                <?php if (isset($this->contact->web) && is_array($this->contact->web) && count($this->contact->web) > 0): ?>
                    <p><?php echo Yii::t('app', 'Дополнительный адрес:')?>
                        <?php
                        $webText = '';
                        foreach($this->contact->web as $web)
                            $webText .= '<a href="'.$web->value.'">'.$web->value.'</a>, ';
                        echo trim($webText, ', '); ?>
                    </p>
                <?php endif; ?>

                <?php if (isset($this->contact->email) && is_array($this->contact->email) && count($this->contact->email) > 0): ?>
                    <p><?php echo Yii::t('app', 'Электронная почта:')?>
                        <?php $emailText = '';
                        foreach($this->contact->email as $email)
                            $emailText .= '<a href="mailto:'.$email->value.'">'.$email->value.'</a>, ';
                        echo trim($emailText, ', '); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>