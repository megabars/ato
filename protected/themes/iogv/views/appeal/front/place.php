<?php
/**
 * @var $this Controller
 * @var $items AppealPlace
 * @var $this->contact Contact
 */
$assets = $this->getAssetsBase();

$this->pageTitle = 'Место, время и порядок приема';

$this->breadcrumbs = array(
    'Обращения граждан',
    $this->pageTitle
); ?>

<div class="wrap">
    <div class="clearfix">
        <?php $this->renderPartial('_menu') ?>

        <div class="left-content">
            <h2>Обращения граждан</h2>
            <h3><?php echo $this->pageTitle; ?></h3>
            <?php if(isset($this->contact) && ($this->contact !== null)): ?>
            <div class="contact-info type2 clearfix">
                <?php if(isset($this->contact->photo)): ?>
                <div class="image">
                    <img src="<?php echo $this->contact->getMediumUrl('photo'); ?>"/>
                </div>
                <?php endif; ?>
                <div class="desc">
                    <div class="title"><p><?php echo @$this->contact->executive->name; ?></p></div>

                    <?php if(!empty($this->contact->address)): ?>
                    <div class="row">
                        <span class="label">Адрес:</span> <?php echo $this->contact->address; ?>
                        <span class="show-maps fancybox-maps"></span>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($this->contact->phone)): ?>
                    <div class="row">
                        <span class="label">Телефон:</span>
                        <?php $phoneText = '';
                        foreach($this->contact->phone as $phone)
                            $phoneText .= '<a href="tel:'.$phone->value.'">'.$phone->value.'</a>, ';
                        echo trim($phoneText, ', '); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($this->contact->fax)): ?>
                    <div class="row">
                        <span class="label">Факс:</span>
                        <?php $faxText = '';
                        foreach($this->contact->fax as $fax)
                            $faxText .= '<a href="tel:'.$fax->value.'">'.$fax->value.'</a>, ';
                        echo trim($faxText, ', '); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($this->contact->email)): ?>
                    <div class="row">
                        <span class="label">E-mail:</span>
                        <div class="mail-list">
                            <?php $emailText = '';
                            foreach($this->contact->email as $email)
                                $emailText .= '<a href="mailto:'.$email->value.'">'.$email->value.'</a>, ';
                            echo trim($emailText, ', '); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($this->contact->hotline)): ?>
                    <div class="row">
                        <span class="label">Телефон "горячей линии":</span>
                        <?php $hotlineText = '';
                        foreach($this->contact->hotline as $hotline)
                            $hotlineText .= '<a href="tel:'.$hotline->value.'">'.$hotline->value.'</a>, ';
                        echo trim($hotlineText, ', '); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($this->contact->driving_directions)): ?>
                    <div class="row">
                        <span class="label">Как добраться:</span> <?php echo $this->contact->driving_directions; ?>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($this->contact->description)): ?>
                    <div class="row">
                        <?php echo $this->contact->description; ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php endif; ?>

            <div class="collapses">
                <?php foreach($items as $item): ?>
                <div class="item">
                    <div class="title">
                        <div class="name"><?php echo $item->department; ?></div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">
                        <div class="contact-info type2 clearfix">
                            <div class="desc">
                                <?php if(isset($item->address)): ?>
                                <div class="row">
                                    <span class="label">Адрес:</span> <?php echo $item->address; ?>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($item->time)): ?>
                                <div class="row">
                                    <span class="label">Время работы:</span><?php echo $item->time; ?>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($item->head)): ?>
                                <div class="row">
                                    <span class="label">Начальник отдела:</span> <?php echo $item->head; ?>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($item->phone)): ?>
                                <div class="row">
                                    <span class="label">Телефон:</span><a href="tel:<?php echo $item->phone; ?>"><?php echo $item->phone; ?></a>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($item->description)): ?>
                                <div class="row">
                                    <?php echo $item->description; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>


        </div>
    </div>
</div>