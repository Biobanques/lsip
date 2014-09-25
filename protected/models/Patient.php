<?php

/**
 * This is the model class for table "Patient".
 *
 * The followings are the available columns in table 'Patient':
 * @property string $id
 * @property string $birthName
 * @property string $useName
 * @property string $firstName
 * @property string $birthDate
 * @property string $sex
 * @property string $birthPlace
 * @property string $adress
 * @property string $phone
 * @property string $mail
 * @property integer $source
 *
 * The followings are the available model relations:
 * @property Sources $source0
 * @property Rapprochement[] $rapprochements
 * @property Rapprochement[] $rapprochements1
 */
class Patient extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, birthName, useName, firstName, birthDate, sex', 'required'),
			array('source', 'numerical', 'integerOnly'=>true),
			array('id, birthName, useName, firstName, birthPlace, adress, phone', 'length', 'max'=>100),
			array('sex, mail', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, birthName, useName, firstName, birthDate, sex, birthPlace, adress, phone, mail, source', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'source0' => array(self::BELONGS_TO, 'Sources', 'source'),
			'rapprochements' => array(self::HAS_MANY, 'Rapprochement', 'idPat1'),
			'rapprochements1' => array(self::HAS_MANY, 'Rapprochement', 'idPat2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'birthName' => 'Birth Name',
			'useName' => 'Use Name',
			'firstName' => 'First Name',
			'birthDate' => 'Birth Date',
			'sex' => 'Sex',
			'birthPlace' => 'Birth Place',
			'adress' => 'Adress',
			'phone' => 'Phone',
			'mail' => 'Mail',
			'source' => 'Source',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('birthName',$this->birthName,true);
		$criteria->compare('useName',$this->useName,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('birthDate',$this->birthDate,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birthPlace',$this->birthPlace,true);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('source',$this->source);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
