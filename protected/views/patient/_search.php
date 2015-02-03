<?php
/* @var $this PatientController */
/* @var $model Patient */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $optionsSrc = array(
        'empty' => Yii::t('patient', 'allSources'),
    );
    $optionsSex = array(
        'empty' => '-',
    );
    $listSexValues = Patient::model()->getSexValues();

    $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'id' => 'search-form',
    ));
    ?>
    <div class="col_form">
        <div class="row">
            <?php echo $form->label($model, 'source'); ?>
            <?php
            $listSources = CHtml::listData(Sources::model()->findAll(), 'id', 'name');
            echo $form->dropDownList($model, 'src', $listSources
                    , $optionsSrc);
            ?>
        </div>
        <div class="row">
            <?php echo $form->label($model, 'id'); ?>
            <?php echo $form->textField($model, 'id'); ?>
        </div>

    </div>
    <div class="col_form">
        <div class="row">
            <?php echo $form->label($model, 'birthName'); ?>
            <?php echo $form->textField($model, 'birthName', array('size' => 60, 'maxlength' => 255)); ?>
        </div>
        <div class="row">
            <?php echo $form->label($model, 'useName'); ?>
            <?php echo $form->textField($model, 'source', array('size' => 60, 'maxlength' => 255)); ?>
        </div>

        <div class="row">
            <?php echo $form->label($model, 'firstName'); ?>
            <?php echo $form->textField($model, 'firstName', array('size' => 60, 'maxlength' => 255)); ?>
        </div>
    </div>
    <div class="col_form">

        <div class="row">
            <?php echo $form->label($model, 'birthDate'); ?>
            <?php echo $form->textField($model, 'birthDate'); ?>
        </div>
        <div class="row">
            <?php echo $form->label($model, 'sex'); ?>
            <?php echo $form->dropDownList($model, 'sex', $listSexValues, $optionsSex) ?>
        </div>
    </div>
    <div class="row buttons">
        <?php
        echo CHtml::submitButton('Search');
        ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->