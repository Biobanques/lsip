<?php
/* @var $this PatientController */
/* @var $model Patient */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
    	$('#patient-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2><?php echo Yii::t('patient', 'manage'); ?></h2>
<div class="info">
    <div class="title"><?php echo Yii::t('patient', 'infoTitle') ?></div>
    <div class="content"><?php echo Yii::t('patient', 'infoContent') ?></div>
</div>
<?php echo CHtml::link(Yii::t('common', 'advancedSearch'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$arraySexValues = Patient::model()->getSexValues();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'patient-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    //  'filter' => $model,
    /* 'template'=>"{items}", */
    'columns' => array(
        'id',
        'birthName',
        'useName',
        'firstName',
        'source',
        'birthDate',
        array('name' => 'source', 'value' => '$data->src->name'),
        array('name' => 'sourceId', 'value' => '$data->sourceId!=0?$data->sourceId:Yii::t("common","NotKnown")'),
        array('name' => 'sex', 'value' => '$literalsex=$data->sexValues[$data->sex]'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
            'template' => '{update}{delete}',
        ),
    ),
));
?>
