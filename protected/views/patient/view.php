
<h4> Patient #<?php echo $model->id; ?></h4>

<?php
$arraySexValues = Patient::model()->getSexValues();
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'type' => 'bordered condensed striped',
    'attributes' => array(
        'id',
        'birthName',
        'useName',
        'firstName',
        array('name' => 'birthDate', 'value' => CommonTools::formatDate($model->birthDate)),
        array(
            'name' => 'source',
            'value' => $model->src->name),
        array(
            'name' => 'sex',
            'value' => $arraySexValues[$model->sex]),
    ),
));
?>