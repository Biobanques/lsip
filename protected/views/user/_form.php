<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
        'id' => 'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Yii::t('common', 'required'); ?></p>
    <div class="col_form">
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'profil'); ?>
            <?php echo $form->dropDownList($model, 'profil', $model->getProfilsLabels()); ?>
            <?php echo $form->error($model, 'profil'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'nom'); ?>
            <?php echo $form->textField($model, 'nom', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'nom'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'prenom'); ?>
            <?php echo $form->textField($model, 'prenom', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'prenom'); ?>
        </div>

    </div>
    <div class="col_form">

        <div class="row">
            <?php echo $form->labelEx($model, 'login'); ?>
            <?php echo $form->textField($model, 'login', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'login'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->textField($model, 'password', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->