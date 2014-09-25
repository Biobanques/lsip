<?php
/* @var $this RapprochementController */
/* @var $model Rapprochement */

$this->breadcrumbs=array(
	'Rapprochements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rapprochement', 'url'=>array('index')),
	array('label'=>'Manage Rapprochement', 'url'=>array('admin')),
);
?>

<h1>Create Rapprochement</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>