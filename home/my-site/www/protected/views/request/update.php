<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Просмотреть', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управлять', 'url'=>array('admin')),
);
?>

<h1>Изменить заявку №<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>