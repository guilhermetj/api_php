<?php

class Connect {
    
    public static $Host = "localhost";
    public static $User = "root";
    public static $Pass = "";
    public static $Dbname = "api_php";
    private static $Connect = null;
    
    private static function Connect() {
        try {
            if(self::$Connect == null):
                self::$Connect = new PDO('mysql:host=' . self::$Host .';dbname='.self::$Dbname, self::$User, self::$Pass);
            endif;           
        } catch (Exception $ex) {
            echo 'Mensagem: ' . $ex->getMessage();
            die;
        }       
        return self::$Connect;
    }
    
    public function getConn() {
        return self::Connect();

    }
    
}