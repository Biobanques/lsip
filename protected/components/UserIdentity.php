<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    const ERROR_INACTIVE = 3;

    private $id;

    /**
     * Authenticates a user.

     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $record = User::model()->findByAttributes(array('login' => $this->username));
        if ($record == null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($record->password != $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->errorCode = self::ERROR_NONE;
            $this->id = $record->id;
            //on stocke le profil pour checker plus tard si admin
            $this->setState('profil', $record->profil);
            //on stocke le numero de biobanque associée si non null pour checker ensuite si admin bioban
        }
        return $this->errorCode;
    }

    public function getId() {
        return $this->id;
    }

}
