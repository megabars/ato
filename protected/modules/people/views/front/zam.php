<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;

$this->pageTitle = ($model)?$model->getTypeLabel():'';
$this->breadcrumbs['Органы власти'] = '/ORGANY-VLASTI';
if($this->middleBreadcrumbs !== null && is_array($this->middleBreadcrumbs)) {
    $this->breadcrumbs = array_merge($this->breadcrumbs, $this->middleBreadcrumbs);
}
$this->breadcrumbs[$this->pageTitle] = '/people/front/view/id/'.@$model->id.'/type/'.@$model->type.'/from/'.@$_GET['from'];
$this->breadcrumbs[] = 'Заместители';
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle?></h2>
    <div class="clearfix">
        <?php echo $this->renderPartial('menu',array('model'=>$model));?>
        <div class="left-content">

            <div class="people clearfix">

                <?php echo $this->renderPartial('_left',array('model'=>$model));?>

                <div class="right">
                    <div class="collapses">
                        <div class="item">
                            <div class="title">
                                <div class="name">Заместители Губернатора Томской области</div>
                                <div class="toggle"></div>
                            </div>
                            <div class="desc">
                                <div class="list-links">
                                    <ul>
                                        <?php
                                        if($zams)
                                            foreach($zams as $m){?>
                                                <li><a href="/people/front/view/id/<?php echo $m->id?>"><?php echo $m->getTypeLabel()?></a></li>
                                            <?php }  ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>


