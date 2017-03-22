<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => Yii::t('user', 'create'), 'url' => array('create')),
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

<h2><?php echo Yii::t('user', 'manage') ?></h2>


<div class="info">
    <div class="title"><?php echo Yii::t('user', 'infoTitle') ?></div>
    <div class="content"><?php echo Yii::t('user', 'infoContent') ?></div>
</div>



<?php
// echo CHtml::link('Advanced Search', '#', array('class' => 'search-button'));

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
    // 'filter' => $model,
    'columns' => array(
        'id',
        'nom',
        'prenom',
        array('name' => 'profil', 'value' => '$data->profilsLabels[$data->profil]'),
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
