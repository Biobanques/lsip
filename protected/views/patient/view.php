
<h4> Patient #<?php echo $model->id; ?></h4>

<?php
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
            'name' => 'sex', 'name' => 'source',
            'value' => $model->getSexValues()[$model->sex]),
    ),
));
?>