<?php
/* @var $this RequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Заявки',
);

$this->menu=array(
	array('label'=>'Управление заявками', 'url'=>array('admin')),
);
?>

<h1>Список заявок</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>array(
            'request',
            'info',
            'mail',
            'phone',
            'status',
            array(
                    'class'=>'CButtonColumn',
            ),
    ),
)); ?>
