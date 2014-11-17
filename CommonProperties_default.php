<?php

/*
 * CommonProperties to store variables used for connexion etc.
 * @author nicolas malservet
 * @since version 0.16
 */

class CommonProperties
{
    /*
     * database connection properties
     */
    public static $CONNECTION_STRING = 'mysql:host=yourhost;dbname=yourDBname';
    public static $CONNECTION_USERNAME = '';
    public static $CONNECTION_PASSWORD = '';
    /**
     * webmaster email
     */
    public static $ADMIN_EMAIL = 'email@admin.com';
    /**
     *
     * import folder.
     * Be sure to end this string by a directory separator
     */
    public static $MASS_IMPORT_FOLDER = '/your/folder/here/';
}