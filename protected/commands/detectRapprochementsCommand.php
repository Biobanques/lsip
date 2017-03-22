<?php

class detectRapprochementsCommand extends CConsoleCommand
{

    public function run($args) {
        echo 'Loading all patients...';
        $listPatients = Patient::model()->findAll();
        echo 'analyzing...';
        foreach ($listPatients as $patient) {
            CommonTools::detect($patient);
        }
        echo 'Detection of rapprochements done.';
        Yii::app()->end();
    }

}