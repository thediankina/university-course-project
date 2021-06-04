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
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textArea($model,'title', array('rows'=>1, 'cols'=>40)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
        <?php echo $form->textArea($model,'content', array('rows'=>6, 'cols'=>60)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'images'); ?>
        <?php echo $form->fileField($model, 'images[]', array('multiple'=>true, 'accept'=>'images/*')); ?>
        <?php echo $form->error($model,'images[]'); ?>
    </div>
    <p class="hint"><kbd><span class="required">*</span></kbd> обязательные поля</p>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Готово'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->