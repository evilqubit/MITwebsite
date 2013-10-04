<?php

/**
 * Time Helper Class
 *
 * @author     AB
 * @lastUpdate 20120306
 */
class TimeHelper{

    /**
     * Returns Time and Date the same format as MySql,
     * Current date if no timestamp is provided.
     * 
     * @param timestamp $timestamp  timestamp to be formatted
     * @return string  Date
     */
    public static function MysqlDateFormat($timestamp=NULL){
        if($timestamp)
            $date = date('Y-m-d H:i:s', $timestamp);
        else
            $date = date('Y-m-d H:i:s');
        return $date;
    }

    /**
     * Returns if date is null
     * @param string $date
     * @param boolean $dateTime
     * @return boolean 
     */
    public static function zeroDate($date, $dateTime = true){
        if($dateTime){
            if($date == '0000-00-00 00:00:00')
                return true;
            else
                return false;
        }
        else{
            if($date == '0000-00-00')
                return true;
            else
                return false;
        }
    }

}

