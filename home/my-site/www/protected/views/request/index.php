<?php
/* @var $this RequestController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle=Yii::app()->name . ' - Заявки';
$this->breadcrumbs=array(
	'Заявки',
);

/** $this->menu=array(
	array('label'=>'Управление заявками', 'url'=>array('admin')),
); */
?>

<h1>Список заявок</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>array(
            'city',
            array(
                    'name' => 'category.category_name',
                    'value' => function($model) {
                            return $model->category->category_name;
                    }
            ),
            'category.priority',
            'status',
            'subject',
            array(
                    'class'=>'CButtonColumn',
                    'template' => '{update}',
            ),
    ),
)); ?>
