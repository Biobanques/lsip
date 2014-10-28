
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
            'label' => 'Source',
            'value' => $model->src->name),
        'sex',
    ),
));
?>