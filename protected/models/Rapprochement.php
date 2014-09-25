<?php

/**
 * This is the model class for table "Rapprochement".
 *
 * The followings are the available columns in table 'Rapprochement':
 * @property integer $idRapprochement
 * @property string $idPat1
 * @property string $idPat2
 * @property string $validated
 */
class Rapprochement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Rapprochement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPat1, idPat2', 'required'),
			array('idPat1, idPat2', 'length', 'max'=>45),
			array('validated', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idRapprochement, idPat1, idPat2, validated', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idRapprochement' => 'Id Rapprochement',
			'idPat1' => 'Id Pat1',
			'idPat2' => 'Id Pat2',
			'validated' => 'Validated',
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

		$criteria->compare('idRapprochement',$this->idRapprochement);
		$criteria->compare('idPat1',$this->idPat1,true);
		$criteria->compare('idPat2',$this->idPat2,true);
		$criteria->compare('validated',$this->validated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rapprochement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
