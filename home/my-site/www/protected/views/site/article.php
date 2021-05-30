<?php
/* @var $this SiteController */
/* @var $model ArticleForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Статьи';
$this->breadcrumbs=array(
        'Личный кабинет'=>array('request/index'),
        'Добавить статью',
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); ?>
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textArea($model,'title', array('rows'=>1, 'cols'=>30)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
        <?php echo $form->textArea($model,'content', array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
        <div>
            <?php echo CHtml::button('Прикрепить файл'); ?>
        </div>
	</div>
    <p class="hint">
        <kbd><span class="required">*</span></kbd> обязательные поля
    </p>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Готово'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->