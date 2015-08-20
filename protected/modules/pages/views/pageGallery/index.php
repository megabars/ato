<?php
/* @var $model PhotoGallery */
/* @var $this AdminController */
/* @var $form CActiveForm */

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'gallery_dialog',
    'options'=>array(
        'title'=>'Добавить фотографии',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
)); ?>
<div id="gallery_ajax_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<div class="buttons">
    <?php

    echo CHtml::ajaxLink('Добавить фото', $this->createUrl('/pages/pageGallery/update'), array(
        'data' => array('id' => $model->id),
        'success'=>'function(html){
                        jQuery("#gallery_ajax_popup").html(html);
                        $("#gallery_dialog").dialog("open");
                    }',
    ), array(
        'class' => 'btn btn-light icon icon-plus-blue',
    ));

    ?>

    <a
        class="btn btn-warning icon icon-trash remove-all"
        data-count-id="photos_count"
        data-grid-id="galleryGrid"
        href="<?php echo $this->createUrl('/pages/pageGallery/deleteAll'); ?>">Удалить выбранные</a>

</div>

<div class="module-gallery">

    <?php
    $photos = new PhotoGalleryPhotos;
    $photos->photo_gallery_id = $model->id;

    $this->widget('application.widgets.adminGridView', array(
        'id' => 'galleryGrid',
        'dataProvider' => $photos->search(),
//    'filter' => false,
        'enablePagination' => true,
        'enableSorting' => false,
        'ajaxUpdate' => true,
        'afterAjaxUpdate' => 'js: function(){
            orders();
        }',
        'summaryText' => '',
        'template' => "{summary}{items}{pager}",
        'columns' => array(
            array(
                'class' => 'StyledCheckBoxColumn',
                'selectableRows' => 2,
                'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'galleryGrid-ids[]'),
                'htmlOptions' => array(
                    'class' => 'checkbox-column'
                )
            ),
            array(
                'name' => 'Фотография',
                'type' => 'raw',
                'value' => '"<img width=\"28\" height=\"28\" class=\"fl\"  src=\"{$data->getSmallUrl("photo")}\"/><span>{$data->file->origin_name}</span>"',
                'htmlOptions' => array(
                    'class' => 'image-field'
                )
            ),
            array(
                'name' => 'Описание',
                'type' => 'raw',
                'value' => '"<div class=\"dotted-link\">".(($data->title == "") ? "Добавить описание" : $data->title)."</div><div class=\"form-image-desc\">
                                <input type=\"text\" value=\"".(($data->title == "") ? "" : $data->title)."\"/>
                                <div class=\"button-accept\" data-id=\"{$data->id}\"></div>
                                <div class=\"button-cancel\"></div>
                            </div>"',
                'htmlOptions' => array(
                    'class' => 'change-image-field'
                )
            ),
            array(
                'name' => 'Размер',
                'type' => 'raw',
                'value' => 'Filesize::format_size($data->file->size);',
            ),
            array(
                'header' => '',
                'class' => 'CButtonColumn',
                'template' => '{delete}{drag}',
                'buttons' => array(
                    'delete' => array(
//                        'url' => 'Yii::app()->createUrl("/photoGallery/back/delete", array("id" => $data->photo))',
                        'url' => 'Yii::app()->createUrl("/pages/pageGallery/delete", array("id" => $data->id))',
                    ),
                    'drag' => array(
                        'label'=>'',
                        'options'=>array(
                            'class' => 'drag',
                        )
                    ),
                ),
            ),
        ),
    ));

    ?>
</div>

<script>
        function orders(){
            var orders = [];

            $("#galleryGrid tbody").sortable({
                connectWith: "#galleryGrid tbody",
                handle: ".drag",
                placeholder: "portlet-placeholder ui-corner-all",
                stop: function( event, ui ) {
                    $('#galleryGrid tbody').find('tr').each(function(){
                        var $this = $(this);
                        orders.push({"id":$this.find('.checkbox-id').val(), "order":$this.index()});
                    });

                    $.ajax({
                        method: "POST",
                        url:'/pages/pageGallery/updateSort',
                        data: {data:orders},
                        dataType: "JSON",
                        success: function(data){
                            console.log(data);
                            orders.length = 0;
                        }
                    });
                }
            });
        }
        orders();

//        $(document).on('click','.change-image-field .dotted-link',function() {
//            $(this).hide();
//            $(this).next('.form-image-desc').show();
//        });
//
//        $(document).on('click','.change-image-field .button-accept',function() {
//            $this = $(this);
//            $value = $this.closest('.form-image-desc').find('input').val();
//            $.post('/pages/pageGallery/updatePhoto?id=' + $this.data('id') + '&name=' + $value)
//                .success(function(){
//                    $this.closest('.form-image-desc').hide();
//                    $this.closest('.change-image-field').find('.dotted-link').html($value).show();
//                })
//                .error(function(){
//                    console.log('error');
//                });
//        });
//
//        $(document).on('click','.change-image-field .button-cancel',function() {
//            $(this).closest('.form-image-desc').hide();
//            $(this).closest('.change-image-field').find('.dotted-link').show();
//        });
</script>