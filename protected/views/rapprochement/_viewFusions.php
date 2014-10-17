<?php
/* @var $this RapprochementController */
/* @var $data Rapprochement */
?>

<div class="view">


    <h3>Status : <?php echo $data->validated == 0 && $data->validated != NULL ? 'Annulé' : (($data->validated == 1 || $data->validated == NULL) ? 'En attente' : 'Validé'); ?></h3>
    <table><tr><td> <?php
                $this->renderPartial('/patient/view', array('model' => $data->idP1));
                ?></td>
            <td style="text-align: center">
                <?php
                if ($data->validated != 2) {
                    echo CHtml::imageButton(Yii::app()->baseUrl . '/images/validate.png', array(
                        'submit' => array('rapprochement/validate', 'id' => $data->idRapprochement, 'value' => '2'),
                        //'width' => '70px',
                        'height' => '50px',
                        'border' => '2px'
                    ));
                    echo '<hr/>';
                }
                if ($data->validated != 1 && $data->validated != NULL) {
                    echo CHtml::imageButton(Yii::app()->baseUrl . '/images/wait2.png', array(
                        'submit' => array('rapprochement/validate', 'id' => $data->idRapprochement, 'value' => '1'),
                        // 'width' => '70px',
                        'height' => '50px',
                        'border' => '2px'
                    ));
                    echo '<hr/>';
                }
                if ($data->validated != 0 || $data->validated == NULL) {
                    echo CHtml::imageButton(Yii::app()->baseUrl . '/images/annuler.png', array(
                        'submit' => array('rapprochement/validate', 'id' => $data->idRapprochement, 'value' => '0'),
                        //'width' => '70px',
                        'height' => '50px',
                        'border' => '1px'
                    ));
                }
                ?></td>

            <td>
                <?php
                $this->renderPartial('/patient/view', array('model' => $data->idP2));
                ?></td></tr></table>

    <br />



</div>