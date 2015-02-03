<?php
/* @var $this SourcesController */
/* @var $model Sources */
?>

<h2><?php echo Yii::t('sources', 'create'); ?></h2>
<div class='info'>
    <div class='title'>
        <?php
        echo Yii::t('sources', 'createInfoTitle');
        ?>
    </div>
    <div class='content'>
        <?php
        echo Yii::t('sources', 'createInfoContent');
        ?>
    </div>
</div>
<?php $this->renderPartial('_form', array('model' => $model));
?>