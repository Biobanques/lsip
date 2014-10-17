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

}