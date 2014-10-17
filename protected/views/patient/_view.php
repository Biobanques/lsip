<?php
/* @var $this PatientController */
/* @var $data Patient */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('birthName')); ?>:</b>
    <?php echo CHtml::encode($data->birthName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('useName')); ?>:</b>
    <?php echo CHtml::encode($data->useName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
    <?php echo CHtml::encode($data->firstName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('birthDate')); ?>:</b>
    <?php echo CHtml::encode($data->birthDate); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
    <?php echo CHtml::encode($data->source); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
    <?php echo CHtml::encode($data->sex); ?>
    <br />


</div>