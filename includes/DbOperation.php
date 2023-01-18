<?php
 
class DbOperation
{
    private $con;
    
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }
    //adding a record to database  $last_name, $employee_code, $phone_number, employee_code, phone_number  , $last_name, $employee_code, $phone_number
    public function createArtist($first_name, $last_name){
        $stmt = $this->con->prepare("INSERT INTO DRM (first_name, last_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $first_name, $last_name);
        if($stmt->execute())
        return true; 
        return false; 
    }
    
    //fetching all records from the database 
    public function getArtists(){
        $stmt = $this->con->prepare("SELECT id, first_name, last_name FROM DRM");
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $last_name);
        $artists = array();
        
        while($stmt->fetch()){

            $temp = array(); 
            $temp['ID'] = $id; 
            $temp['First Name'] = $first_name; 
            $temp['Last Name'] = $last_name; 
            array_push($artists, $temp);
        }
        return $artists; 
    }
}
?>