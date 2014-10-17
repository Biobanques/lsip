<?php

/**
 * This is the model class for table "Sources".
 *
 * The followings are the available columns in table 'Sources':
 * @property integer $id
 * @property string $name
 * @property string $passphrase
 *
 * The followings are the available model relations:
 * @property Patient[] $patients
 */
class Sources extends CActiveRecord
{
    /**
     *
     * @var int id
     * @soap
     */
    public $id;
    /**
     *
     * @var string name
     * @soap
     */
    public $name;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Sources';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name, passphrase', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, passphrase', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'patients' => array(self::HAS_MANY, 'Patient', 'source'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'passphrase' => 'Passphrase',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('passphrase', $this->passphrase, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sources the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}