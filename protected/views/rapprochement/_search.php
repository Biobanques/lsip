<?php
/* @var $this RapprochementController */
/* @var $model Rapprochement */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idRapprochement'); ?>
		<?php echo $form->textField($model,'idRapprochement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idPat1'); ?>
		<?php echo $form->textField($model,'idPat1',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idPat2'); ?>
		<?php echo $form->textField($model,'idPat2',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validated'); ?>
		<?php echo $form->textField($model,'validated',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->