<?php

Yii::import('application.widgets.adminGridView');

class sortableGridView extends adminGridView
{
    public $sortUrl = '/';

    public $initWithoutPager = false;

    public $rowHtmlOptionsExpression = 'array("data-id" => "items_{$data->id}")';

    public function init()
    {
        $this->afterAjaxUpdate = 'js:function(id, data){doSort()}';

        if($this->initWithoutPager && $this->dataProvider->pagination !== false)
            $this->htmlOptions['class']='grid-view no-drag';
        parent::init();
    }

    public function registerClientScript()
    {
        parent::registerClientScript();

        $script = <<<EOD
        function doSort(){
                var fixHelper = function(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());
                    });
                    return ui;
                };

                var sortableItem = $('#{$this->id} table.items tbody');

                sortableItem.sortable({
                    forcePlaceholderSize: true,
                    connectWith: '.grid',
                    forceHelperSize: true,
                    handle: '.drag',
                    items: 'tr',
                    axis: 'y',
                    update : function () {
                        $('#{$this->id}').addClass('grid-view-loading');
                        serial = sortableItem.sortable('serialize', {key: 'items[]', attribute: 'data-id'});
                        $.ajax({
                            'url': '{$this->sortUrl}',
                            'type': 'post',
                            'data': serial,
                            'success': function(data){
                                $('#{$this->id}').removeClass('grid-view-loading');
                            },
                            'error': function(request, status, error){
                                console.log('Порядок не сохранен');
                                sortableItem.sortable('cancel');
                                $('#{$this->id}').removeClass('grid-view-loading');
                            }
                        });
                    },
                    helper: fixHelper
                }).disableSelection()
            };
            doSort();
EOD;

        Yii::app()->clientScript->registerScript('sortable-grid', $script);
    }
}