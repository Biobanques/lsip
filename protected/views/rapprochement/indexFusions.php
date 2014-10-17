<?php
/* @var $this RapprochementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Rapprochements',
);

$this->menu = array(
    array('label' => 'Create Rapprochement', 'url' => array('create')),
    array('label' => 'Manage Rapprochement', 'url' => array('admin')),
);
?>

<h1>Fusions</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_viewFusions',
));
?>
