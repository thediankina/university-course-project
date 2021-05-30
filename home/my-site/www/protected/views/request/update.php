<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обработать',
);
?>

<h2>Обработать заявку №<?php echo $model->id; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>