<?php
/**
 * @var $this FrontController
 * @var $model AcPublic[]
 * @var $years array
 * @var $categories CategoryPost
 * @var $type integer
 */

$this->breadcrumbs = array(
    'Противодействие коррупции'=>'/antiCorruption/front',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <div class="right-content">
            <div class="right-menu">
                <a href="/antiCorruption/front/public" class="<?php echo ($type==1)?'active':''?>">Сведения о доходах, об имуществе и обязательствах имущественного характера</a>
                <a href="/antiCorruption/front/public/type/2" class="<?php echo ($type==2)?'active':''?>">Сведения о расходах на совершение сделок по приобретению недвижимого имущества, транспортного средства, ценных бумаг, акций</a>
            </div>
        </div>

        <div class="left-content">
            <div class="select-filter">
                Показать данные за
                <?php echo CHtml::dropDownList('year', '', $years, array('class'=>'select')); ?>
            </div>
            <div class="collapses">
                <?php $this->renderPartial('public/_list', array('categories' => $categories, 'model'=> $model)) ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.select').selecter('destroy');
        $('.select').selecter({
            callback: function (value, index) {
                $.ajax({
                    url: window.location.href,
                    data: {
                        year: value
                    },
                    success: function(html){
                        $('.collapses').html(html);
                    }
                })
            }
        });
    });
</script>

