<?php
/* @var $this RapprochementController */
/* @var $model Rapprochement */

$this->breadcrumbs=array(
	'Rapprochements'=>array('index'),
	$model->idRapprochement,
);

$this->menu=array(
	array('label'=>'List Rapprochement', 'url'=>array('index')),
	array('label'=>'Create Rapprochement', 'url'=>array('create')),
	array('label'=>'Update Rapprochement', 'url'=>array('update', 'id'=>$model->idRapprochement)),
	array('label'=>'Delete Rapprochement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idRapprochement),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rapprochement', 'url'=>array('admin')),
);
?>

<h1>View Rapprochement #<?php echo $model->idRapprochement; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idRapprochement',
		'idPat1',
		'idPat2',
		'validated',
	),
)); ?>
