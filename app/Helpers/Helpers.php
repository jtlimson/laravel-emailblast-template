<?php 

namespace App\Helpers;

class Helpers{
   
    static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    static function isEmailValid($email){
        if(empty($email)) return FALSE;
        return filter_var( trim($email), FILTER_VALIDATE_EMAIL) ? TRUE : FALSE;
    }
    
    //https://www.php.net/manual/en/function.imap-setflag-full.php
    function pop3_delete($connection,$message)
    {
        $status = imap_setflag_full($connection, '1:'.$message, '\\Deleted');
        imap_expunge($connection);
        return $status;
    }
}