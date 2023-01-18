<?php 
 
 //adding dboperation file 
 require_once '../includes/DbOperation.php';
 
 //response array 
 $response = array(); 
 
 //if a get parameter named op is set we will consider it as an api call 
 if(isset($_GET['op'])){
 
 //switching the get op value 
 switch($_GET['op']){

 case 'irad':
 if(isset ($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['employee_code'])){
 $db = new DbOperation(); 
 if($db->createArtist($_POST['first_name'], $_POST['last_name'], $_POST['employee_code'])){
        $response['error'] = false;
        $response['message'] = 'Artist added successfully';
 }else{
        $response['error'] = true;
        $response['message'] = 'Could not add artist';
 }
 }else{
        $response['error'] = true; 
        $response['message'] = 'Required Parameters are missing';
 }
 break; 
 
 //if it is getartist that means we are fetching the records
 case 'drmlist':
 $db = new DbOperation();
 $artists = $db->getArtists();
 if(count($artists)<=0){
    
        $response['error'] = true;
        $response['message'] = 'Nothing found in the database';
 }else{
        
        $response['error'] = false; 
        $response['artists'] = $artists;
 }
 break; 
 
 default:
        $response['error'] = true;
        $response['message'] = 'No operation to perform';
 
 }
 
 }else{
        $response['error'] = false; 
        $response['message'] = 'Invalid Request';
 }
 
 //displaying the data in json 
    echo json_encode($response);
 ?>