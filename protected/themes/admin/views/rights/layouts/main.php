<?php $this->beginContent(Rights::module()->appLayout); ?>

<?php $this->renderPartial('/_flash'); ?>



<div class="page-header">
    <div class="list-group">
        <?php $this->renderPartial('/_menu'); ?>
    </div>
</div>

<?php echo $content; ?>

<?php $this->endContent(); ?>