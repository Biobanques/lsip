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
    public $sex;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Patient';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('birthName, useName, firstName, birthDate, source, sex', 'required'),
            array('id', 'required', 'on' => 'save'),
            array('birthName, firstName, source, sex', 'length', 'max' => 255),
            array('sourceId', 'length', 'allowEmpty' => true),
            array('birthDate', 'date', 'format' => CommonTools::getValidDateFormats()),
//            // The following rule is used by search().
//            // @todo Please remove those attributes that should not be searched.
            array('id,  useName, firstName, birthDate, source,sourceId, sex', 'safe', 'on' => 'search'),
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
            'id' => Yii::t('patient', 'id'),
            'birthName' => Yii::t('patient', 'BirthName'),
            'useName' => Yii::t('patient', 'Use Name'),
            'firstName' => 'First Name',
            'birthDate' => 'Birth Date',
            'source' => 'Source',
            'sex' => 'Sex',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('birthName', $this->birthName, false);
        $criteria->compare('useName', $this->useName, false);
        $criteria->compare('firstName', $this->firstName, false);
        $criteria->compare('birthDate', $this->birthDate, false);
        $criteria->compare('source', $this->source, false);
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

    public function save($runValidation = true, $attributes = NULL) {
        $verified = false;
        $validated = true;
        if ($this->isNewRecord) {
            Yii::log('passe par ici', CLogger::LEVEL_ERROR);

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
            Yii::log('passe par la', CLogger::LEVEL_ERROR);
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

}