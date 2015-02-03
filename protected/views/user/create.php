<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage users', 'url' => array('admin')),
);
?>

<h2><?php echo Yii::t('user', 'create'); ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>