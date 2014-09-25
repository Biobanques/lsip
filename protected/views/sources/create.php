<?php
/* @var $this SourcesController */
/* @var $model Sources */

$this->breadcrumbs=array(
	'Sources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sources', 'url'=>array('index')),
	array('label'=>'Manage Sources', 'url'=>array('admin')),
);
?>

<h1>Create Sources</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>