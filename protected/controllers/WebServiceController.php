<?php

class WebServiceController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'getWs' => array(
                'class' => 'CWebServiceAction',
                'classMap' => array(
                    'WSPatient' => 'WSPatient',
                )
            ),
        );
    }

    /**
     * @param string $name
     * @param string $password
     * @return string $sessionkey
     * @soap
     */
    public function login($name, $password) {

        $identity = new UserIdentity($name, $password);
        $identity->authenticate();
        if ($identity->errorCode == UserIdentity::ERROR_NONE)
            Yii::app()->user->login($identity, 3600);
        else
            return new SoapFault("login", "Problem with login");
        $sessionKey = sha1(mt_rand());
        Yii::app()->cache->set('soap_sessionkey' . $sessionKey . Yii::app()->user->getId(), $name . ':' . $password, 1800);
        return $sessionKey;
    }

    /**
     * authenticates a user via the sessionid
     * throws an exception on error
     */
    protected function authenticateBySession($sessionKey) {
        $data = Yii::app()->cache->get('soap_sessionkey' . $sessionKey . Yii::app()->user->getId());
        list($name, $password) = explode(':', $data);
        if ($name) {
            $identity = new UserIdentity($name, $password);
            $identity->authenticate();
            if ($identity->errorCode == UserIdentity::ERROR_NONE)
                Yii::app()->user->login($identity, 3600);
        }
        // happens when session is invalid or login not possible (deleted, deactivated)
        if (!Yii::app()->user->id)
            throw new SoapFault('authentication', 'Your session is invalid');
    }

    /**
     *
     * @param WSPatient $base
     * @return array

     */
    public function getWSPatient($base) {
        $attributesArray = array();
        foreach ($base->attributes as $attributeName => $attributeValue) {
            if ($attributeName != 'birthDate' && $attributeName != 'sourceId' && $attributeName != 'source')
                $attributeValue != null ? $attributesArray[$attributeName] = $attributeValue : null;
            elseif ($attributeName == 'birthDate') {

                if ($attributeValue != null && $attributeValue != 0 && $attributeValue != ''
                ) {
                    $pat = new Patient();
                    $pat->birthDate = $attributeValue;
                    if ($pat->validate(array('birthDate')))
                        $attributeValue = str_replace('/', '-', $attributeValue);
                    $attributesArray[$attributeName] = date('Y-m-d', strtotime($attributeValue));
//                        $attributesArray[$attributeName] = date('Y-m-d', $pat->birthDate);
                }
            }
        }
        $list = WSPatient::model()->findAllByAttributes($attributesArray);
        return $list;
    }

    /**
     * @param string $sessionKey
     * @param int $baseId
     * @return array $test

     */
//    public function getRapprochement($baseId) {
//
//        $list = Rapprochement::model()->getAllRelativePatients($baseId);
//        return $list;
//    }

    /**
     * @param string $sessionKey
     * @param int $baseId
     * @return array $result
     * @soap

     */
    public function getRapprochedId($sessionKey, $baseId) {
        $this->authenticateBySession($sessionKey);
        $result = array();
        $pats = Rapprochement::model()->getAllRelativeValidatedPatients($baseId);

        foreach ($pats as $patient)
            $result[] = $patient->id;

        return isset($result) && count($result) != 0 ? $result : null;
    }

    /**

     * @param string sessionKey
     * @param WSPatient $patientBase
     * @return int id
     * @soap

     *
     */
    public function addPatientWs($sessionKey, $patientBase) {
        $this->authenticateBySession($sessionKey);
        return $this->addPatient($patientBase);
    }

    /**
     * @param string sessionKey
     * @param WSPatient $patientBase
     * @return boolean

     */
    public function updatePatient($sessionKey, $patientBase) {
        $this->authenticateBySession($sessionKey);
        $model = Patient::model()->findByPk($patientBase->id);
        $model->attributes = $patientBase->attributes;
        return $model->save();
    }

    /**
     * @param string sessionKey
     * @param int source
     * @param string sourceId
     * @return int

     */
    public function getIdFromLocalId($sessionKey, $source, $sourceId) {
        $this->authenticateBySession($sessionKey);
        return Patient::model()->findByAttributes(array('source' => $source, 'sourceId' => $sourceId))->id;
    }

    /**
     * @param string sessionKey
     * @param WSPatient patient
     * @return string id
     * @soap
     */
    public function getIdWs($sessionKey, $patient) {
        $this->authenticateBySession($sessionKey);
        $searchResult = $this->getWSPatient($patient);
        if (count($searchResult) == 1)
            $result = $searchResult[0]->id;
        elseif (count($searchResult) == 0)
            $result = $this->addPatient($patient);
        else {
            throw new SoapFault('server', 'Many patient were found, please add details.');
        }
        return $result;
    }

    public function addPatient($base) {
        $patient = new Patient();
        foreach ($base->attributes as $attrName => $attrValue)
            $patient->$attrName = $attrValue;


        if ($patient->save())
            return $patient->id;
        else {
            throw new SoapFault("Server", "No existing patient can be found. Please fill missing parameters to add a new one.");
        }
    }

}