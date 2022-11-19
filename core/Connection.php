<?php 
class Connection {
    // Hold the class instance.
    private static $instance = null;
    
    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {

    }

    public static function getInstance()
    {
      if (self::$instance == null)
      {
        self::$instance = new Connection();
      }
   
      return self::$instance;
    }
  }
?>