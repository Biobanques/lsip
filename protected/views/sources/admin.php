<?php
/* @var $this SourcesController */
/* @var $model Sources */
$this->menu = array(
    array('label' => Yii::t('sources', 'create'), 'url' => array('create')),
);
?>

<h2><?php echo Yii::t('common', 'manageSources') ?></h2>
<div class='info'>
    <div class='title'>
        <?php
        echo Yii::t('sources', 'infoTitle');
        ?>
    </div>
    <div class='content'>
        <?php
        echo Yii::t('sources', 'infoContent');
        ?>
    </div>
</div>
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '',
));
$this->widget('bootstrap.widgets.TbNav', array(
    'items' => $this->menu,
    'htmlOptions' => array('class' => 'operations',
        'style' => 'display:inline-block'),
));
$this->endWidget();
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'sources-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'id',
        'name',
        'passphrase',
        array('name' => 'admin', 'value' => '$data->admin0->fullName'),
        array('name' => 'webapp', 'value' => '$data->webapp0->fullName'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
            'template' => '{update}{delete}',
        ),
    ),
));
?>
