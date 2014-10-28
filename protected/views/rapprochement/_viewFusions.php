<?php
/* @var $this RapprochementController */
/* @var $data Rapprochement */
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            Status : <?php echo $data->validated == 0 && $data->validated != NULL ? 'Annulé' : (($data->validated == 1 || $data->validated == NULL) ? 'En attente' : 'Validé'); ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="span4">
                <?php $this->renderPartial('/patient/view', array('model' => $data->idP1)); ?>
            </div>
            <div class="span1" >
                        <?php
                        if ($data->validated != 2) {
                            echo CHtml::imageButton(Yii::app()->baseUrl . '/images/validate.png', array(
                                'submit' => array('rapprochement/validate', 'id' => $data->idRapprochement, 'value' => '2'),
                                'height' => '50px',
                            ));
                        }
                        ?>
                        <?php
                        if ($data->validated != 1 && $data->validated != NULL) {
                            echo CHtml::imageButton(Yii::app()->baseUrl . '/images/wait2.png', array(
                                'submit' => array('rapprochement/validate', 'id' => $data->idRapprochement, 'value' => '1'),
                                'height' => '50px',
                            ));
                        }
                        ?>
                    
                        <?php
                        if ($data->validated != 0 || $data->validated == NULL) {
                            echo CHtml::imageButton(Yii::app()->baseUrl . '/images/annuler.png', array(
                                'submit' => array('rapprochement/validate', 'id' => $data->idRapprochement, 'value' => '0'),
                                'height' => '50px',
                            ));
                        }
                        ?>

            </div>
            <div class="span4">
<?php $this->renderPartial('/patient/view', array('model' => $data->idP2)); ?>
            </div>
        </div>
    </div>
</div>