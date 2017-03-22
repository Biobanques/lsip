<?php

/**
 * This is the model class for table "Sources".
 *
 * The followings are the available columns in table 'Sources':
 * @property integer $id
 * @property string $name
 * @property string $passphrase
 * @property integer $admin
 * @property integer $webapp
 *
 * The followings are the available model relations:
 * @property Patient[] $patients
 * @property Users $admin0
 * @property Users $webapp0
 */
class Sources extends CActiveRecord
{

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
            array('name, admin, webapp', 'required'),
            array('admin, webapp,id', 'numerical', 'integerOnly' => true),
            array('name, passphrase', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, passphrase,patients, admin, webapp,admin0, webapp0', 'safe', 'on' => 'search'),
            array('id, name, passphrase,patients, admin, webapp,admin0, webapp0', 'safe',),
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
            'admin0' => array(self::BELONGS_TO, 'User', 'admin'),
            'webapp0' => array(self::BELONGS_TO, 'User', 'webapp'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('sources', 'id'),
            'name' => Yii::t('sources', 'name'),
            'passphrase' => Yii::t('sources', 'passphrase'),
            'admin' => Yii::t('sources', 'admin'),
            'webapp' => Yii::t('sources', 'webapp'),
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
        $criteria->with = array('admin0', 'webapp0');
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('passphrase', $this->passphrase, true);
        $criteria->compare('admin', $this->admin0);
        $criteria->compare('webapp', $this->webapp0);

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