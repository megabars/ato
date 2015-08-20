
<?php
/** @var $model People */
/** @var $this PeopleController */

$this->breadcrumbs = array(
	'Рассылки',
);
?>

<div class="page-header">
    <h2>Рассылки</h2>
</div>


<?php echo $this->renderPartial('/back/menu',array('active'=>MailingType::MAIN));?>

<div></div>