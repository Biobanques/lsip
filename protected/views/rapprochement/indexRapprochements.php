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

<h1><?php echo Yii::t('rapprochement', 'rapprochements') ?></h1>
<div class="panel panel-default">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'id' => 'rapprochement-list',
        'dataProvider' => $dataProvider,
        'itemView' => '_viewRapprochements',
        'sortableAttributes' => array(
            'ratio' => yii::t('rapprochement', 'correspondance'),
            'validated' => yii::t('rapprochement', 'validation')
        ),
    ));
    ?>
</div>