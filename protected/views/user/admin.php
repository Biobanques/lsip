<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<div style="display: inline-block">
    Profil code is the following : <br>
    <ol>
        <li>
            Identity server admin.
        </li>
        <li>
            Source admin.
        </li>
        <li>
            Simple user / third party applications.
        </li>
    </ol>
</div>

<?php
// echo CHtml::link('Advanced Search', '#', array('class' => 'search-button'));

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
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'nom',
        'prenom',
        'profil',
        'login',
        'password',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
            'template' => '{update}{delete}',
        ),
    ),
));
?>
