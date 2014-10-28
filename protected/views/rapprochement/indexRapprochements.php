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

<h1>Rapprochements</h1>
<div class="panel panel-default">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'id' => 'rapprochement-list',
        'dataProvider' => $dataProvider,
        'itemView' => '_viewRapprochements',
        'sortableAttributes' => array(
            'ratio' => 'Taux de correspondance',
            'validated' => 'Validation'
        ),
    ));
    ?>
</div>