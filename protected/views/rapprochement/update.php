<?php
/* @var $this RapprochementController */
/* @var $model Rapprochement */

$this->breadcrumbs=array(
	'Rapprochements'=>array('index'),
	$model->idRapprochement=>array('view','id'=>$model->idRapprochement),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rapprochement', 'url'=>array('index')),
	array('label'=>'Create Rapprochement', 'url'=>array('create')),
	array('label'=>'View Rapprochement', 'url'=>array('view', 'id'=>$model->idRapprochement)),
	array('label'=>'Manage Rapprochement', 'url'=>array('admin')),
);
?>

<h1>Update Rapprochement <?php echo $model->idRapprochement; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>