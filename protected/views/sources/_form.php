<?php
/* @var $this SourcesController */
/* @var $model Sources */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $listUsers = CHtml::listData(User::model()->findAll(), 'id', 'fullName');

    $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
        'id' => 'sources-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note"><?php echo Yii::t('common', 'required'); ?></p>

    <?php echo $form->errorSummary($model); ?>
    <div class="col_form">
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'passphrase'); ?>
            <?php echo $form->textField($model, 'passphrase', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'passphrase'); ?>
        </div>
    </div>
    <div class="col_form">
        <div class="row">
            <?php echo $form->labelEx($model, 'admin'); ?>
            <?php echo $form->dropDownList($model, 'admin0', $listUsers); ?>
            <?php echo $form->error($model, 'admin'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'webapp'); ?>
            <?php echo $form->dropDownList($model, 'webapp0', $listUsers); ?>
            <?php echo $form->error($model, 'webapp'); ?>
        </div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->