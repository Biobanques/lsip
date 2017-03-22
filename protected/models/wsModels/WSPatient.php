<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Extend Patient to give soap properties
 *
 * @author matthieu
 */
class WSPatient extends Patient
{
    /**
     *
     * @var int id
     * @soap
     */
    public $id;
    /**
     *
     * @var string birthName
     * @soap
     */
    public $birthName;
    /**
     *
     * @var string useName
     * @soap
     */
    public $useName;
    /**
     *
     * @var string firstName
     * @soap
     */
    public $firstName;
    /**
     *
     * @var date birthDate
     * @soap
     */
    public $birthDate;
    /**
     *
     * @var string sex
     * @soap
     */
    public $sex;
    /**
     *
     * @var int source
     * @soap
     */
    public $source;
    /**
     *
     * @var string sourceId
     * @soap
     */
    public $sourceId = 0;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Patient the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}