<?php

/**
 * This is the model class for table "Patient".
 *
 * The followings are the available columns in table 'Patient':
 * @property integer $id
 * @property string $birthName
 * @property string $useName
 * @property string $firstName
 * @property date $birthDate
 * @property int $source
 * @property string $sex
 */
class Patient extends CActiveRecord
{
    public $sourceId = 0;
    public $birthName;
    public $useName;
    public $firstName;
    public $birthDate;
    public $source;
    public $birthPlace;
    public $sex;
    public $id;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Patients';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('birthName, firstName, birthDate, source, sex', 'required'),
            array('id,birthDate', 'required', 'on' => 'save'),
            array('birthName, firstName, birthPlace,useName', 'length', 'max' => 255),
            array('id,source', 'numerical', 'integerOnly' => true),
            array('sex', 'length', 'max' => 1),
            array('sourceId,birthPlace', 'length', 'allowEmpty' => true),
            array('birthDate', 'date', 'format' => CommonTools::getValidDateFormats()),
//            // The following rule is used by search().
//            // @todo Please remove those attributes that should not be searched.
            array('id,  useName, firstName, birthDate, source, src, sourceId, sex, birthPlace', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'src' => array(self::BELONGS_TO, 'Sources', 'source'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('patient', 'Id'),
            'birthName' => Yii::t('patient', 'birthName'),
            'useName' => Yii::t('patient', 'useName'),
            'firstName' => Yii::t('patient', 'firstName'),
            'birthDate' => Yii::t('patient', 'birthDate'),
            'source' => Yii::t('patient', 'source'),
            'birthPlace' => Yii::t('patient', 'birthPlace'),
            'sex' => Yii::t('patient', 'sex'),
            'sourceId' => Yii::t('patient', 'sourceId')
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
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
        $criteria->with = array('src');
        $criteria->compare('id', $this->id);
        $criteria->compare('birthName', $this->birthName, false);
        $criteria->compare('useName', $this->useName, false);
        $criteria->compare('firstName', $this->firstName, false);
        $criteria->compare('birthDate', $this->birthDate, false);
        $criteria->compare('source', $this->src, false);
        $criteria->compare('sex', $this->sex, false);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Patient the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

//    public function validate($attributes = null, $clearErrors = true) {
//        $id = rand(1000000, 2000000);
//
//        while (count(Patient::model()->find("id=$id")) != 0)
//            $id = rand(1000000, 2000000);
//        $this->id = $id;
//        parent::validate($attributes, $clearErrors);
//    }
    public function save($runValidation = true, $attributes = NULL) {
        $verified = false;
        $validated = true;
        if ($this->isNewRecord) {


            while (!$verified && $validated) {
                $id = rand(1000000, 2000000);
                $this->id = $id;
                try {
                    $this->setScenario('save');
                    if ($validated = $this->validate())
                        $verified = parent::save();
                } catch (Exception $e) {
                    Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
                }
            }
        } else {

            try {
                $verified = parent::save();
            } catch (Exception $ex) {
                Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
            }
        }
        return $verified;
    }

    public function afterValidate() {
        $this->birthDate = CommonTools::formatDate($this->birthDate, 'mysql');
        return parent::afterValidate();
    }

    public function beforeValidate() {
        $this->birthDate = str_replace('/', '-', $this->birthDate);
        $this->birthDate = CommonTools::formatDate($this->birthDate, 'mysql');
        return parent::beforeValidate();
    }

    public function afterFind() {
        $this->birthDate = CommonTools::formatDate($this->birthDate, Yii::app()->language);
        return parent::beforeValidate();
    }

    public function getSexValues() {
        return array(
            'M' => Yii::t('patient', 'sex_m'),
            'F' => Yii::t('patient', 'sex_f'),
            'U' => Yii::t('patient', 'sex_u'),
        );
    }

}