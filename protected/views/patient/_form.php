<?php
/* @var $this PatientController */
/* @var $model Patient */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
        'id' => 'patient-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="col_form">
        <div class="row">
            <?php echo $form->labelEx($model, 'birthName'); ?>
            <?php echo $form->textField($model, 'birthName', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'birthName'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'useName'); ?>
            <?php echo $form->textField($model, 'useName', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'useName'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'firstName'); ?>
            <?php echo $form->textField($model, 'firstName', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'firstName'); ?>
        </div>
    </div>
    <div class="col_form">
        <div class="row">
            <?php echo $form->labelEx($model, 'birthDate'); ?>
            <?php echo $form->textField($model, 'birthDate'); ?>
            <?php echo $form->error($model, 'birthDate'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'sex'); ?>
            <?php echo $form->dropDownList($model, 'sex', Patient::model()->getSexValues()); ?>
            <?php echo $form->error($model, 'sex'); ?>
        </div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->