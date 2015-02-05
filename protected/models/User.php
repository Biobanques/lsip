<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $nom
 * @property string $prenom
 * @property string $profil
 * @property string $login
 * @property string $password
 */
class User extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('profil, login, password', 'required'),
            array('nom, prenom, profil, login, password', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idusers, nom, prenom, profil, login, password', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('user', 'id'),
            'nom' => Yii::t('user', 'nom'),
            'prenom' => Yii::t('user', 'prenom'),
            'profil' => Yii::t('user', 'profil'),
            'login' => Yii::t('user', 'login'),
            'password' => Yii::t('user', 'password'),
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
        $criteria->compare('nom', $this->nom, true);
        $criteria->compare('prenom', $this->prenom, true);
        $criteria->compare('profil', $this->profil, true);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getFullName() {
        return "$this->prenom $this->nom";
    }

    public function getProfilsLabels() {
        $result = array(1 => Yii::t('user', 'sipAdmin'),
            2 => Yii::t('user', 'srcAdmin'),
            3 => Yii::t('user', 'simpleUser'));
        return $result;
    }

}