<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array('empty' => '', 'В работе'=>'В работе', 'Запланирована'=>'Запланирована', 'Отклонена'=>'Отклонена')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

    <p class="hint">
        <kbd><span class="required">*</span></kbd> обязательные поля
    </p>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Принять'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->