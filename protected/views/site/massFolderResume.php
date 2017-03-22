<div class='info'>
    <div class='title'>
        <?php echo Yii::t('massImportModal', 'infoTitle'); ?>
    </div>
    <div class='content'>
        <?php echo Yii::t('massImportModal', 'infoContent'); ?>
    </div>
</div>
<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataFileProvider,
    'columns' => array(
        array('name' => 'name'),
        'size',
        'lastModif'
    )
));


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

