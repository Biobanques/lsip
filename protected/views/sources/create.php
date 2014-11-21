<?php
/* @var $this SourcesController */
/* @var $model Sources */

$this->breadcrumbs = array(
    'Sources' => array('index'),
    'Create',
);
?>

<h1>Create Sources</h1>

<?php $this->renderPartial('_form', array('model' => $model));
?>