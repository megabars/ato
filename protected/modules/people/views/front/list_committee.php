<div class="wrap">
    <h3><?php echo $this->pageTitle?></h3>

    <?php
    if($models)
    foreach($models as $model){?>
    <div class="collapses">
        <div class="item">
            <div class="title">
                <div class="name"><?php echo $model->main_info?></div>
                <div class="toggle"></div>
            </div>
            <div class="desc">
                <div class="people">
                    <ul class="people-list">
                        <?php
                        if($model->staff)
                            foreach($model->staff as $staff)
                            {
                                if(in_array($model->type,array_merge(array_keys(People::getTypeGroupLabels(People::LAW)),array(People::TYPE_DUMA))) and !empty($staff->unit_id))
                                    continue;
                                ?>
                                <li>
                                    <?php if(file_exists($staff->getImagePath('photo')) and !is_dir($staff->getImagePath('photo'))){?>
                                        <a href="" class="image">
                                            <img src="<?php echo $staff->getImageUrl('photo'); ?>"/>
                                        </a>
                                    <?php } ?>
                                    <div class="desc">
                                        <span style="color: #2995B2;"><?php echo $staff->full_name;?></span>
                                        <div class="post"><?php echo $staff->job;?></div>

                                        <ul>
                                            <?php if(!empty($staff->cabinet)): ?>
                                                <li><b>Кабинет:</b><?php echo $staff->cabinet;?></li>
                                            <?php endif; ?>
                                            <?php if(!empty($staff->contact_phone)): ?>
                                                <li><b>Телефон:</b><?php echo $staff->contact_phone;?></li>
                                            <?php endif; ?>
                                            <?php if(!empty($staff->contact_fax)): ?>
                                                <li><b>Факс:</b><?php echo $staff->contact_fax;?></li>
                                            <?php endif; ?>
                                            <?php if(!empty($staff->contact_email)): ?>
                                                <li><b>E-mail:</b>
                                                    <a href="mailto:<?php echo $staff->contact_email; ?>"><?php echo $staff->contact_email; ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php }	?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php }  ?>
</div>