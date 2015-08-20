<?php
/**
 * @var Comment model
 */
?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->urlManager->createUrl($this->postCommentAction),
        'method' => 'post',
        'id' => $this->id,
    )); ?>

    <?php
        echo $form->errorSummary($newComment);

        echo $form->hiddenField($newComment, 'owner_name');
        echo $form->hiddenField($newComment, 'owner_id');
        echo $form->hiddenField($newComment, 'parent_comment_id', array('class' => 'parent_comment_id'));
    ?>

        <div class="item">

            <div class="item-body">
                <div class="row">
                    <?php echo $form->label($newComment, 'user_name'); ?>
                    <?php echo $form->textField($newComment, 'user_name'); ?>
                    <?php echo $form->error($newComment, 'user_name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->label($newComment, 'user_email'); ?>
                    <?php echo $form->textField($newComment, 'user_email'); ?>
                    <?php echo $form->error($newComment, 'user_email'); ?>
                </div>
                <div class="row">
                    <?php echo $form->label($newComment, 'comment_text'); ?>
                    <?php echo $form->textArea($newComment, 'comment_text', array('cols' => 60, 'rows' => 10, 'placeholder' => 'Ваш комментарий')); ?>
                    <?php echo $form->error($newComment, 'comment_text'); ?>
                </div>
                <div>
                    <?php
                        echo CHtml::submitButton(
                            'Отправить',
//                            Yii::app()->createUrl('/comments/comment/postComment'),
//                            array('success' => 'window.location.reload()'),
                            array('class' => 'btn btn-lightblue')
                        );
                    ?>
                </div>
            </div>
        </div>

    <?php $this->endWidget(); ?>
</div>
