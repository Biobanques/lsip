<?php

/**
 * Contains different common tools and constant
 */
class CommonTools
{

    public static function compareFields($str01, $str02) {
        $result = false;
        if ($str01 && $str02) {
            $toReplace = array(" ", "-", "_");
            $str01 = strtolower(str_replace($toReplace, "", $str01));
            $str02 = strtolower(str_replace($toReplace, "", $str02));
            if ($str01 == $str02)
                $result = true;
        }
        return $result;
    }

    public static function detect($patientBase) {
        $params = '';
        $params .= "'$patientBase->id',";
        $params .= "'$patientBase->birthName',";
        $params .= "'$patientBase->useName',";
        $params .= "'$patientBase->firstName',";
        $params .= "'$patientBase->birthDate',";
        $params .= "'$patientBase->source',";
        $params .= "'$patientBase->sex',";
        $params .= "'$patientBase->sourceId'";

//echo $params;
//            $params = rtrim($params, ",");
        $command = Yii::app()->db->createCommand("call detect_rapprochement2($params)");
        $command->execute();
    }

    /**
     * take a string as date and return it to 01-01-1970 format (french format)
     * @param string $source
     * @return string
     */
    public static function formatDate($source, $lang = 'fr') {
        $dateSource = strtotime($source);
        switch ($lang) {
            case 'fr': $formatedDate = date('d/m/Y', $dateSource);
                break;
            case 'en': $formatedDate = date('Y-m-d', $dateSource);
                break;
            case 'mysql': $formatedDate = date('Y-m-d', $dateSource);
                break;
            default : $formatedDate = date('Y-m-d', $dateSource);
                break;
        }
        return $formatedDate;
    }

    public static function getValidDateFormats() {
        return array(
            'yyyy-mm-dd',
            'dd-mm-yyyy',
            'dd/mm/yy',
            'yyyymmdd'
        );
    }

    public static function analyzeAndRecreateXml($filePath) {
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        if (substr($folderSource, -1) != '/')
            $folderSource.='/';
        $folderTarget = $folderSource . 'treated/';
        $file = simplexml_load_file($filePath);
        $outputXml = new SimpleXMLElement("<?xml version=\"1.0\"?><" . $file->getName() . "></" . $file->getName() . ">");
        foreach ($file->children() as $child) {
            $outputChild = new SimpleXMLElement("<" . $child->getName() . "/>");
            if ($child->getName() == 'source') {
                $source = "$child";
                $outputXml->addChild("source", $source);
            } elseif ($child->getName() == 'sample') {
                foreach ($child->children() as $att) {
                    if ($att->getName() == "patient") {
                        $patient = CommonTools::setPatientFromXml($att);
                        $patient->source = $source;
                    } else {
                        $outputChild->addChild($att->getName(), $att);
                    }
                }
                if ($patient->save()) {
                    $outputChild->addChild('sipId', $patient->id);
                    CommonTools::sxml_append($outputXml, $outputChild);
                }
            }
        }
        $outputXml->asXML($folderTarget . 'treated_' . $filePath);
        unlink($filePath);
    }

    public static function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    public static function setPatientFromXml($xml) {
        $patient = new Patient();
        foreach ($xml->children() as $patientAttribute) {
            if ($patientAttribute->getName() == 'useName') {
                $patient->useName = "$patientAttribute";
            } elseif ($patientAttribute->getName() == 'birthName') {
                $patient->birthName = "$patientAttribute";
            } elseif ($patientAttribute->getName() == 'firstName') {
                $patient->firstName = "$patientAttribute";
            } elseif ($patientAttribute->getName() == 'sex') {
                $patient->sex = "$patientAttribute";
            } elseif ($patientAttribute->getName() == 'birthDate') {
                $patient->birthDate = CommonTools::formatDate("$patientAttribute", "mysql");
            } elseif ($patientAttribute->getName() == 'id') {
                $patient->sourceId = "$patientAttribute";
            }
        }
        return $patient;
    }

    public static function getImportedFilesInfo() {

        $listFilesInFolder = array();
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        if (substr($folderSource, -1) != '/')
            $folderSource.='/';

        if ($handle = opendir($folderSource)) {
            $filePresent = false;
            while (false !== ($file = readdir($handle))) {

                if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'xml') {
                    $filePresent = true;
                    $filePath = $folderSource . $file;
                    $listFilesInFolder[] = array('name' => $file, 'size' => CommonTools::getFileSize(filesize($filePath)), 'lastModif' => CommonTools::formatDate(date('Y-m-d', filemtime($filePath)), Yii::app()->language));
                }
            }
            closedir($handle);
        }
        return $filePresent ? $listFilesInFolder : null;
    }

    public static function getFileSize($fileSize) {
        $result;
        switch (true) {
            case ($fileSize > 1024 * 1024):$result = round($fileSize / (1024 * 1024), 2) . ' Mo';
                break;
            case ($fileSize > 1024):$result = round($fileSize / (1024), 2) . ' ko';
                break;
            default: $result = $fileSize . ' o';
                break;
        }
        return $result;
    }

}