<?php

class massImportCommand extends CConsoleCommand
{

    public function run($args) {
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        chdir($folderSource);
        $files = array_filter(glob('*'), 'is_file');
        echo count($files) . " files detected \n";
        foreach ($files as $importedFile) {
            echo 'saving base file...\n';
            copy($importedFile, $folderSource . "saved/$importedFile");
            echo 'Trying to parse\n';
//            if (fnmatch('*.csv', $importedFile)) {
//                $this->analyzeCsv($importedFile);
//            }
            if (fnmatch('*.xml', $importedFile)) {
                CommonTools::analyzeAndRecreateXml($importedFile);
            }
        }
        Yii::app()->end();
    }

    /*
      protected function analyzeCsv($filePath) {
      $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
      $folderTarget = $folderSource . 'treated/';
      $sourceFile = fopen($folderSource . $filePath, "r");
      $outputFile = fopen($folderTarget . $filePath, 'w');
      $row = 1;
      $sipArray = array();
      while (($data = fgetcsv($sourceFile, 1000, ",")) !== FALSE) {
      /**
     * Construction de l'index a partir de la premiere ligne
     *
      if ($row == 1) {
      $sipArray = array();
      //print_r($data);
      foreach ($data as $key => $item) {

      if ($item == 'source') {
      $sipArray['source'] = $key;
      }
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

      if (count($sipArray) != 7) {

      $exp = new Exception('A SIP item is missing in the file ' . $filePath);
      Yii::log($exp->getMessage(), CLogger::LEVEL_ERROR);
      } else
      $data[] = 'idSip';
      } else {
      $needs = true;
      foreach ($sipArray as $keyField) {
      if ($keyField != 'sourceId' && ($data[$keyField] == null || $data[$keyField] == ''))
      $needs = false;
      }
      if ($needs) {
      $patient = new Patient;
      $patient->source = $data[$sipArray['source']];
      $patient->birthName = $data[$sipArray['birthName']];
      $patient->useName = $data[$sipArray['useName']];
      $patient->firstName = $data[$sipArray['firstName']];
      $patient->birthDate = CommonTools::formatDate($data[$sipArray['birthDate']], 'mysql');
      $patient->sex = $data[$sipArray['sex']];
      isset($sipArray['sourceId']) ? $patient->sourceId = $data[$sipArray['sourceId']] : null;
      //                    if (substr($filePath, 0, 3) === 'adn')
      //                        $patient->source = 2;
      //                    elseif (substr($filePath, 0, 7) === 'cerveau')
      //                        $patient->source = 1;

      if (!$patient->save()) {
      $exp = new Exception('Save patient error');
      Yii::log($exp->getMessage(), CLogger::LEVEL_ERROR);
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
      }else {
      $exp = new Exception('Missing patient item');
      Yii::log($exp->getMessage(), CLogger::LEVEL_ERROR);
      }
      }
      $row++;

      fputcsv($outputFile, $data);
      }
      fclose($sourceFile);
      unlink($filePath);
      fclose($outputFile);
      }
     */

    /**
     * tool remove after use
     * @param type $filePath
     */
    public function csvToXml($filePath) {
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        $folderTarget = $folderSource . 'saved/';
        $sourceFile = fopen($folderSource . $filePath, "r");
        //$outputFile = fopen($folderTarget . substr($filePath, 0, -3) . 'xml', 'w');
        $row = 1;
        $listKeys = array();
        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><file></file>");
        while (($data = fgetcsv($sourceFile, 1000, ",")) !== FALSE) {

            if ($row == 1) {
                foreach ($data as $item) {
                    $listKeys[] = $item;
                }
                print_r($listKeys);
            } else {
                print_r($data);
                $element = $xml->addChild('sample');
                foreach ($data as $key => $item) {
                    $element->addChild($listKeys[$key], $item);
                }
            }
            $row++;
        }

        $xml->asXML($folderTarget . substr($filePath, 0, -3) . 'xml');
    }

}