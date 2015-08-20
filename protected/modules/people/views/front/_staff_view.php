<?php
//if(!(in_array(@$data->people->type,array_merge(array_keys(People::getTypeGroupLabels(People::LAW)),array_keys(People::getTypeGroupLabels(People::POWER)),array(People::TYPE_DUMA))) and !empty($data->unit_id)))
if(empty($data->unit_id))
{
?>
<li>
    <?php if(file_exists($data->getSmallPath('photo')) and !is_dir($data->getSmallPath('photo'))){?>
        <a href="" class="image">
            <img src="<?php echo $data->getSmallUrl('photo'); ?>"/>
        </a>
    <?php } ?>
    <div class="desc">
        <span style="color: #2995B2;"><?php echo $data->full_name;?></span>
        <div class="post"><?php echo $data->job;?></div>

        <ul>
            <?php if(!empty($data->cabinet)): ?>
                <li><b>Кабинет:</b><?php echo $data->cabinet;?></li>
            <?php endif; ?>
            <?php if(!empty($data->contact_phone)): ?>
                <li><b>Телефон:</b><?php echo $data->contact_phone;?></li>
            <?php endif; ?>
            <?php if(!empty($data->contact_fax)): ?>
                <li><b>Факс:</b><?php echo $data->contact_fax;?></li>
            <?php endif; ?>
            <?php if(!empty($data->contact_email)): ?>
                <li><b>E-mail:</b>
                    <a href="mailto:<?php echo $data->contact_email; ?>"><?php echo $data->contact_email; ?></a></li>
            <?php endif; ?>
        </ul>
    </div>
</li>
<?php }?>