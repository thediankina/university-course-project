<?php
/* @var $this SiteController */
/* @var $model FAQForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - FAQ';
$this->breadcrumbs=array(
    'Личный кабинет'=>array('request/index'),
    'Обновить FAQ',
);
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faq-form',
	'enableAjaxValidation'=>false,
)); ?>
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row row1">
        <?php echo $form->labelEx($model,'category.category_name'); ?>
        <?php echo $form->dropDownList($model, 'id_category', CHtml::listData(CategoryFAQ::model()->findAll(), 'id', 'category_name')); ?>
        <?php echo $form->error($model,'id_category'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'question'); ?>
		<?php echo $form->textArea($model,'question', array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'answer'); ?>
		<?php echo $form->textArea($model,'answer', array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'answer'); ?>
	</div>
    <p class="hint">
        <kbd><span class="required">*</span></kbd> обязательные поля
    </p>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Готово'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->