<?php
class DataProvider{
    public static $instance = null;
    private $dblink;
    private function __construct(){
    }
    public static function getInstance()
    {
      if (self::$instance == null)
      {
        self::$instance = new DataProvider();
      }
      return self::$instance;
    }
    public function Execute($query)
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "shopping";

        $dblink =  mysqli_connect($host, $user, $password, $db);
        $result = mysqli_query($dblink, $query);

        return $result;
    }
}
?>