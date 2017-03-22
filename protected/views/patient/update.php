<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs = array(
    'Patients' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Patient', 'url' => array('index')),
    array('label' => 'Create Patient', 'url' => array('create')),
    array('label' => 'View Patient', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Patient', 'url' => array('admin')),
);
?>

<h2><?php echo Yii::t('patient', 'update') . $model->id; ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>