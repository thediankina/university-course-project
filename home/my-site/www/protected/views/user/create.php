<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Регистрация'
);
?>

<h1>Зарегистрироваться</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>