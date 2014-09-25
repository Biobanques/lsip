<?php
/* @var $this RapprochementController */
/* @var $data Rapprochement */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idRapprochement')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idRapprochement), array('view', 'id'=>$data->idRapprochement)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPat1')); ?>:</b>
	<?php echo CHtml::encode($data->idPat1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPat2')); ?>:</b>
	<?php echo CHtml::encode($data->idPat2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validated')); ?>:</b>
	<?php echo CHtml::encode($data->validated); ?>
	<br />


</div>