<?php
/* @var $this SourcesController */
/* @var $model Sources */

$this->breadcrumbs=array(
	'Sources'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sources', 'url'=>array('index')),
	array('label'=>'Create Sources', 'url'=>array('create')),
	array('label'=>'View Sources', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sources', 'url'=>array('admin')),
);
?>

<h1>Update Sources <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>