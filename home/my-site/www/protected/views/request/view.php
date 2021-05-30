<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	$model->id,
);
?>

<h2>Информация заявки №<?php echo $model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'name',
        'city',
        array(
            'name' => 'category.category_name',
            'value' => function($model) {
                return $model->category->category_name;
            }
        ),
        'category.priority',
        'email',
        'phone',
        'body',
        'comment',
	),
)); ?>
