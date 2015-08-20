<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Оценка регулирующего воздействия и экспертиза нпа';

$this->breadcrumbs = array(
    'Открытые данные' => array('/Otkritiy-region'),
    'Оценка регулирующего воздействия и экспертиза нпа' => array('/rating/front'),
    $name
);

?>

<div class="wrap">
    <h2><?php echo $name; ?></h2>

    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <?php $this->widget('navigation.widgets.menuByAlias', array(
                    'menu_alias' => 'main_menu',
                    'max_levels' => 1,
                    'parentId' => $parent_id,
                )); ?>
            </div>

            <div class="infopotok">
                <!--Begin OpenGov Infostream-widget code-->
                <script src="http://bigovernment.ru/twinvest/api/widget/infopotok/script.js" type="text/javascript"></script>
                <div id="bg-infopotok-widget-container" data-width="220" data-height="425"><img src="http://bigovernment.ru/twinvest/api/widget/loading.gif" /></div>
                <!--End of OpenGov Infostream-widget code-->
            </div>
        </div>

        <div class="left-content">
            <?php if ($showFilter){
                $this->renderPartial('_search', array(
                    'model'	=>	$dataProvider,
                    'type' 	=> $type,
                    'isProject' => $isProject,
                ));
            }

            $view = $isProject ? '_project' : '_doc';
            $this->renderPartial('_index/'.$view, array(
                'dataProvider'	=>	$dataProvider,
                'type' 	=> $type,
            ));
            ?>
        </div>
    </div>


</div>