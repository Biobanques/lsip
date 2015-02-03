<?php
/* @var $this RapprochementController */
/* @var $dataProvider CActiveDataProvider */
?>
<h2><?php echo Yii::t('common', "manage$type") ?></h2>
<div class="info">
    <div class="title">
        <?php
        echo Yii::t('rapprochement', 'infoTitle', array('typeRapprochements' => strtolower(Yii::t('rapprochements', strtolower($type)))));
        ?>
    </div>
    <div class="content">
        <?php
        echo Yii::t('rapprochement', 'infoContent', array('typeRapprochements' => strtolower(Yii::t('rapprochements', strtolower($type)))));
        ?>
    </div>
</div>
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