<?php

class Flasher
{
    private static $MESSAGE_PREFIX = 'drewpereli_flash_messages';
    //private static $types = array("success", "info", "warning", "danger");

    //Returns true if type is in self::types.
    function has($type)
    {
        return isset($_SESSION[self::$MESSAGE_PREFIX][$type]);
    }


    //Returns true only if at least one flash message is set
    function hasMessage()
    {
        return sizeof($_SESSION[self::$MESSAGE_PREFIX]) > 0;
    }

    //Echos flash message of "type" and unsets it.
    function flash($type){
        if (!self::has($type)) {
            return null;
        }
        echo self::get($type);
    }

    //Returns flash message of "type" and unsets it. 
    function get($type)
    {
        if (!self::has($type)) {
            return null;
        }
        $value = $_SESSION[self::$MESSAGE_PREFIX][$type];
        unset($_SESSION[self::$MESSAGE_PREFIX][$type]);
        return $value;
    }

    //Returns flash message of "type" and doesn't unset it.
    function peek($type)
    {
        if (!self::has($type)) {
            return null;
        }
        return $_SESSION[self::$MESSAGE_PREFIX][$type];
    }

    //Sets the flash message of "type" to "value"
    function set($type, $value)
    {
        $_SESSION[self::$MESSAGE_PREFIX][$type] = $value;
    }

    //Sets the flash message of "type" to "value"
    function __set($type, $value)
    {
        $this->set($type, $value);
    }

    function __get($type){
        $this->get($type);
    }

    function __construct(){
        session_start();
    }
}



