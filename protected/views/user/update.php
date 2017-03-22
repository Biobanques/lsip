<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'View User', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<h2><?php echo Yii::t('user', 'update') . $model->id ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>