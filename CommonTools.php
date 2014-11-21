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
    public static function formatDate($source, $lang = 'french') {
        $dateSource = strtotime($source);
        if ($lang == 'french')
            $formatedDate = date('d-m-Y', $dateSource);
        if ($lang == 'mysql')
            $formatedDate = date('Y-m-d', $dateSource);
        return $formatedDate;
    }

    public static function getValidDateFormats() {
        return array(
            'yyyy-mm-dd',
            'dd-mm-yyyy',
            'dd/mm/yy',
            'dd-mm-yyyy',
            'yyyymmdd'
        );
    }

    public static function analyzeXml($filePath) {
        $folderSource = CommonProperties::$MASS_IMPORT_FOLDER;
        $folderTarget = $folderSource . 'treated/';
        $file = simplexml_load_file($filePath);
        $outputXml = new SimpleXMLElement("<?xml version=\"1.0\"?><" . $file->getName() . "></" . $file->getName() . ">");
        foreach ($file->children() as $child) {
            try {
                $patient = new Patient;
                $outputChild = new SimpleXMLElement("<" . $child->getName() . "/>");
//            $outputChild = $outputXml->addChild($child->getName());
                foreach ($child->children() as $att) {

                    if ($att->getName() == 'source') {
                        $patient->source = "$att";
                        $outputChild->addChild($att->getName(), $att);
                    } elseif ($att->getName() == 'useName') {
                        $patient->useName = "$att";
                    } elseif ($att->getName() == 'birthName') {
                        $patient->birthName = "$att";
                    } elseif ($att->getName() == 'firstName') {
                        $patient->firstName = "$att";
                    } elseif ($att->getName() == 'sex') {
                        $patient->sex = "$att";
                    } elseif ($att->getName() == 'birthDate') {
                        $patient->birthDate = CommonTools::formatDate("$att", "mysql");
                    } elseif ($att->getName() == 'id') {
                        $patient->sourceId = "$att";
                    } else {
                        $outputChild->addChild($att->getName(), $att);
                    }
                }
                if ($patient->save()) {

                    $outputChild->addChild('id', $patient->id);
                    CommonTools::sxml_append($outputXml, $outputChild);
                } else
                    Yii::log('Patient save error', CLogger::LEVEL_ERROR);
            } catch (Exception $ex) {
                Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR);
            }
        }
        $outputXml->asXML($folderTarget . $filePath);
        unlink($filePath);
    }

    public static function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

}