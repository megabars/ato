<div class="tabs">
    <div class="nav-tabs">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
            <?php foreach (MailingType::instance()->list as $key => $item) : ?>
                <li class="<?php echo ($active == $key) ? 'ui-tabs-active ui-state-active' : ''; ?>">
                    <a class="list-group-item" href="<?php echo $this->createUrl($item['url']); ?>">
                        <?php echo $item['label']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
