<?php
/* @var $this RapprochementController */
/* @var $data Rapprochement */
?>





<div class="panel
<?php echo ($data->ratio == 100) ? 'panel-success' : ($data->ratio >= 75 && $data->ratio < 100 ? 'panel-warning' : 'panel-danger'); ?>
     ">
    <div class="panel-heading">
        <h3 class="panel-title">Status :
            <?php echo $data->validated == 1 && $data->validated != NULL ? 'Annulé' : (($data->validated == 0 || $data->validated == NULL) ? 'En attente' : 'Validé'); ?>
            <br>Taux de correspondance : <?php echo $data->ratio; ?>%
        </h3>
    </div>
    <div class="panel-body">
        <div class="view" id="<?php echo $data->idRapprochement; ?>" >
            <table><tr><td style="width: 40%"> <?php
                        $this->renderPartial('/patient/view', array('model' => $data->idP1));
                        ?></td>
                    <td style="text-align: center;width: 20%">
                        <?php
                        if ($data->validated != 2) {

                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'vf' . $data->idRapprochement,
                                'action' => Yii::app()->createUrl($this->route),
                                'method' => 'post',
                            ));
                            echo $form->hiddenField($data, 'idRapprochement', array('value' => $data->idRapprochement));
                            echo $form->hiddenField($data, 'value', array('value' => 2));

                            echo CHtml::ajaxSubmitButton('', '', array(
                                'complete' => 'js:'
                                . 'function(){'
                                . '$.fn.yiiListView.update("rapprochement-list",{"data" :$(this).serialize});return false;'
                                . '}',
                                    ), array('style' => 'height : 50px;width : 50px; border: 2px; background: url("' . Yii::app()->baseUrl . '/images/validate.png");background-size : 50px 50px;'));
                            $this->endWidget();
                            echo '<br><br>';
                        }
                        if ($data->validated != 0 && $data->validated != NULL) {

                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'vf' . $data->idRapprochement,
                                'action' => Yii::app()->createUrl($this->route),
                                'method' => 'post',
                            ));
                            echo $form->hiddenField($data, 'idRapprochement', array('value' => $data->idRapprochement));
                            echo $form->hiddenField($data, 'value', array('value' => 0));

                            echo CHtml::ajaxSubmitButton('', '', array(
                                'complete' => 'js:'
                                . 'function(){'
                                . '$.fn.yiiListView.update("rapprochement-list",{"data" :$(this).serialize});return false;'
                                . '}',
                                    ), array('style' => 'height : 50px;width : 50px; border: 2px; background: url("' . Yii::app()->baseUrl . '/images/wait2.png");background-size : 50px 50px;'));
                            $this->endWidget();
                            echo '<br><br>';
                        }
                        if ($data->validated != 1 || $data->validated == NULL) {

                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'vf' . $data->idRapprochement,
                                'action' => Yii::app()->createUrl($this->route),
                                'method' => 'post',
                            ));
                            echo $form->hiddenField($data, 'idRapprochement', array('value' => $data->idRapprochement));
                            echo $form->hiddenField($data, 'value', array('value' => 1));
                            echo CHtml::ajaxSubmitButton('', '', array(
                                'complete' => 'js:'
                                . 'function(){'
                                . '$.fn.yiiListView.update("rapprochement-list",{"data" :$(this).serialize});return false;'
                                . '}',
                                    ), array('style' => 'height : 50px;width : 50px; border: 2px; background: url("' . Yii::app()->baseUrl . '/images/annuler.png");background-size : 50px 50px;'));
                            $this->endWidget();
                            echo '<br><br>';
                        }
                        ?></td>

                    <td style="width: 40%">
                        <?php
                        $this->renderPartial('/patient/view', array('model' => $data->idP2));
                        ?></td></tr></table>
        </div>
    </div>
</div>