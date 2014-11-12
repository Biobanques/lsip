<?php

/**
 * This is the model class for table "Rapprochement".
 *
 * The followings are the available columns in table 'Rapprochement':
 * @property int $idRapprochement
 * @property int $idPat1
 * @property int $idPat2
 * @property int $validated
 */
class Rapprochement extends CActiveRecord
{
    public $validated = 0;
    public $ratio;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Rapprochement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idPat1, idPat2', 'required'),
            array('idPat1, idPat2', 'length', 'max' => 45),
            array('validated', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idRapprochement, idPat1, idPat2, validated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idP1' => array(self::BELONGS_TO, 'Patient', 'idPat1'),
            'idP2' => array(self::BELONGS_TO, 'Patient', 'idPat2')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Id Rapprochement',
            'idPat1' => 'Id Pat1',
            'idPat2' => 'Id Pat2',
            'validated' => 'Validated',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical useif($attributeName ==:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idRapprochement', $this->idRapprochement);
        $criteria->compare('idPat1', $this->idPat1, true);
        $criteria->compare('idPat2', $this->idPat2, true);
        $criteria->compare('validated', $this->validated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Rapprochement the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getRapprochements() {
        $criteria = new CDbCriteria();
        $criteria->with = array('idP1', 'idP2');
        $criteria->addCondition('idP1.source <> idP2.source');

        $rapps = $this->findAll($criteria);

        foreach ($rapps as $rapp) {
            $rapp->ratio = $rapp->setRatio();
        }
        $result = new CArrayDataProvider($rapps, array(
            'keyField' => 'idRapprochement',
            'sort' => array(
                'attributes' => array(
                    'ratio',
                    'validated',
                ),
            )
        ));
        $result->sort->defaultOrder = 'validated ASC, ratio DESC, ';
        return $result;

//        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
//
//        ));
    }

    public function getFusions() {
        $criteria = new CDbCriteria();
        $criteria->with = array('idP1', 'idP2');
        $criteria->addCondition('idP1.source = idP2.source');
        $rapps = $this->findAll($criteria);

        foreach ($rapps as $rapp) {
            $rapp->ratio = $rapp->setRatio();
        }
        $result = new CArrayDataProvider($rapps, array(
            'keyField' => 'idRapprochement',
            'sort' => array(
                'attributes' => array(
                    'ratio',
                    'validated',
                ),
            )
        ));
        $result->sort->defaultOrder = 'validated ASC, ratio DESC, ';
        return $result;
//        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
//        ));
    }

    public function getAllRelativePatients($baseId) {

        $list1 = $this->findAllByAttributes(array('idPat1' => $baseId));
        foreach ($list1 as $r1) {
            if ($r1->idP1->source != $r1->idP2->source)
                $result[] = WSPatient::model()->findByPk($r1->idPat2);
        }

        $list2 = $this->findAllByAttributes(array('idPat2' => $baseId));
        foreach ($list2 as $r2) {
            if ($r2->idP1->source != $r2->idP2->source)
                $result[] = WSPatient::model()->findByPk($r2->idPat1);
        }

        return $result;
    }

    public function getAllRelativeValidatedPatients($baseId) {
        try {
            $list1 = $this->findAllByAttributes(array('idPat1' => $baseId, 'validated' => '2'));
            $result = array();

            foreach ($list1 as $r1) {
                if ($r1->idP1->source != $r1->idP2->source)
                    $result[] = WSPatient::model()->findByPk($r1->idPat2);
            }

            $list2 = $this->findAllByAttributes(array('idPat2' => $baseId, 'validated' => '2'));

            foreach ($list2 as $r2) {
                if ($r2->idP1->source != $r2->idP2->source)
                    $result[] = WSPatient::model()->findByPk($r2->idPat1);
            }

            return isset($result) && $result != null ? $result : array();
        } catch (Exception $e) {
            Yii::log($e->getMessage());
        }
    }

    public function setRatio() {
        $pat1 = $this->idP1;
        $pat2 = $this->idP2;
        $result = 0;
        $attributes = Patient::model()->attributes;
        foreach ($attributes as $attributeName => $attributeValue)
            if ((!in_array($attributeName, array('id', 'sourceId', 'source'))) && ($pat1->$attributeName == $pat2->$attributeName)) {

                if ($attributeName == 'birthName')
                    $result+=25;
                if ($attributeName == 'useName')
                    $result +=25;
                if ($attributeName == 'firstName')
                    $result += 25;
                if ($attributeName == 'birthDate')
                    $result +=15;
                if ($attributeName == 'sex')
                    $result +=10;

                //echo $attributeName;
            }

        return $result;
    }

    public function getRatio() {
        return $this->ratio;
    }

}