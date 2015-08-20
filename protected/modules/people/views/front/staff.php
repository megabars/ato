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
$this->breadcrumbs[] = 'Сотрудники';
?>
<div class="wrap">
	<h2><?php echo $this->pageTitle?></h2>
	<div class="clearfix">
		<?php echo $this->renderPartial('menu',array('model'=>$model));?>

		<div class="left-content">

			<div class="people clearfix">

				<?php echo $this->renderPartial('_left',array('model'=>$model));?>

                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => new CActiveDataProvider('PeopleStaff', array(
                        'criteria'=>array(
                            'condition'=>'people_id='.$model->id,
                        ),
                        'pagination'=>array(
                            'pageSize'=>10,
                        ),
                    )),
                    'itemView'=>'_staff_view',
                    'itemsTagName'=>'ul',
                    'htmlOptions'=>array(
                        'class'=>'right'
                    ),
                    'template'=>'{items}<br>{pager}',
                    'itemsCssClass'=>'people-list',
                    'pager' => array(
                        'htmlOptions' => array('class' => 'pager'),
                        'cssFile' => false,
                        'header' => false,
                        'firstPageLabel' => '',
                        'prevPageLabel' => 'Предыдущая',
                        'nextPageLabel' => 'Следующая',
                        'lastPageLabel' => '',
                    ),
                ));
                ?>

			</div>
		</div>

	</div>

</div>

