<?php
/* @var $this SourcesController */
/* @var $model Sources */

$this->breadcrumbs = array(
    'Sources' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Create Sources', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sources-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sources</h1>


<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '',
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'items' => $this->menu,
    'htmlOptions' => array('class' => 'operations',
        'style' => 'display:inline-block'),
));
$this->endWidget();
?>

<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'sources-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'passphrase',
        'admin',
        'webapp',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
            'template' => '{update}{delete}',
        ),
    ),
));
?>
