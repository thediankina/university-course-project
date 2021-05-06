<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Изменить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управлять', 'url'=>array('admin')),
);
?>

<h1>Просмотр заявки №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_category',
		'request_date',
		'info',
		'mail',
		'phone',
		'status',
	),
)); ?>
