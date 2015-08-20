<div class="left">
    <div class="image">
        <img style="max-width: 240px;height: auto" src="<?php
            if(empty($contact))
                echo ((file_exists($model->getImagePath('photo')) and !is_dir($model->getImagePath('photo')))?$model->getImageUrl('photo'):$this->getAssetsBase().'/images/person.jpg');
            else
                echo ((file_exists($model->getImagePath('contact_photo')) and !is_dir($model->getImagePath('contact_photo')))?$model->getImageUrl('contact_photo'):$this->getAssetsBase().'/images/government.png');?>"/>
    </div>
    <?php if(empty($lite)){?>
    <div class="name"  style="font-weight: bold;"><?php echo $model->full_name; ?></div>

    <ul>
        <?php if($model->type!=People::GOVERNOR){?>
            <?php if(!empty($model->job)){ ?>
            <li>
                <b style="font-weight: bold;">Должность:</b> <?php echo $model->job; ?>
            </li>
            <?php } ?>
        <?php } ?>
        <?php if(!empty($model->contact_address)){ ?>
        <li>
            <b style="font-weight: bold;">Адрес:</b> <?php echo $model->contact_address; ?>
        </li>
        <?php } ?>
        <?php if(!empty($model->contact_phone)){ ?>
        <li>
            <b style="font-weight: bold;">Телефон:</b> <?php echo $model->contact_phone; ?>
        </li>
        <?php } ?>
        <?php if(!empty($model->contact_fax)){ ?>
        <li>
            <b style="font-weight: bold;">Факс:</b> <?php echo $model->contact_fax; ?>
        </li>
        <?php } ?>
        <?php if(!empty($model->contact_site)){ ?>
        <li>
            <b style="font-weight: bold;">Сайт:</b> <a href="<?php echo $model->contact_site; ?>"><?php echo $model->contact_site; ?></a>
        </li>
        <?php } ?>
        <?php if(!empty($model->contact_email)){ ?>
        <li>
            <b style="font-weight: bold;">E-mail:</b> <a href="mailto:<?php echo $model->contact_email; ?>"><?php echo $model->contact_email; ?></a>
        </li>
        <?php } ?>
    </ul>

    <div class="social">
        <?php  if(!empty($model->social_vk)) : ?>
            <a class="vk" target="_blank" href="<?php echo $model->social_vk; ?>"></a>
        <?php endif; ?>
        <?php  if(!empty($model->social_tw)) : ?>
            <a class="tw" target="_blank" href="<?php echo $model->social_tw; ?>"></a>
        <?php endif; ?>
        <?php  if(!empty($model->social_fb)) : ?>
            <a class="fb" target="_blank" href="<?php echo $model->social_fb; ?>"></a>
        <?php endif; ?>
    </div>
    <?php } ?>
</div>