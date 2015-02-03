<?php
/* @var $this SourcesController */
/* @var $model Sources */
?>
<div class='info'>
    <div class='title'>
<?php
echo Yii::t('sources', 'updateInfoTitle');
?>
    </div>
    <div class='content'>
        <?php
        echo Yii::t('sources', 'updateInfoContent');
        ?>
    </div>
</div>
<h2>Update Sources <?php echo $model->id; ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>