<?php

class massImportCommand extends CConsoleCommand
{

    public function run($args) {
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        chdir($folderSource);
        $files = glob('*.csv');
        echo count($files) . " files detected \n";
        foreach ($files as $importedFile) {
            if (substr($importedFile, 0, 3) === 'adn' || substr($importedFile, 0, 7) === 'cerveau') {
                echo "Saving base file";
                copy($importedFile, $folderSource . "saved/$importedFile");
                $fileResult = $this->analyze($importedFile);
            } else {
                $exp = new Exception("$importedFile doesn't start with 'upmc or neuroceb, origin is not determinated.");
                Yii::log($exp->getMessage(), CLogger::LEVEL_ERROR);
                Yii::app()->end();
            }
        }
    }

    protected function analyze($filePath) {
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        $folderTarget = $folderSource . 'treated/';
        $sourceFile = fopen($folderSource . $filePath, "r");
        $outputFile = fopen($folderTarget . $filePath, 'w');
        echo $folderSource . $filePath . "\n";
        echo $folderTarget . $filePath . "\n";
        $row = 1;
        $sipArray = array();
        while (($data = fgetcsv($sourceFile, 1000, ",")) !== FALSE) {

            if ($row == 1) {
                $sipArray = array();
                //print_r($data);
                foreach ($data as $key => $item) {

                    if ($item == 'useName') {
                        $sipArray['useName'] = $key;
                        unset($data[$key]);
                    }
                    if ($item == 'birthName') {
                        $sipArray['birthName'] = $key;
                        unset($data[$key]);
                    }
                    if ($item == 'firstName') {
                        $sipArray['firstName'] = $key;
                        unset($data[$key]);
                    }
                    if ($item == 'sex') {
                        $sipArray['sex'] = $key;
                        unset($data[$key]);
                    }
                    if ($item == 'birthDate') {
                        $sipArray['birthDate'] = $key;
                        unset($data[$key]);
                    }
                    if ($item == 'id') {
                        $sipArray['sourceId'] = $key;
                        unset($data[$key]);
                    }
                }

                if (count($sipArray) != 5) {

                    $exp = new Exception('A SIP item is missing in the file ' . $filePath);
                    Yii::log($exp->getMessage(), CLogger::LEVEL_ERROR);
                    Yii::app()->end();
                } else
                    $data[] = 'idSip';
            } else {

                $patient = new Patient;
                $patient->birthName = $data[$sipArray['birthName']];
                $patient->useName = $data[$sipArray['useName']];
                $patient->firstName = $data[$sipArray['firstName']];
                $patient->birthDate = CommonTools::formatDate($data[$sipArray['birthDate']], 'mysql');
                $patient->sex = $data[$sipArray['sex']];
                isset($sipArray['sourceId']) ? $patient->sourceId = $data[$sipArray['sourceId']] : null;
                if (substr($filePath, 0, 3) === 'adn')
                    $patient->source = 2;
                elseif (substr($filePath, 0, 7) === 'cerveau')
                    $patient->source = 1;

                if (!$patient->save()) {
                    $exp = new Exception('Save patient error');
                    Yii::log($exp->getMessage(), CLogger::LEVEL_ERROR);
                    Yii::app()->end();
                } else {
                    unset($data[$sipArray['birthName']]);
                    unset($data[$sipArray['useName']]);
                    unset($data[$sipArray['firstName']]);
                    unset($data[$sipArray['birthDate']]);
                    unset($data[$sipArray['sex']]);
                    if (isset($sipArray['sourceId']))
                        unset($data[$sipArray['sourceId']]);

                    $data[] = $patient->id;
                }
            }

            $row++;

            fputcsv($outputFile, $data);
        }
        fclose($sourceFile);
        unlink($filePath);
        fclose($outputFile);
    }

}